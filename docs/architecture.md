# Arquitectura del Proyecto

## Resumen

SyA Group PHP es una aplicación web Laravel 12 para la gestión de registros de monitoreo ambiental. Permite crear informes con distintos formularios según el tipo de medición, adjuntar imágenes y exportarlos como PDF.

---

## Estructura de Directorios

```
sya_group_php/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/                      # Breeze: login, register, password reset
│   │   │   ├── RegistroController.php     # CRUD principal de registros + PDF
│   │   │   ├── UserController.php         # CRUD de usuarios (solo admin)
│   │   │   ├── ConfiguracionController.php # Equipos y modelos (solo admin)
│   │   │   └── ProfileController.php      # Perfil del usuario autenticado
│   │   ├── Middleware/
│   │   │   ├── AdminMiddleware.php        # Bloquea si no es admin
│   │   │   └── TecnicoMiddleware.php      # Bloquea si no es técnico
│   │   └── Requests/
│   │       ├── Auth/LoginRequest.php
│   │       └── ProfileUpdateRequest.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Registro.php                   # Registro principal (cabecera)
│   │   ├── Formulario1.php – Formulario9.php
│   │   ├── Formulario2Lectura.php         # Lecturas de pH/temperatura (Form 2)
│   │   ├── Equipo.php                     # Códigos de equipos
│   │   └── ModeloEquipo.php               # Modelos de equipos
│   ├── Services/Formularios/
│   │   ├── FormularioFactory.php          # Decide qué servicio usar
│   │   ├── BaseFormularioService.php      # Lógica compartida (anexos, tablas, etc.)
│   │   ├── FormularioGenericoService.php  # Para formularios sin lógica especial
│   │   ├── Formulario2Service.php         # Lecturas + gráficos QuickChart
│   │   ├── Formulario3Service.php
│   │   ├── Formulario6Service.php
│   │   ├── Formulario7Service.php
│   │   ├── Formulario8Service.php
│   │   └── Formulario9Service.php
│   ├── Helpers/
│   │   ├── helpers.php                    # fmt_num() para formato numérico
│   │   └── PdfChartGenerator.php          # Genera gráficos vía QuickChart.io
│   └── View/Components/
│       ├── AppLayout.php
│       └── GuestLayout.php
├── config/
│   ├── dompdf.php                         # Configuración del generador de PDF
│   └── ...                                # Configs estándar de Laravel
├── database/
│   ├── migrations/                        # 13 migraciones
│   └── database.sqlite                    # Base de datos local de desarrollo
├── resources/
│   ├── views/
│   │   ├── layouts/                       # app.blade.php, guest.blade.php
│   │   ├── components/                    # Componentes reutilizables UI
│   │   ├── auth/                          # Login, register, etc.
│   │   ├── dashboard.blade.php
│   │   ├── registros/
│   │   │   ├── create.blade.php           # Formulario de creación/edición
│   │   │   ├── includes/                  # formulario_1.blade.php … formulario_9.blade.php
│   │   │   └── pdf/                       # Vistas para PDF (1 por formulario)
│   │   ├── usuarios/
│   │   └── configuracion/
│   ├── css/
│   └── js/
├── routes/
│   ├── web.php                            # Rutas principales
│   └── auth.php                           # Rutas de autenticación (Breeze)
└── storage/app/public/                    # Archivos subidos (logos, anexos)
```

---

## Stack Tecnológico

### Backend

| Tecnología | Versión | Uso |
|------------|---------|-----|
| PHP | ^8.2 | Lenguaje base |
| Laravel | ^12.0 | Framework |
| Eloquent ORM | (incluido) | Acceso a base de datos |
| barryvdh/laravel-dompdf | ^3.1 | Generación de PDF |
| mpdf/mpdf | ^8.2 | PDF alternativo |
| intervention/image | ^3.11 | Procesamiento de imágenes |
| Laravel Breeze | ^2.3 | Andamiaje de autenticación |

