# 📚 Qodex 

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-10-E62314?logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8\.2-E83715?logo=php)
![Dockerized](https://img.shields.io/badge/Dockerized-Yes-EA4C15?logo=docker)
![Makefile](https://img.shields.io/badge/Automation-Makefile-EC6116)
![FilamentPHP](https://img.shields.io/badge/FilamentPHP-3\.0-ED7517?logo=filament)
![Swagger](https://img.shields.io/badge/Swagger-Documentation-EF8A17?logo=swagger)
![License](https://img.shields.io/badge/License-MIT-F19E18)

</div>

**Qodex** es una API REST desarrollada con Laravel, creada como prueba técnica para la empresa **Qaroni**.  
Permite la gestión de libros y autores en una biblioteca digital, incluyendo autenticación por roles, exportación de estadísticas y un panel administrativo moderno con FilamentPHP.  
El entorno está completamente **dockerizado** para un despliegue rápido y profesional.

✅ Por simplicidad, todos los usuarios que se registren desde el formulario serán bibliotecarios.
✅ Solo un admin podrá cambiar manualmente a "directivo" si es necesario.
✅ Así evitamos riesgos de que cualquier persona se autoproclame directivo desde fuera.

---

## 📝 Requisitos previos

Antes de comenzar, asegúreate de tener instalado:

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/)
- [Make](https://www.gnu.org/software/make/)

### ℹ️ Instalar Make en Windows

En Windows, Make no viene instalado por defecto. Puedes instalarlo utilizando:

- **Chocolatey**:
  ```bash
  choco install make
  ```

- **Scoop**:
  ```bash
  scoop install make
  ```

También puedes usar WSL2 si prefieres un entorno Linux completo en Windows.

---

## 🚀 Tecnologías utilizadas

- Laravel 10
- PHP 8.2 (FPM)
- MySQL 8
- Docker & Docker Compose
- Nginx
- FilamentPHP
- Laravel Excel
- Swagger (documentación en progreso)

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
└── src/ (código Laravel local)
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
make up
```

### 3. Instalar Laravel dentro del contenedor

```bash
make install
```

### 4. Configurar el entorno

Editar `.env`:

```
DB_CONNECTION=mysql
DB_HOST=mysql_db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret
```

Generar la clave de aplicación:

```bash
make artisan key:generate
```

### 5. Acceso a la aplicación

```text
http://localhost:8000
```

Deberías ver la página de bienvenida de Laravel.

### 6. Instalación de FilamentPHP (panel de administración)

```bash
make filament-install
```

Acceder a:

```text
http://localhost:8000/admin
```

Para crear un usuario administrador:

```bash
make artisan make:filament-user
```

### 7. Instalación de Spatie Laravel-Permission (gestión de roles)

```bash
make spatie-install
```
---

## 📚 Documentación de la API

Este proyecto incluye documentación automática de los endpoints públicos usando **Swagger** gracias a L5-Swagger.

- **URL para visualizar la documentación**:  
  👉 [http://localhost:8000/api/documentation](http://localhost:8000/api/documentation/default)

- **Endpoints documentados**:
  - Listado de Libros públicos
  - Detalles de Autores públicos
  - Registro de nuevos usuarios (Bibliotecarios y Directivos)

- **Modelos disponibles en la especificación**:
  - **Libro** (`Book`)
  - **Autor** (`Author`)
  - **Usuario** (`User`)

- **Formato de la documentación**: OpenAPI 3.0.0

- **Servidor de desarrollo**: `http://localhost:8000/api`

### Capturas de la documentación Swagger

> ![Swagger UI Principal](./img/swagger-ui-principal.jpg)

> ![Modelos en Swagger 1](./img/swagger-modelos-1.jpg)

> ![Modelos en Swagger 1](./img/swagger-modelos-2.jpg)
---

> ⚡ **Nota**: Recuerda regenerar la documentación cuando modifiques las anotaciones ejecutando:
> ```bash
> php artisan l5-swagger:generate
> ```


---

## ⚡ Automatización con Make

```text
make up                # Levanta los contenedores
make install           # Instala Laravel desde cero
make migrate           # Ejecuta las migraciones
make seed              # Ejecuta los seeders
make down              # Detiene y elimina los contenedores
make restart           # Reinicia el entorno
make artisan <cmd>     # Ejecuta comandos artisan
make bash              # Accede al contenedor
make logs              # Ver los logs del contenedor
make fix-perms         # Repara permisos en Laravel
make export-src        # Copia el código del volumen a ./src
make pull-code         # Copia el código desde ./src al volumen Docker
make filament-install  # Instala FilamentPHP
make spatie-install    # Instala Spatie Laravel-Permission
make refresh           # Ejecuta fresh migrations + seeders
```
---
## 🛠️ Funcionalidades implementadas en la prueba técnica

- **Entorno Dockerizado:** configuración completa con nginx, php-fpm, mysql y volumenes sincronizados.

- **Instalación automatizada con Makefile:** levantar, instalar y administrar el proyecto con simples comandos make.

- **Backend en Laravel 10:** desarrollo desde cero.

- **Autenticación completa:**

  - Registro y login de usuarios.

  - Hash de contraseñas seguro.

- **Roles de usuarios con Spatie Laravel-Permission:**

  - Roles: Directivo, Bibliotecario.

  - Asignación automática de rol Bibliotecario al registrarse.

- **Panel de Administración:**

  - Implementado usando FilamentPHP.

  - Acceso controlado por políticas de autorización.

- **Control de Acceso con Policies:**

  - Restringido crear/editar/borrar libros y autores según rol.

- **CRUD completo de:**

  - Libros.

  - Autores (relación muchos a muchos).

- **Sistema de seeders:**

  - Generación automática de libros con autores aleatorios sin duplicados.

- **Documentación de la API:**

  - Documentada con Swagger y accesible desde el navegador.

---

## ✅ Funcionalidades previstas

- [x] Gestión de usuarios con roles diferenciados (Directivo, Bibliotecario, Anónimo).
- [x] CRUD de libros y autores (relación muchos a muchos).
- [x] Panel administrativo con FilamentPHP.
- [x] Exportación de datos en Excel.
- [x] Documentación de endpoints con Swagger.
- [x] Sistema de autenticación y registro de usuarios.

---

## 📋 Notas adicionales

- Laravel vive en el volumen `qodex_laravel` pero el código se sincroniza con `./src` para poder editar localmente.
- Utiliza `make export-src` para copiar el contenido del volumen Docker a `./src`.
- Utiliza `make pull-code` para aplicar cambios hechos en `./src` al volumen.
- Usa `make fix-perms` si encuentras errores de permisos.

---

## 🧪 Cómo probar rápidamente

### 1. Levantar el entorno

```bash
make up
make install
make migrate
make seed
```

### 2. Acceder a la app
Ir a http://localhost:8000.

![](img/publico.png)
![](img/autor-publico.png)

> Como usuario anonimo o no registrado puedes ver el listado de libros y autores de la biblioteca

### 3. Registrarte como nuevo usuario
Usa el formulario de registro. Se te asignará automáticamente el rol de Bibliotecario.

### 4. Acceder al panel de administración
Ir a http://localhost:8000/admin y autenticarte.

### 5. Gestionar datos

- Crear, editar o eliminar Autores.
![](img/listado-autores.png)
![](img/create-autor.png)
![](img/editar-autor.png)

- Crear, editar o eliminar Libros.
![](img/listado-libros.png)
![](img/crear-libro.png)
![](img/editar-libro.png)

- Ver relaciones entre autores y libros.

### 6. Probar permisos

- Solo usuarios con rol Directivo o Bibliotecario pueden gestionar autores/libros.
- Anónimos no pueden acceder al panel de administración.

### 7. Consultar la API documentada

Ir a http://localhost:8000/api/documentation.

---

## 📊 Exportación de resumen de datos a Excel

**Qodex** incluye un sistema de exportación a Excel para que los usuarios **Directivos** puedan descargar un resumen de:

- Total de libros registrados.
- Total de autores registrados.
- Detalle de libros por autor.

La exportación se realiza en formato `.xlsx` compatible con Microsoft Excel, LibreOffice o Google Sheets.

---

## 💪 Requisitos adicionales para la exportación

El sistema de exportación usa el paquete [Maatwebsite Excel](https://laravel-excel.com/).

Ya está incluido en el proyecto, **pero necesitas tener instalada la extensión PHP GD** en tu contenedor de Docker.

### ¿Cómo lo instalamos?

La extensión **gd** ya se instala automáticamente al construir el contenedor PHP gracias a esta configuración en el `Dockerfile`:

```dockerfile
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd
```

No necesitas hacer nada extra si sigues los pasos de "Levantar el entorno".

---

## 🚀 ¿Cómo usar la exportación?

1. Inicia sesión como usuario **Directivo**.
2. Ve al panel de **Libros** en el admin de Filament.
3. Arriba a la derecha verás un botón **Exportar resumen**.
4. Al hacer clic, se descargará un archivo `.xlsx` con los datos.

> Solo los usuarios con rol **Directivo** pueden ver y usar el botón de exportación.

---

## 👍 Estado actual

- [x] Integración de exportación de datos en Excel terminada.
- [x] Acceso restringido solo a Directivos.
- [x] Resumen automático de libros y autores.
- [x] Instalación documentada en el README.

---

✨ **Todo listo para probarlo!**

![Export summary](img/export-summary.png)

![excel](img/excel.png)

> El rol de bibliotecario no tiene acceso a la exportacion del resumen

![Rol de bibliotecario resumen](img/bibliotecario-no-resumen.png)
---

## 💪 Autor y créditos

Desarrollado por **ikikidev** como parte del proceso de selección técnica para **Qaroni**.

---