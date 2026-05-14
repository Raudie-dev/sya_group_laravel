# Desarrollo y Despliegue

## Requisitos

| Herramienta | Versión mínima |
|-------------|---------------|
| PHP | 8.2+ |
| Composer | 2.x |
| Node.js | 18+ |
| npm | 9+ |
| XAMPP / servidor web | Apache o Nginx |

---

## Setup Inicial

### 1. Instalar dependencias

```bash
composer install
npm install
```

### 2. Configurar entorno

```bash
cp .env.example .env
php artisan key:generate
```

### 3. Configurar la base de datos

**Para desarrollo con SQLite (por defecto):**
```bash
# El archivo ya existe en database/database.sqlite
# Solo ejecutar migraciones
php artisan migrate
```

**Para MySQL:**
Editar `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sya_group
DB_USERNAME=root
DB_PASSWORD=
```
Luego:
```bash
php artisan migrate
```

### 4. Crear enlace de storage

```bash
php artisan storage:link
```

Esto crea `public/storage` → `storage/app/public/`, necesario para servir logos y anexos.

### 5. Compilar assets

```bash
# Desarrollo (con hot reload)
npm run dev

# Producción
npm run build
```

### Setup automático (todo en uno)

El `composer.json` incluye un script de setup:
```bash
composer setup
```
Ejecuta: `composer install`, copia `.env`, genera key, migra y compila assets.

---

## Iniciar el Servidor de Desarrollo

```bash
# Laravel dev server en http://localhost:8000
php artisan serve

# Vite dev server (hot reload para CSS/JS)
npm run dev

# Monitor de logs
php artisan pail

# Procesar colas
php artisan queue:listen
```

O todo junto con el script del composer:
```bash
composer dev
```
(Usa `concurrently` para lanzar todos en paralelo)

---

## Variables de Entorno Clave

`.env` — las más importantes a configurar:

```env
APP_NAME="SyA Group"
APP_ENV=local                    # local | production
APP_KEY=                         # Generado con key:generate
APP_DEBUG=true                   # false en producción
APP_URL=http://localhost:8000    # URL base de la app

# Base de datos
DB_CONNECTION=sqlite             # sqlite | mysql
# Para MySQL:
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sya_group
DB_USERNAME=root
DB_PASSWORD=

# Sesiones y caché (database es el default)
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

# Logs (daily = un archivo por día en storage/logs/)
LOG_CHANNEL=daily
LOG_LEVEL=debug                  # debug | info | warning | error

# Email (log = imprime en log en vez de enviar)
MAIL_MAILER=log
MAIL_FROM_ADDRESS="noreply@ejemplo.cl"
MAIL_FROM_NAME="SyA Group"

# Disco de archivos (public para storage/app/public/)
FILESYSTEM_DISK=local
```

---

## Comandos Artisan Útiles

```bash
# Ver todas las rutas
php artisan route:list

# Ver rutas filtrando por nombre
php artisan route:list --name=registro

# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Limpiar todo en uno
php artisan optimize:clear

# Generar un nuevo controlador
php artisan make:controller NombreController

# Generar un modelo con migración
php artisan make:model NombreModelo -m

# Generar un middleware
php artisan make:middleware NombreMiddleware

# Ver logs en tiempo real
php artisan pail

# Acceso a REPL interactivo
php artisan tinker
```

---

## Estructura de Logs

Los logs diarios se guardan en `storage/logs/laravel-YYYY-MM-DD.log`.

El `RegistroController` registra cada operación importante:

```php
Log::channel('daily')->info('Creando nuevo registro', [
    'tipo_form_id' => $tipo_form_id,
    'user_id' => auth()->id(),
]);

Log::channel('daily')->error('Error al guardar formulario', [
    'error' => $e->getMessage(),
    'trace' => $e->getTraceAsString(),
]);
```

---

## Compilación de Assets

### Desarrollo
```bash
npm run dev
```
Inicia Vite en modo watch. Los cambios en CSS/JS se aplican en tiempo real con HMR (Hot Module Replacement).

### Producción
```bash
npm run build
```
Genera archivos optimizados en `public/build/`. El manifest en `public/build/manifest.json` es usado por Blade para referenciar los assets con hash.

**En la vista Blade:**
```blade
{{-- Esto se transforma automáticamente en la URL con hash correcto --}}
@vite(['resources/css/app.css', 'resources/js/app.js'])
```

---

## Testing

```bash
# Ejecutar todos los tests
php artisan test
# o
vendor/bin/phpunit

# Ejecutar un test específico
php artisan test --filter NombreDelTest

# Con coverage
php artisan test --coverage
```

Los tests están en `tests/`:
- `tests/Unit/` — tests unitarios
- `tests/Feature/` — tests de integración (incluye tests de auth de Breeze)

---

## Despliegue en Producción

### Checklist de producción

```bash
# 1. Instalar dependencias sin devDependencies
composer install --no-dev --optimize-autoloader

# 2. Compilar assets
npm ci
npm run build

# 3. Configurar .env
APP_ENV=production
APP_DEBUG=false

# 4. Optimizar
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# 5. Migraciones
php artisan migrate --force

# 6. Storage link
php artisan storage:link

# 7. Permisos de directorios (Linux/Mac)
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Con XAMPP (Windows)

1. Colocar el proyecto en `C:\xampp\htdocs\sya_group_php\`
2. Configurar Apache para servir `public/` como raíz del documento
3. Habilitar `mod_rewrite` para las rutas de Laravel
4. Asegurarse de que `APP_URL` apunte al dominio correcto

**VirtualHost recomendado:**
```apache
<VirtualHost *:80>
    DocumentRoot "C:/xampp-actual-v2/htdocs/sya_group_php/public"
    ServerName sya.local

    <Directory "C:/xampp-actual-v2/htdocs/sya_group_php/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

---

## Extensiones PHP Requeridas

```
php_curl         → Para QuickChart (gráficos en PDF)
php_gd           → Para Intervention Image (procesamiento de fotos)
php_pdo_sqlite   → Para SQLite (desarrollo)
php_pdo_mysql    → Para MySQL (producción)
php_mbstring     → Strings multibyte
php_xml          → Parser XML
php_zip          → Archivos ZIP
php_fileinfo     → Detección de tipo de archivo
```

En XAMPP, estas extensiones se habilitan en `php.ini` descomentando las líneas `extension=...` correspondientes.

---

## Troubleshooting Frecuente

### "No such file or directory: database.sqlite"
```bash
touch database/database.sqlite
php artisan migrate
```

### Las imágenes no aparecen en PDF
```bash
# Verificar que existe el enlace simbólico
php artisan storage:link
# Verificar que isRemoteEnabled está en true en config/dompdf.php
```

### Errores de permisos en storage
```bash
# Windows (como administrador)
icacls storage /grant "IUSR:(OI)(CI)F"
icacls bootstrap/cache /grant "IUSR:(OI)(CI)F"

# Linux/Mac
chmod -R 775 storage bootstrap/cache
```

### Los assets no cargan (404 en CSS/JS)
```bash
npm run build   # o npm run dev para desarrollo
php artisan view:clear
```

### Error 419 (CSRF Token)
- Verificar que `APP_KEY` está configurado en `.env`
- Limpiar sesiones: `php artisan session:table` y re-migrar
- Verificar que el formulario tiene `@csrf`
