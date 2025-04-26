# Qodex 📚

**Qodex** es una API REST desarrollada con Laravel, creada como prueba técnica para la empresa **Qaroni**.  
Permite la gestión de libros y autores en una biblioteca digital, incluyendo autenticación por roles, exportación de estadísticas y un panel administrativo moderno con **FilamentPHP**.  
El entorno está completamente **dockerizado** para un despliegue rápido y profesional.

---

## 🚀 Tecnologías utilizadas

- Laravel 10
- PHP 8.2 (FPM)
- MySQL 8
- Docker & Docker Compose
- Nginx
- FilamentPHP
- Laravel Excel
- Swagger (pendiente de integración)

---

## 🧱 Estructura del proyecto

```
QODEX/
├── docker/
│   ├── nginx/
│   │   └── default.conf
│   └── php/
│       └── Dockerfile
├── .gitignore
├── docker-compose.yml
├── Makefile
├── LICENSE
├── README.md
└── (Laravel instalado en volumen Docker: qodex_laravel)
```

---

## ⚙️ Pasos para levantar el entorno

### 1. Clonar el repositorio

```bash
git clone https://github.com/tuusuario/qodex.git
cd qodex
```

### 2. Construir y levantar los contenedores

```bash
docker-compose up -d --build
```

### 3. Instalar Laravel dentro del contenedor

```bash
docker exec -it qodex_app bash
composer create-project laravel/laravel .
```

### 4. Configurar el entorno

```bash
cp .env.example .env
```

Editar el `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=mysql_db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret
```

Generar la clave de aplicación:

```bash
php artisan key:generate
```

### 5. Acceder a la aplicación

```text
http://localhost:8000
```

---

## ⚡ Automatización con Make (opcional)

```bash
make up           # Levanta contenedores
make install      # Instala Laravel y configura .env
make migrate      # Ejecuta migraciones
make bash         # Entra al contenedor PHP
make artisan      # Ejecuta comandos Artisan
make fix-perms    # Repara permisos
make export-src   # Exporta Laravel a src/
make down         # Detiene los contenedores
make restart      # Reinicia todo el entorno
```

---

## ✅ Posibles Funcionalidades previstas

- Gestión de usuarios con roles diferenciados (Directivo, Bibliotecario).
- CRUD de libros y autores (relación muchos a muchos).
- Panel administrativo con FilamentPHP.
- Exportación de datos en Excel.
- Documentación de endpoints con Swagger.

---

## 📝 Notas adicionales

- Laravel está instalado en el volumen Docker `qodex_laravel`.
- Para versionarlo localmente, ejecutar `make export-src`.
- Uso de `make fix-perms` para evitar errores de permisos en producción.

---

## 🛠️ Autor y créditos

> Desarrollado por **ikikidev** como parte del proceso técnico de selección para Qaroni.

---

🔐 Autenticación
La gestión de usuarios autenticados se maneja mediante FilamentPHP. Puedes crear usuarios administradores mediante:

```bash
make artisan make:filament-user
```

Acceso al panel: http://localhost:8000/admin/login

---

✅ Estado actual del proyecto

- [x] Docker funcionando con Laravel
- [x] Panel Filament operativo
- [x] Migraciones aplicadas (Users, Authors, Books)
- [x] Recursos Filament de Author y Book funcionando
- [ ] Roles y permisos por perfil
- [ ] Exportación a Excel
- [ ] Documentación Swagger completa