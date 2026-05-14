# Rutas y Controladores

## Mapa de Rutas

### Rutas Públicas

| Método | URI | Controlador | Descripción |
|--------|-----|-------------|-------------|
| GET | `/` | *(view)* | Página de bienvenida |

---

### Rutas de Autenticación (middleware: `guest`)

Gestionadas por Laravel Breeze en `routes/auth.php`.

| Método | URI | Controlador | Descripción |
|--------|-----|-------------|-------------|
| GET | `/register` | `RegisteredUserController@create` | Formulario de registro |
| POST | `/register` | `RegisteredUserController@store` | Crear usuario |
| GET | `/login` | `AuthenticatedSessionController@create` | Formulario de login |
| POST | `/login` | `AuthenticatedSessionController@store` | Autenticar |
| GET | `/forgot-password` | `PasswordResetLinkController@create` | Solicitar reset |
| POST | `/forgot-password` | `PasswordResetLinkController@store` | Enviar email de reset |
| GET | `/reset-password/{token}` | `NewPasswordController@create` | Formulario de nueva contraseña |
| POST | `/reset-password` | `NewPasswordController@store` | Actualizar contraseña |

---

### Rutas Protegidas (middleware: `auth`)

#### Sesión y Perfil

| Método | URI | Controlador | Descripción |
|--------|-----|-------------|-------------|
| POST | `/logout` | `AuthenticatedSessionController@destroy` | Cerrar sesión |
| GET | `/profile` | `ProfileController@edit` | Ver perfil |
| PATCH | `/profile` | `ProfileController@update` | Actualizar perfil |
| DELETE | `/profile` | `ProfileController@destroy` | Eliminar cuenta |
| GET | `/verify-email` | `EmailVerificationPromptController` | Prompt verificación |
| GET | `/verify-email/{id}/{hash}` | `VerifyEmailController` | Verificar email |
| POST | `/email/verification-notification` | `EmailVerificationNotificationController` | Reenviar verificación |
| GET | `/confirm-password` | `ConfirmablePasswordController@show` | Confirmar contraseña |
| POST | `/confirm-password` | `ConfirmablePasswordController@store` | Verificar contraseña |
| PUT | `/password` | `PasswordController@update` | Cambiar contraseña |

#### Dashboard y Registros (middleware: `auth`, `verified`)

| Método | URI | Controlador | Descripción |
|--------|-----|-------------|-------------|
| GET | `/dashboard` | `RegistroController@index` | Dashboard principal |
| GET | `/registros` | `RegistroController@index` | Lista de registros con filtros |
| GET | `/registros/create/{tipo_form_id?}` | `RegistroController@create` | Formulario de creación |
| POST | `/registros/store/{tipo_form_id?}` | `RegistroController@store` | Guardar nuevo registro |
| GET | `/registros/{registro}/edit` | `RegistroController@edit` | Formulario de edición |
| PUT | `/registros/{registro}` | `RegistroController@update` | Actualizar registro |
| DELETE | `/registros/{registro}` | `RegistroController@destroy` | Eliminar registro |
| GET | `/registros/{registro}/pdf` | `RegistroController@pdf` | Generar y descargar PDF |

---

### Rutas Solo Admin (middleware: `auth` + `AdminMiddleware`)

#### Usuarios

| Método | URI | Controlador | Descripción |
|--------|-----|-------------|-------------|
| GET | `/usuarios` | `UserController@index` | Lista de usuarios |
| GET | `/usuarios/create` | `UserController@create` | Formulario crear usuario |
| POST | `/usuarios` | `UserController@store` | Crear usuario |
| GET | `/usuarios/{usuario}/edit` | `UserController@edit` | Editar usuario |
| PUT | `/usuarios/{usuario}` | `UserController@update` | Actualizar usuario |
| DELETE | `/usuarios/{usuario}` | `UserController@destroy` | Eliminar usuario |

#### Configuración

