# Capa de Servicios

La lógica de negocio para la gestión de formularios está desacoplada de los controladores mediante una capa de servicios ubicada en `app/Services/Formularios/`.

---

## FormularioFactory

`app/Services/Formularios/FormularioFactory.php`

Punto de entrada único para obtener el servicio correcto según el tipo de formulario.

```php
$servicio = FormularioFactory::make($tipo_form_id);
$servicio->guardar($request, $registro);
```

**Responsabilidad:** Mapear el `tipo_form_id` (integer 1-9) al servicio correcto. Lanza `InvalidArgumentException` para tipos no registrados.

**Mapa interno:**
```
1  → FormularioGenericoService(Formulario1::class, 'registros.pdf.formulario_1')
2  → Formulario2Service
3  → Formulario3Service
4  → FormularioGenericoService(Formulario4::class, 'registros.pdf.formulario_4')
5  → FormularioGenericoService(Formulario5::class, 'registros.pdf.formulario_5')
6  → Formulario6Service
7  → Formulario7Service
8  → Formulario8Service
9  → Formulario9Service
```

---

## BaseFormularioService (clase abstracta)

`app/Services/Formularios/BaseFormularioService.php`

Todos los servicios heredan de esta clase. Contiene la lógica común:

### Métodos abstractos (deben implementarse en subclases)

```php
abstract public function guardar(Request $request, Registro $registro): void;
abstract public function actualizar(Request $request, Registro $registro): void;
abstract public function vistaPdf(): string;
```

### Métodos concretos compartidos

#### `llenarCamposComunes(Model $formulario, Request $request): void`
Mapea los campos comunes presentes en todos los formularios:
- Nombre e identificación del inspector
- Lugar, dirección y punto de muestreo
- Fechas de inicio y fin
- Observaciones

#### `guardarAnexos(Model $formulario, Request $request, int $cantidad = 4): void`
Procesa hasta `$cantidad` anexos fotográficos:
1. Verifica si el request tiene `anexo_N_file`
2. Guarda el título del anexo en `anexo_N_titulo`
3. Si hay archivo: llama a `guardarImagenVertical()` para procesar y guardar la imagen
4. Borra el archivo anterior si existía y se está reemplazando

#### `guardarImagenVertical(UploadedFile $file, string $nombreBase): string`
- Usa la librería **Intervention Image** con driver GD
- Lee la orientación EXIF de la imagen original
- Rota la imagen para corregir la orientación
- Guarda como JPEG al 85% de calidad en `storage/app/public/`
- Devuelve el path relativo para guardar en BD

#### `guardarTablasDinamicas(Model $formulario, Request $request, array $columnas): void`
Persiste tablas de datos dinámicos como JSON:
```php
$this->guardarTablasDinamicas($formulario, $request, [
    'equipos_detalle',
    'mediciones_detalle',
]);
```
Toma el array del request con ese nombre y lo asigna al atributo del modelo.

#### `obtenerFormulario(int $registro_id, string $modelClass): Model`
Busca el formulario en BD por `registro_id`. Lanza `ModelNotFoundException` si no existe.

#### `llenarFlagsPdf(Model $formulario, Request $request): void`
Configura flags booleanos que controlan qué secciones mostrar en el PDF.

---

## FormularioGenericoService

`app/Services/Formularios/FormularioGenericoService.php`

Implementación concreta para formularios sin lógica especial (formularios 1, 4, 5).

```php
$servicio = new FormularioGenericoService(
    modelClass: Formulario1::class,
    vistaPdf: 'registros.pdf.formulario_1'
);
```

**`guardar()`:**
1. Crea instancia del modelo
2. Asigna `registro_id`
3. Llama `llenarCamposComunes()`
4. Llama `guardarTablasDinamicas()`
5. Llama `guardarAnexos()`
6. Llama `save()`

**`actualizar()`:**
1. Obtiene formulario existente via `obtenerFormulario()`
2. Mismo proceso que guardar pero sobre el modelo existente

---

## Formulario2Service

`app/Services/Formularios/Formulario2Service.php`

Servicio con la lógica más compleja del sistema.

### Responsabilidades adicionales

#### `sincronizarLecturas(Formulario2 $formulario, Request $request): void`
Sincroniza la tabla `formulario_2_lecturas`:
1. Borra todas las lecturas anteriores del formulario
2. Inserta las nuevas lecturas del request (array de filas)

#### `datosParaPdf(Formulario2 $formulario): array`
Prepara los datos para la vista PDF:
- Carga las lecturas con `$formulario->lecturas`
- Calcula estadísticas: mínimo, máximo, promedio de pH y temperatura
- Genera URLs de gráficos usando `buildChartUrl()`

#### `buildChartUrl(array $labels, array $data, string $label, string $color): string`
Genera un gráfico de líneas usando la API de **QuickChart.io**:

```php
$url = "https://quickchart.io/chart?c=" . urlencode(json_encode([
    'type' => 'line',
    'data' => [
        'labels' => $labels,
        'datasets' => [[
            'label' => $label,
            'data' => $data,
            'borderColor' => $color,
            'fill' => false,
        ]]
    ]
]));
```

- Descarga la imagen PNG de la URL
- La convierte a base64
- La embebe en el PDF como `data:image/png;base64,...`
- Si la API falla, devuelve una cadena vacía (el PDF se genera sin gráfico)

---

## Formulario3Service, Formulario6Service, Formulario7Service, Formulario8Service, Formulario9Service

`app/Services/Formularios/Formulario{3,6,7,8,9}Service.php`

Servicios especializados para cada formulario con campos y lógica propia.

Cada uno:
- Hereda de `BaseFormularioService`
- Implementa `guardar()`, `actualizar()`, `vistaPdf()`
- Tiene un método privado `llenarCamposFormulario()` que mapea los campos específicos del formulario desde el request al modelo

---

## Flujo Completo de Guardado

```
POST /registros/store/2
         ↓
RegistroController@store($request, tipo_form_id=2)
         ↓
DB::transaction {
    $registro = Registro::create([...datos del cliente...])
    // sube logo si existe
    FormularioFactory::make(2) → Formulario2Service
    Formulario2Service->guardar($request, $registro)
         ↓
    $formulario = new Formulario2()
    $formulario->registro_id = $registro->id
    $this->llenarCamposComunes($formulario, $request)
    $this->llenarCamposFormulario($formulario, $request)  // específico Form 2
    $this->guardarTablasDinamicas($formulario, $request, [...])
    $this->guardarAnexos($formulario, $request, 6)
    $formulario->save()
    $this->sincronizarLecturas($formulario, $request)
}
         ↓
redirect('/dashboard')->with('success', '...')
```

---

## Flujo Completo de Generación PDF

```
GET /registros/5/pdf
         ↓
RegistroController@pdf($id=5)
         ↓
$registro = Registro::find(5)  // con eager load del formulario
$servicio = FormularioFactory::make($registro->tipo_form_id)
$datos = $servicio->datosParaPdf($formulario)
         ↓
$pdf = Pdf::loadView('registros.pdf.formulario_2', $datos)
$pdf->setPaper('A4', 'portrait')
return $pdf->stream('informe.pdf')
```

---

## PdfChartGenerator

`app/Helpers/PdfChartGenerator.php`

Helper adicional para generación de gráficos en PDF. Complementa la funcionalidad de `Formulario2Service::buildChartUrl()` con métodos de utilidad reutilizables.
