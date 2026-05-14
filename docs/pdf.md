# Generación de PDF

## Librería

El sistema usa **barryvdh/laravel-dompdf** (^3.1) como motor principal de PDF. Está disponible a través del facade `Pdf` de Laravel.

La configuración del motor está en `config/dompdf.php`.

---

## Flujo de Generación

1. El usuario hace clic en "Descargar PDF" en el dashboard
2. `GET /registros/{id}/pdf` → `RegistroController@pdf()`
3. El controlador carga el registro con su formulario asociado
4. Llama a `FormularioFactory::make($tipo)->datosParaPdf($formulario)` para enriquecer los datos
5. Renderiza la vista Blade correspondiente: `registros.pdf.formulario_N`
6. DomPDF convierte el HTML a PDF
7. Se devuelve al navegador como stream (vista inline) o descarga

```php
$pdf = Pdf::loadView('registros.pdf.formulario_' . $tipo, $datos)
          ->setPaper('A4', 'portrait');

return $pdf->stream('informe_' . $registro->codigo_informe . '.pdf');
```

---

## Vistas PDF

Cada tipo de formulario tiene su propia vista PDF en:
```
resources/views/registros/pdf/
├── formulario_1.blade.php
├── formulario_2.blade.php
├── formulario_3.blade.php
├── formulario_4.blade.php
├── formulario_5.blade.php
├── formulario_6.blade.php
├── formulario_7.blade.php
├── formulario_8.blade.php
└── formulario_9.blade.php
```

Estas vistas son **HTML puro** con estilos inline o `<style>` embebidos — no usan TailwindCSS ni Alpine.js porque DomPDF renderiza HTML/CSS estático.

---

## Estructura Típica de una Vista PDF

```blade
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        /* Estilos inline para DomPDF */
        body { font-family: DejaVu Sans, sans-serif; font-size: 10px; }
        table { width: 100%; border-collapse: collapse; }
        /* ... */
    </style>
</head>
<body>
    {{-- Cabecera con logo y datos del informe --}}
    <table>
        <tr>
            <td>
                @if($registro->logo_cliente)
                    <img src="{{ public_path('storage/' . $registro->logo_cliente) }}" 
                         style="max-height: 60px;">
                @endif
            </td>
            <td>
                <strong>{{ $registro->titulo_informe }}</strong><br>
                Código: {{ $registro->codigo_informe }}
            </td>
        </tr>
    </table>

    {{-- Datos del formulario --}}
    <h3>1. Información General</h3>
    <table>
        <tr>
            <td>Inspector:</td>
            <td>{{ $formulario->inspector_nombre }}</td>
        </tr>
        {{-- ... más campos --}}
    </table>

    {{-- Tablas dinámicas --}}
    @foreach($formulario->equipos_detalle as $equipo)
        <tr>
            <td>{{ $equipo['codigo'] }}</td>
        </tr>
    @endforeach

    {{-- Anexos fotográficos --}}
    @if($formulario->anexo_1_file)
        <div style="page-break-inside: avoid;">
            <h4>{{ $formulario->anexo_1_titulo }}</h4>
            <img src="{{ public_path('storage/' . $formulario->anexo_1_file) }}"
                 style="max-width: 100%;">
        </div>
    @endif
</body>
</html>
```

---

## Gráficos en PDF (Formulario 2)

El formulario 2 incluye gráficos de líneas de pH y temperatura. Como DomPDF no puede renderizar JavaScript ni canvas, los gráficos se generan como imágenes externas:

### Proceso:

1. `Formulario2Service::buildChartUrl()` construye la URL de la API de QuickChart.io
2. Se hace una petición HTTP a QuickChart para obtener la imagen PNG
3. La imagen se convierte a base64
4. Se embebe en el HTML como `data:image/png;base64,...`

```php
$chartConfig = [
    'type' => 'line',
    'data' => [
        'labels' => $labels,  // ['08:00', '09:00', '10:00', ...]
        'datasets' => [[
            'label' => 'pH',
            'data' => $valores,
            'borderColor' => 'rgb(59, 130, 246)',
            'fill' => false,
        ]]
    ],
    'options' => [
        'scales' => ['y' => ['beginAtZero' => false]]
    ]
];

$url = 'https://quickchart.io/chart?c=' . urlencode(json_encode($chartConfig));
$imageData = file_get_contents($url);
$base64 = 'data:image/png;base64,' . base64_encode($imageData);
```

En la vista PDF:
```blade
@if($graficoPh)
    <img src="{{ $graficoPh }}" style="width: 100%; max-height: 200px;">
@endif
```

**Fallback:** Si la API de QuickChart no responde, la variable estará vacía y el gráfico simplemente no aparece, pero el PDF se genera igual.

---

## Imágenes en PDF

### Logo del cliente
```blade
<img src="{{ public_path('storage/' . $registro->logo_cliente) }}">
```

DomPDF requiere rutas absolutas del sistema de archivos, no URLs. Por eso se usa `public_path()` en lugar de `asset()` o `Storage::url()`.

### Anexos fotográficos
Mismo patrón:
```blade
<img src="{{ public_path('storage/' . $formulario->anexo_N_file) }}">
```

---

## Configuración de DomPDF

`config/dompdf.php` — opciones relevantes:

```php
'options' => [
    'font_dir'            => storage_path('fonts/'),
    'font_cache'          => storage_path('fonts/'),
    'temp_dir'            => sys_get_temp_dir(),
    'chroot'              => realpath(base_path()),
    'isRemoteEnabled'     => true,   // Necesario para cargar imágenes externas
    'isPhpEnabled'        => false,
    'defaultFont'         => 'serif',
    'defaultPaperSize'    => 'a4',
    'defaultPaperOrientation' => 'portrait',
    'dpi'                 => 96,
    'isFontSubsettingEnabled' => true,
    'isHtml5ParserEnabled'    => true,
]
```

`isRemoteEnabled: true` es necesario para cargar las imágenes del storage via `file://`.

---

## Fuentes en PDF

DomPDF soporta fuentes estándar y puede cargar fuentes custom. La fuente recomendada para compatibilidad UTF-8 en español es **DejaVu Sans**:

```css
body {
    font-family: 'DejaVu Sans', sans-serif;
}
```

Esta fuente viene incluida en DomPDF.

---

## Saltos de Página

Para controlar saltos de página en el PDF:

```css
/* Forzar salto ANTES del elemento */
.nueva-pagina {
    page-break-before: always;
}

/* Evitar que el elemento se corte entre páginas */
.sin-corte {
    page-break-inside: avoid;
}
```

Los anexos fotográficos generalmente usan `page-break-inside: avoid` para que la imagen y su título queden en la misma página.