| Método | URI | Controlador | Descripción |
|--------|-----|-------------|-------------|
| GET | `/configuracion` | `ConfiguracionController@index` | Panel de configuración |
| GET | `/configuracion/equipos/api` | `ConfiguracionController@apiEquipos` | JSON: lista de equipos activos |
| POST | `/configuracion/equipos` | `ConfiguracionController@store` | Crear equipo |
| PUT | `/configuracion/equipos/{equipo}` | `ConfiguracionController@update` | Actualizar equipo |
| DELETE | `/configuracion/equipos/{equipo}` | `ConfiguracionController@destroy` | Eliminar equipo |
| POST | `/configuracion/modelos` | `ConfiguracionController@storeModelo` | Crear modelo |
| PUT | `/configuracion/modelos/{modelo}` | `ConfiguracionController@updateModelo` | Actualizar modelo |
| DELETE | `/configuracion/modelos/{modelo}` | `ConfiguracionController@destroyModelo` | Eliminar modelo |

---

## Controladores

### RegistroController

`app/Http/Controllers/RegistroController.php`

El controlador principal de la aplicación.

#### `index(Request $request)`
- Muestra el dashboard y la lista de registros
- Acepta filtros GET: `titulo`, `codigo`, `empresa`, `proyecto`, `fecha_desde`, `fecha_hasta`
- Paginación configurable: 10, 25, 50, 100 por página
- Ordena por `created_at` descendente

#### `create($tipo_form_id = 1)`
- Prepara la vista de creación
- Carga la lista de equipos activos y modelos activos
- Pasa el `tipo_form_id` a la vista para renderizar el partial correcto

#### `store(Request $request, $tipo_form_id = null)`
- Envuelto en `DB::transaction`
- Crea el `Registro` con datos del cliente
- Sube y guarda el logo si fue enviado
- Delega al servicio: `FormularioFactory::make($tipo)->guardar($request, $registro)`
- Registra en log cada paso

#### `edit($id)`
- Carga el `Registro` con su formulario asociado
- Pasa los datos a la vista con los valores previos para edición

#### `update(Request $request, $id)`
- Envuelto en `DB::transaction`
- Actualiza el `Registro`
- Maneja reemplazo de logo (borra el anterior)
- Delega al servicio: `FormularioFactory::make($tipo)->actualizar($request, $registro)`

#### `destroy($id)`
- Borra el `Registro` (las FK con cascade borran el formulario)
- Borra el logo del storage si existe

#### `pdf($id)`
- Carga el registro con su formulario
- Obtiene datos enriquecidos del servicio: `datosParaPdf($formulario)`
- Renderiza la vista `registros.pdf.formulario_N`
- Genera el PDF con DomPDF y lo devuelve inline

---

### UserController

`app/Http/Controllers/UserController.php`

Solo accesible para admin.

#### Validaciones en `store()`:
```php
'name'     => 'required|string|max:255',
'email'    => 'required|email|unique:users',
'role'     => 'required|in:admin,tecnico',
'password' => 'required|min:8|confirmed',
```

#### Validaciones en `update()`:
- `password` es nullable (se omite si no se envía)
- `email` excluye el usuario actual del unique check

#### Protección en `destroy()`:
- Lanza error si el admin intenta borrarse a sí mismo

---

### ConfiguracionController

`app/Http/Controllers/ConfiguracionController.php`

Solo accesible para admin.

#### Equipos
- Los códigos se normalizan a **mayúsculas** antes de guardar
- Se activan automáticamente al crear (`activo = true`)
- `apiEquipos()` devuelve JSON: `[{id, codigo}, ...]` de equipos activos
  - Usado por Alpine.js en los selects de formularios

#### Modelos
- Misma lógica que equipos pero para modelos de equipo
- `apiModelos()` devuelve JSON: `[{id, nombre}, ...]`

#### Mensajes de validación en español:
```php
'codigo.required'  => 'El código del equipo es requerido.',
'codigo.unique'    => 'Este código ya existe.',
'nombre.required'  => 'El nombre del modelo es requerido.',
// ...
```

---

### ProfileController

`app/Http/Controllers/ProfileController.php`

Permite a cualquier usuario autenticado editar su nombre, email y contraseña, o eliminar su propia cuenta.

---

## Middleware Personalizado

### AdminMiddleware

`app/Http/Middleware/AdminMiddleware.php`

```php
if (!auth()->check() || auth()->user()->role !== 'admin') {
    abort(403);
}
```

Aplicado al grupo de rutas de usuarios y configuración.

### TecnicoMiddleware

`app/Http/Middleware/TecnicoMiddleware.php`

Similar al anterior pero verifica el rol `'tecnico'`. Disponible para futuras rutas exclusivas de técnicos.