### Frontend

| Tecnología | Versión | Uso |
|------------|---------|-----|
| TailwindCSS | ^3.1 | Estilos CSS utilitarios |
| Alpine.js | ^3.4 | Interactividad sin SPA |
| Axios | ^1.11 | Peticiones HTTP |
| Vite | ^7.0 | Empaquetado de assets |

### Base de Datos

| Entorno | Motor | Notas |
|---------|-------|-------|
| Desarrollo | SQLite | Archivo `database/database.sqlite` |
| Producción | MySQL | Configurar en `.env` |

---

## Patrones de Diseño

### 1. Factory Pattern — `FormularioFactory`

El componente central para la gestión de formularios. Recibe un `tipo_form_id` (1-9) y devuelve el servicio correspondiente.

```
RegistroController
      ↓
FormularioFactory::make($tipo_form_id)
      ↓
FormularioNService (o FormularioGenericoService)
      ↓
guardar() / actualizar() / vistaPdf()
```

Ventaja: agregar un nuevo tipo de formulario solo requiere crear un nuevo Service y registrarlo en la factory.

### 2. Service Layer — `BaseFormularioService`

Clase abstracta que centraliza la lógica repetida en todos los formularios:
- `guardarAnexos()` — sube imágenes corrigiendo orientación EXIF
- `guardarTablasDinamicas()` — persiste tablas en columnas JSON
- `llenarCamposComunes()` — mapea campos comunes del request al modelo
- `llenarFlagsPdf()` — configura flags de visualización en PDF

Cada formulario hereda esta clase y sobreescribe los métodos abstractos `guardar()`, `actualizar()` y `vistaPdf()`.

### 3. Dynamic Form Includes

La vista `registros/create.blade.php` incluye dinámicamente el partial correcto según el tipo de formulario seleccionado:

```blade
@include('registros.includes.formulario_' . $tipo_form_id)
```

El mismo patrón aplica para los PDFs:
```php
view('registros.pdf.formulario_' . $tipo_form_id, $datos)
```

### 4. Role-Based Access Control (RBAC)

Dos roles implementados como middleware:

```
Rutas admin → AdminMiddleware → verifica user->role === 'admin'
Rutas técnico → TecnicoMiddleware → verifica user->role === 'tecnico'
```

Los métodos `isAdmin()` e `isTecnico()` están en el modelo `User`.

---

## Flujo de Datos Principal

```
1. Usuario llena formulario (create.blade.php + includes/formulario_N.blade.php)
2. POST → RegistroController@store($request, $tipo_form_id)
3. DB::transaction {
     a. Se crea el Registro (cabecera con datos del cliente)
     b. Se guarda el logo del cliente si fue subido
     c. FormularioFactory::make($tipo_form_id)->guardar($request, $registro)
          - Se instancia el modelo FormularioN
          - Se llenan campos comunes
          - Se guardan campos específicos del formulario
          - Se procesan y guardan los anexos (imágenes)
          - Se guardan las tablas dinámicas como JSON
   }
4. Redirect al dashboard con mensaje de éxito
5. Para PDF: GET /registros/{id}/pdf
     a. RegistroController@pdf carga el Registro + FormularioN
     b. FormularioFactory::make($tipo)->datosParaPdf($formulario)
     c. Se renderiza view('registros.pdf.formulario_N', $datos)
     d. DomPDF genera el PDF y lo devuelve al navegador
```

---

## Helpers Globales

### `fmt_num(?float $value, int $decimals = 2): string`

Definido en `app/Helpers/helpers.php`. Formatea números con separador de miles con punto y decimales con coma (estándar latinoamericano).

```php
fmt_num(1234.567)    // → "1.234,57"
fmt_num(null)        // → "—"
fmt_num(0.5, 1)      // → "0,5"
```

Autoloadeado via `composer.json` → `autoload.files`.
