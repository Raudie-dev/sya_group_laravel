# Base de Datos

## Motor y Configuración

| Entorno | Motor | Archivo/Host |
|---------|-------|--------------|
| Desarrollo | SQLite | `database/database.sqlite` |
| Producción | MySQL | `.env` → `DB_HOST`, `DB_DATABASE`, etc. |

La configuración de conexión vive en `config/database.php`. Para cambiar a MySQL en producción, se establecen las variables de entorno correspondientes.

---

## Diagrama de Relaciones

```
users
  └── (gestiona sesiones/autenticación)

registros
  ├── formulario_1        (1:1)
  ├── formulario_2        (1:1)
  │     └── formulario_2_lecturas  (1:N)
  ├── formulario_3        (1:1)
  ├── formulario_4        (1:1)
  ├── formulario_5        (1:1)
  ├── formulario_6        (1:1)
  ├── formulario_7        (1:1)
  ├── formulario_8        (1:1)
  └── formulario_9        (1:1)

equipos                   (tabla de configuración, independiente)
modelos_equipo            (tabla de configuración, independiente)
```

Todas las tablas `formulario_N` tienen una FK `registro_id` con `cascadeOnDelete`.

---

## Tablas

### `users`

| Columna | Tipo | Notas |
|---------|------|-------|
| `id` | bigint PK | Auto-increment |
| `name` | varchar(255) | |
| `email` | varchar(255) | Único |
| `email_verified_at` | timestamp | Nullable |
| `password` | varchar(255) | Bcrypt (12 rounds) |
| `role` | varchar | `'admin'` o `'tecnico'` |
| `remember_token` | varchar(100) | Nullable |
| `created_at` / `updated_at` | timestamp | |

---

### `registros`

Cabecera común para todos los formularios. Contiene datos del cliente y del proyecto.

| Columna | Tipo | Descripción |
|---------|------|-------------|
| `id` | bigint PK | |
| `tipo_form_id` | integer | Tipo de formulario (1-9) |
| `titulo_informe` | varchar | Título del informe |
| `codigo_informe` | varchar | Código único del informe |
| `fecha_emision` | date | Fecha de emisión |
| `empresa_nombre` | varchar | Nombre de la empresa cliente |
| `rut_empresa` | varchar | RUT de la empresa |
| `representante_nombre` | varchar | Nombre del representante |
| `representante_run` | varchar | RUN del representante |
| `cliente_direccion` | varchar | Dirección del cliente |
| `region` | varchar | Región |
| `comuna` | varchar | Comuna |
| `logo_cliente` | varchar | Path al logo (storage/app/public/) |
| `nombre_proyecto` | varchar | Nombre del proyecto |
| `n_rca` | varchar | Número de RCA |
| `created_at` / `updated_at` | timestamp | |

---

### `formulario_1`

Formulario RLI Puntual — monitoreo puntual de agua.

| Columna | Tipo | Descripción |
|---------|------|-------------|
| `id` | bigint PK | |
| `registro_id` | bigint FK | → registros.id (cascade) |
| `inspector_nombre` | varchar | Nombre del inspector |
| `inspector_rut` | varchar | RUT del inspector |
| `lugar_muestreo` | varchar | Lugar de muestreo |
| `direccion_muestreo` | varchar | Dirección |
| `punto_muestreo` | varchar | Punto de muestreo |
| `inicio_muestreo` | datetime | Inicio |
| `fin_muestreo` | datetime | Fin |
| `observaciones` | text | |
| `eq_muestreo_cod` | varchar | Código equipo muestreo |
| `eq_ph_cod` | varchar | Código equipo pH |
| `eq_temp_cod` | varchar | Código equipo temperatura |
| `eq_cloro_cod` | varchar | Código equipo cloro |
| `eq_*_check` | boolean | ¿Equipo verificado? (varios) |
| `r_f_inicio/fin` | varchar | Resultado flujo |
| `r_h_inicio/fin` | varchar | Resultado hora |
| `r_ph_inicio/fin` | varchar | Resultado pH |
| `r_t_inicio/fin` | varchar | Resultado temperatura |
| `equipos_detalle` | json | Tabla dinámica de equipos |
| `mediciones_detalle` | json | Tabla dinámica de mediciones |
| `anexo_1_titulo` … `anexo_4_titulo` | varchar | Títulos de anexos |
| `anexo_1_file` … `anexo_4_file` | varchar | Paths de archivos de anexos |
| `created_at` / `updated_at` | timestamp | |

---

### `formulario_2`

