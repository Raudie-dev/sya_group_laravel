# Roles y Permisos

## Roles Disponibles

El sistema tiene dos roles de usuario:

| Rol | Valor en BD | Descripción |
|-----|-------------|-------------|
| Administrador | `admin` | Acceso total al sistema |
| Técnico | `tecnico` | Acceso a registros y formularios |

El rol se almacena en la columna `role` de la tabla `users`.

---

## Permisos por Rol

| Funcionalidad | Admin | Técnico |
|---------------|-------|---------|
| Ver dashboard | ✅ | ✅ |
| Crear registros | ✅ | ✅ |
| Editar registros | ✅ | ✅ |
| Eliminar registros | ✅ | ✅ |
| Descargar PDF | ✅ | ✅ |
| Ver lista de usuarios | ✅ | ❌ |
| Crear/editar/eliminar usuarios | ✅ | ❌ |
| Acceder a Configuración | ✅ | ❌ |
| Gestionar equipos | ✅ | ❌ |
| Gestionar modelos de equipos | ✅ | ❌ |
| Editar propio perfil | ✅ | ✅ |

---

## Implementación

### Modelo User

`app/Models/User.php`

```php
public function isAdmin(): bool
{
    return $this->role === 'admin';
}

public function isTecnico(): bool
{
    return $this->role === 'tecnico';
}
```

### AdminMiddleware

`app/Http/Middleware/AdminMiddleware.php`

Verificación en cada request a rutas protegidas:

```php
public function handle(Request $request, Closure $next): Response
{
    if (!auth()->check() || auth()->user()->role !== 'admin') {
        abort(403, 'Acceso no autorizado.');
    }
    return $next($request);
}
```

### TecnicoMiddleware

`app/Http/Middleware/TecnicoMiddleware.php`

Similar al anterior, verifica el rol `tecnico`. Disponible para asignar a rutas específicas de técnicos en el futuro.

### Aplicación en Rutas

`routes/web.php`:

```php
// Rutas solo para admin
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::resource('usuarios', UserController::class);
    Route::prefix('configuracion')->group(function () {
        Route::get('/', [ConfiguracionController::class, 'index']);
        // ...
    });
});
```

### Menú de Navegación

`resources/views/layouts/navigation.blade.php` usa Blade para mostrar/ocultar items del menú según el rol:

```blade
@if(auth()->user()->isAdmin())
    <x-nav-link href="{{ route('usuarios.index') }}">Usuarios</x-nav-link>
    <x-nav-link href="{{ route('configuracion.index') }}">Configuración</x-nav-link>
@endif
```

---

## Gestión de Usuarios (Admin)

### Crear usuario

`POST /usuarios` — `UserController@store`

Reglas de validación:
```php
'name'                  => 'required|string|max:255',
'email'                 => 'required|email|unique:users',
'role'                  => 'required|in:admin,tecnico',
'password'              => 'required|min:8|confirmed',
'password_confirmation' => 'required',
```

### Editar usuario

`PUT /usuarios/{usuario}` — `UserController@update`

- El campo `password` es opcional: si no se envía, se mantiene la contraseña actual
- El campo `email` verifica unicidad ignorando el propio usuario:
  ```php
  'email' => 'required|email|unique:users,email,' . $usuario->id,
  ```

### Eliminar usuario

`DELETE /usuarios/{usuario}` — `UserController@destroy`

**Protección importante:** Un admin no puede eliminar su propia cuenta:
```php
if ($usuario->id === auth()->id()) {
    return back()->withErrors(['error' => 'No puedes eliminar tu propia cuenta.']);
}
```

---

## Registro Inicial

El primer usuario debe crearse directamente en la base de datos o mediante el seeder. Luego ese usuario admin puede crear los demás usuarios desde el panel.

### Via Artisan Tinker
```bash
php artisan tinker
```
```php
User::create([
    'name'     => 'Administrador',
    'email'    => 'admin@ejemplo.cl',
    'password' => bcrypt('contraseña_segura'),
    'role'     => 'admin',
]);
```

---

## Verificación de Email

El sistema tiene verificación de email habilitada (Laravel Breeze). Las rutas del dashboard requieren el middleware `verified`.

Si un usuario no ha verificado su email:
- Es redirigido a `/verify-email`
- Se le muestra un prompt para reenviar el correo de verificación
- El reenvío tiene rate limiting: máximo 6 intentos por minuto

Para ambientes de desarrollo se puede omitir la verificación eliminando el middleware `verified` de las rutas o usando `MustVerifyEmail` condicional en el modelo User.
