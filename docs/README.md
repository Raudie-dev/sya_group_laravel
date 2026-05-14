# SyA Group PHP — Documentación del Proyecto

Sistema de gestión y generación de informes de monitoreo ambiental, desarrollado en **Laravel 12**.

---

## Índice de Documentación

| Documento | Descripción |
|-----------|-------------|
| [Arquitectura](./architecture.md) | Estructura del proyecto, stack tecnológico y patrones de diseño |
| [Base de Datos](./database.md) | Esquema completo de tablas, columnas y relaciones |
| [Rutas & Controladores](./routes-controllers.md) | Referencia completa de rutas y qué hace cada controlador |
| [Formularios](./forms.md) | Los 9 tipos de formulario, sus campos y propósito |
| [Capa de Servicios](./services.md) | Patrón Factory/Service y lógica de negocio |
| [Generación de PDF](./pdf.md) | Cómo se generan los PDFs y las vistas involucradas |
| [Roles y Permisos](./roles.md) | Sistema de roles (admin/técnico) y middleware |
| [Desarrollo y Despliegue](./development.md) | Setup local, comandos útiles y variables de entorno |

---

## Vista Rápida del Sistema

```
Usuario → Autenticación → Dashboard → Crear/Editar Registro
                                            ↓
                              Seleccionar tipo de formulario (1-9)
                                            ↓
                              Llenar datos del cliente + formulario
                                            ↓
                              Guardar (FormularioFactory → Service)
                                            ↓
                              Exportar PDF (vistas /pdf/formulario_N)
```

### Stack Principal

- **Backend:** Laravel 12, PHP 8.2+, Eloquent ORM
- **Frontend:** TailwindCSS 3, Alpine.js 3, Vite 7
- **PDF:** barryvdh/laravel-dompdf + mpdf/mpdf
- **Imágenes:** intervention/image (GD driver)
- **Auth:** Laravel Breeze
- **Base de Datos:** SQLite (dev) / MySQL (prod)