Formulario QEN_V4_INF — control de calidad con lecturas múltiples.

Campos similares al formulario 1 más:

| Columna | Tipo | Descripción |
|---------|------|-------------|
| `n_muestras` | integer | Número de muestras |
| *(campos adicionales propios del form)* | | |

---

### `formulario_2_lecturas`

Tabla de lecturas individuales vinculadas al formulario 2.

| Columna | Tipo | Descripción |
|---------|------|-------------|
| `id` | bigint PK | |
| `formulario2_id` | bigint FK | → formulario_2.id |
| `fecha` | date | Fecha de la lectura |
| `hora` | time | Hora de la lectura |
| `n_muestra` | varchar | Número de muestra |
| `valor_ph` | decimal | Valor de pH |
| `valor_temp` | decimal | Valor de temperatura |
| `created_at` / `updated_at` | timestamp | |

---

### `formulario_3` … `formulario_9`

Cada una tiene su propia estructura con campos específicos del tipo de inspección. Todas comparten:
- `registro_id` (FK con cascade)
- Campos de inspector
- Campos de equipos con checkboxes de verificación
- Columnas JSON para tablas dinámicas
- Campos de anexos (hasta 7 por formulario)

Para el detalle exacto de columnas de cada una, consultar las migraciones en `database/migrations/`.

---

### `equipos`

Catálogo de equipos disponibles para seleccionar en los formularios.

| Columna | Tipo | Descripción |
|---------|------|-------------|
| `id` | bigint PK | |
| `codigo` | varchar(50) | Código/serial único (uppercase) |
| `descripcion` | text | Descripción opcional |
| `activo` | boolean | true = disponible en selects |
| `created_at` / `updated_at` | timestamp | |

---

### `modelos_equipo`

Catálogo de modelos de equipos.

| Columna | Tipo | Descripción |
|---------|------|-------------|
| `id` | bigint PK | |
| `nombre` | varchar(100) | Nombre único del modelo |
| `descripcion` | text | Descripción opcional |
| `activo` | boolean | true = disponible en selects |
| `created_at` / `updated_at` | timestamp | |

---

### Tablas de soporte (Laravel)

| Tabla | Propósito |
|-------|-----------|
| `sessions` | Sesiones de usuario (driver: database) |
| `cache` / `cache_locks` | Caché de aplicación (driver: database) |
| `jobs` / `failed_jobs` | Cola de trabajos (driver: database) |

---

## Migraciones

Las migraciones están en `database/migrations/` ordenadas cronológicamente:

| Archivo | Qué hace |
|---------|----------|
| `0001_01_01_000000_create_users_table` | Tabla users, sessions, password_resets |
| `0001_01_01_000001_create_cache_table` | Tablas cache y cache_locks |
| `0001_01_01_000002_create_jobs_table` | Tablas jobs y failed_jobs |
| `2026_02_23_..._add_role_to_users_table` | Agrega columna `role` a users |
| `2026_02_25_..._create_registros_table` | Tabla registros |
| `2026_02_25_..._create_formulario_1_table` | Tabla formulario_1 |
| `2026_02_25_..._create_formulario_2_table` | Tabla formulario_2 y formulario_2_lecturas |
| `2026_02_26_..._add_anexos_to_formulario1` | Agrega columnas de anexos al form 1 |
| `2026_02_27_..._add_equipos_resultados_to_formulario_1` | Equipos y resultados form 1 |
| `2026_03_02_..._add_json_fields_to_formulario3` | Columnas JSON form 3 |
| `2026_03_16_..._add_json_columns_to_formulario3_table` | Más JSON form 3 |
| `2026_03_17_..._create_formulario6_table` | Tabla formulario_6 |
| *(otras migraciones de forms 4, 5, 7, 8, 9)* | |

### Comandos útiles

```bash
# Ejecutar migraciones
php artisan migrate

# Revertir y re-ejecutar
php artisan migrate:fresh

# Ver estado
php artisan migrate:status

# Crear nueva migración
php artisan make:migration nombre_de_la_migracion
```

---

## Notas sobre JSON

Varias columnas almacenan datos como JSON arrays para soportar tablas dinámicas (número variable de filas):

- `equipos_detalle` — lista de equipos con código, modelo, número de serie, etc.
- `mediciones_detalle` — lecturas o mediciones con múltiples columnas

En los modelos Eloquent estas columnas tienen el cast `array`:

```php
protected $casts = [
    'equipos_detalle'   => 'array',
    'mediciones_detalle' => 'array',
];
```

Esto permite trabajar con ellas directamente como arrays PHP.
