# 🚀 Guía de Despliegue y Configuración Inicial de Laravel

Este documento describe los pasos necesarios para inicializar y poner en funcionamiento el proyecto `softcom-inso` después de clonarlo desde el repositorio de Git.

## Requisitos Previos

Asegúrese de tener instalados en el servidor de destino:
* **PHP** (Versión requerida por el proyecto)
* **Composer** (Gestor de dependencias de PHP)
* **Node.js y NPM/Yarn** (Gestor de dependencias de JavaScript)

---

## Pasos de Configuración

### Paso 1: Clonar y Acceder al Repositorio

Obtenga el código fuente desde GitHub y navegue al directorio del proyecto.

```bash
git clone https://github.com/LuisSoriano/softcom-inso.git facturacion-inso
cd facturacion-inso
```
Paso 2: Instalar Dependencias de PHP (/vendor)
Descargue todas las librerías de PHP definidas en composer.lock. Esto recrea la carpeta /vendor, la cual está ignorada por Git.

Bash
```bash
composer install
```
Paso 3: Configurar el Entorno (.env)
Configure las variables de entorno, que contienen información sensible (credenciales de DB, claves, etc.).
Crear el archivo .env:

Bash
```bash
cp .env.example .env
```
Configurar la Base de Datos: Edite el archivo .env para establecer los valores DB_DATABASE, DB_USERNAME, DB_PASSWORD, etc.

Generar la Clave de Aplicación (APP_KEY):

Bash
```bash
php artisan key:generate
```
Paso 4: Instalar Dependencias de JavaScript (/node_modules)
Instale todas las librerías de front-end definidas en package.json. Esto recrea la carpeta /node_modules.

Bash
```bash
npm install 
# Alternativa si usa Yarn: yarn install
```
Paso 5: Compilar Assets (/public/build)
Compile el CSS y JavaScript de desarrollo en archivos optimizados y hasheados para producción.

Bash
```bash
npm run build
```
Paso 6: Configurar Base de Datos (Migraciones y Seeding)
Cree la estructura de la base de datos y llénela con datos iniciales (si aplica).

Bash
```bash
php artisan migrate:fresh --seed
(Nota: migrate:fresh borra todas las tablas antes de recrearlas.)
```
Paso 7: Configurar Permisos de Escritura
Asegure que el servidor web (generalmente www-data) tenga permisos de escritura en los directorios de caché y almacenamiento de archivos.

Bash
```bash
sudo chown -R $USER:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```
Una vez completados todos los pasos, la aplicación estará lista para ser servida por el servidor web.