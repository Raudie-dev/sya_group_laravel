# Formularios de Monitoreo

El sistema soporta **9 tipos de formulario**, cada uno correspondiente a un tipo específico de inspección o medición ambiental. El tipo se selecciona al crear un registro y determina qué tabla de base de datos se usa, qué vista se renderiza y qué servicio maneja la lógica.

---

## Resumen de Tipos

| ID | Código | Nombre | Servicio |
|----|--------|--------|---------|
| 1 | RLI Puntual | Monitoreo puntual de agua | `FormularioGenericoService` |
| 2 | QEN_V4_INF | Control de calidad con lecturas múltiples | `Formulario2Service` |
| 3 | Informe de Terreno | Informe general de campo | `Formulario3Service` |
| 4 | QEN_SST | Evaluación de calidad y salud | `FormularioGenericoService` |
| 5 | QEN DS90 | Formulario de cumplimiento de descarga | `FormularioGenericoService` |
| 6 | DBO 5 - IDE | Medición de demanda biológica de oxígeno | `Formulario6Service` |
| 7 | Lista de Chequeo Pre-Campaña | Checklist antes de campaña | `Formulario7Service` |
| 8 | Lista de Chequeo Post-Campaña | Checklist después de campaña | `Formulario8Service` |
| 9 | CMCL - Control Medidor Cloro Libre | Control de cloro libre | `Formulario9Service` |

---

## Estructura Común de Todos los Formularios

### Datos del Cliente (en `registros`)
Todos los formularios comparten esta información en la cabecera:

- **Informe:** título, código, fecha de emisión
- **Empresa:** nombre, RUT
- **Representante:** nombre, RUN
- **Ubicación:** dirección, región, comuna
- **Proyecto:** nombre del proyecto, número de RCA
- **Logo:** imagen del cliente

### Campos Comunes en el Formulario Específico
- Nombre e identificación del inspector
- Lugar, dirección y punto de muestreo
- Fechas y horas de inicio y fin
- Equipos utilizados (código + modelo + verificación)
- Observaciones
- Anexos fotográficos (títulos + archivos de imagen)

---

## Detalle por Formulario

### Formulario 1 — RLI Puntual

**Propósito:** Registro de monitoreo puntual de agua.

**Campos específicos:**
- Equipos: muestreo, pH, temperatura, cloro (código + checkbox de verificación)
- Resultados iniciales y finales de: flujo, hora, pH, temperatura
- Tabla dinámica de equipos (`equipos_detalle` JSON)
- Tabla dinámica de mediciones (`mediciones_detalle` JSON)
- Hasta 4 anexos fotográficos

**Vista include:** `resources/views/registros/includes/formulario_1.blade.php`
**Vista PDF:** `resources/views/registros/pdf/formulario_1.blade.php`

---

### Formulario 2 — QEN_V4_INF

**Propósito:** Control de calidad con registro de múltiples lecturas de pH y temperatura a lo largo del tiempo.

**Características especiales:**
- Tabla de lecturas separada en BD (`formulario_2_lecturas`)
- Cada lectura tiene: fecha, hora, número de muestra, valor pH, valor temperatura
- El servicio `Formulario2Service` calcula estadísticas (mín/máx/promedio)
- Genera gráficos de líneas usando **QuickChart.io** API para el PDF
  - Un gráfico para pH
  - Un gráfico para temperatura
  - Los gráficos se embeben como imagen base64 en el PDF

**Vista include:** `resources/views/registros/includes/formulario_2.blade.php`
**Vista PDF:** `resources/views/registros/pdf/formulario_2.blade.php`

---

### Formulario 3 — Informe de Terreno

**Propósito:** Informe general de trabajo de campo.

**Características especiales:**
- Múltiples columnas JSON para estructuras de datos complejas
- Servicio `Formulario3Service` con lógica específica de mapeo

**Vista include:** `resources/views/registros/includes/formulario_3.blade.php`
**Vista PDF:** `resources/views/registros/pdf/formulario_3.blade.php`

---

### Formulario 4 — QEN_SST

**Propósito:** Evaluación de calidad en salud y seguridad.

Utiliza `FormularioGenericoService` — no tiene lógica especial.

**Vista include:** `resources/views/registros/includes/formulario_4.blade.php`
**Vista PDF:** `resources/views/registros/pdf/formulario_4.blade.php`

---

### Formulario 5 — QEN DS90

**Propósito:** Formulario de cumplimiento de normativa de descarga.

Utiliza `FormularioGenericoService` — no tiene lógica especial.

**Vista include:** `resources/views/registros/includes/formulario_5.blade.php`
**Vista PDF:** `resources/views/registros/pdf/formulario_5.blade.php`

---

### Formulario 6 — DBO 5 - IDE

**Propósito:** Medición de Demanda Biológica de Oxígeno (DBO5).

**Características especiales:**
- Servicio `Formulario6Service` con campos y lógica específica de DBO5

**Vista include:** `resources/views/registros/includes/formulario_6.blade.php`
**Vista PDF:** `resources/views/registros/pdf/formulario_6.blade.php`

---

### Formulario 7 — Lista de Chequeo Pre-Campaña

**Propósito:** Checklist de verificación antes del inicio de una campaña de muestreo.

**Características especiales:**
- Servicio `Formulario7Service`
- Campos orientados a verificaciones tipo checkbox/confirmación

**Vista include:** `resources/views/registros/includes/formulario_7.blade.php`
**Vista PDF:** `resources/views/registros/pdf/formulario_7.blade.php`

---

### Formulario 8 — Lista de Chequeo Post-Campaña

**Propósito:** Checklist de cierre después de finalizar una campaña.

**Características especiales:**
- Servicio `Formulario8Service`
- Simétrico al formulario 7 pero para el cierre

**Vista include:** `resources/views/registros/includes/formulario_8.blade.php`
**Vista PDF:** `resources/views/registros/pdf/formulario_8.blade.php`

---

### Formulario 9 — CMCL Control Medidor Cloro Libre

**Propósito:** Control y verificación del medidor de cloro libre.

**Características especiales:**
- Servicio `Formulario9Service`
- Campos específicos para medición de cloro libre

**Vista include:** `resources/views/registros/includes/formulario_9.blade.php`
**Vista PDF:** `resources/views/registros/pdf/formulario_9.blade.php`

---

## Cómo Agregar un Nuevo Tipo de Formulario

Para agregar un formulario 10 (por ejemplo):

1. **Migración:** Crear tabla `formulario_10` con sus columnas
   ```bash
   php artisan make:migration create_formulario_10_table
   ```

2. **Modelo:** Crear `app/Models/Formulario10.php`
   ```php
   class Formulario10 extends Model {
       protected $table = 'formulario_10';
       protected $fillable = [...];
   }
   ```

3. **Servicio:** Crear `app/Services/Formularios/Formulario10Service.php`
   ```php
   class Formulario10Service extends BaseFormularioService {
       public function guardar($request, $registro): void { ... }
       public function actualizar($request, $registro): void { ... }
       public function vistaPdf(): string { return 'registros.pdf.formulario_10'; }
   }
   ```

4. **Factory:** Registrar en `FormularioFactory.php`
   ```php
   10 => new Formulario10Service(),
   ```

5. **Modelo Registro:** Agregar al mapa de formularios en `app/Models/Registro.php`
   ```php
   public static $formularios = [
       ...
       10 => Formulario10::class,
   ];
   ```

6. **Vistas:**
   - Crear `resources/views/registros/includes/formulario_10.blade.php`
   - Crear `resources/views/registros/pdf/formulario_10.blade.php`

7. **Selector:** Agregar la opción al dropdown de tipo de formulario en `registros/create.blade.php`

---

## Manejo de Anexos

Todos los formularios soportan hasta 7 anexos fotográficos. El proceso:

1. El usuario sube una imagen (JPEG, PNG, etc.)
2. `BaseFormularioService::guardarAnexos()`:
   - Lee la orientación EXIF de la imagen
   - Corrige la rotación automáticamente con Intervention Image
   - Guarda en `storage/app/public/` como JPEG al 85% de calidad
   - Almacena el path relativo en la columna `anexo_N_file`
3. En el PDF, las imágenes se cargan desde el storage usando `public_path()`

Para acceder al archivo desde la web: `Storage::url($path)` o `asset('storage/' . $path)`.

---

## Tablas Dinámicas (JSON)

Algunos formularios tienen tablas con número variable de filas. Se manejan como arrays JSON:

**En el frontend (Alpine.js):** El usuario puede agregar/quitar filas dinámicamente.

**En el backend:** `BaseFormularioService::guardarTablasDinamicas()` recibe el array del request y lo serializa en la columna JSON correspondiente.

**En la vista PDF:** Se itera el array PHP para generar las filas de la tabla.

```blade
@foreach($formulario->equipos_detalle as $fila)
    <tr>
        <td>{{ $fila['codigo'] }}</td>
        <td>{{ $fila['modelo'] }}</td>
    </tr>
@endforeach
```
