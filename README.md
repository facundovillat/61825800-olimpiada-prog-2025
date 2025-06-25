# 🌐 61825800-olimpiada-prog-2025

> **Olimpíada Nacional de Programación 2025**
> **E.E.S.T. Nº4 “Prof. Ricardo Alberto López” (Berazategui)**

---

## 🔍 ¿Qué es este proyecto?

Una plataforma web desarrollada en **Laravel** v10.3.3 que simula un portal de venta de paquetes turísticos. Incluye:

* ✍️ Registro y login de usuarios (clientes y personal interno).
* 🛒 Carrito de compras para seleccionar y gestionar pedidos.
* 📦 Panel de administración para el “Jefe de Ventas” (gestión de productos, pedidos y ventas).
* 📧 Envío automático de correos al confirmar pedidos.

Este proyecto responde a los requisitos de la **Olimpíada Nacional de Programación ETP 2025**, mostrando un desarrollo profesional, colaborativo y documentado.

---

## 🚀 ¿Qué encontrarás aquí?

1. **Descripción del sistema**: visión general y objetivos.
2. **Lista de características**: funcionalidades clave.
3. **Stack tecnológico**: Laravel, PHP, MySQL y más.
4. **Guía rápida de uso**: ejemplos de flujos de Cliente y Jefe de Ventas.
5. **Equipo**: roles de cada miembro.
6. **Licencia**: proyecto open-source bajo MIT.

---

## 🤝 Colabora y aprende

¡Este repositorio es **público** y **open-source**! Si querés aportar:

1. Haz un **fork**.
2. Trabaja en una **branch** nueva.
3. Envía un **Pull Request**.

---

## 📜 Equipo de trabajo

* **Facundo Villa** 👨‍💻 (Programador Principal)
* **Lorenzo Acevedo** 👨‍💻 (Programador Secundario)
* **Facundo Maradona** 🗄️ (Diseño de BD y Analista)
* **Tobias Arrebola** 📋 (Líder de Proyecto y QA)

---


🚀 Tutorial para Descargar e Iniciar el Proyecto TurisApp
1. Clonar el repositorio
git clone https://github.com/facundovillat/61825800-olimpiada-prog-2025.git
cd 61825800-olimpiada-prog-2025
2. Instalar dependencias de PHP (Laravel)
Asegúrate de tener Composer instalado.
composer install
3. Instalar dependencias de JavaScript
Asegúrate de tener Node.js y npm instalados.
npm install
4. Copiar y configurar el archivo de entorno
cp .env.example .env
Edita el archivo .env y configura los datos de tu base de datos:
DB_DATABASE=nombre_de_tu_base
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
5. Generar la clave de la aplicación
php artisan key:generate
6. Ejecutar migraciones y seeders
Esto creará las tablas y poblará la base de datos con datos de ejemplo (si hay seeders configurados):
php artisan migrate --seed
7. Iniciar el servidor de desarrollo
php artisan serve
El proyecto estará disponible en http://localhost:8000.

## 📝 Licencia

Este proyecto está bajo la **Licencia MIT** – revisa el archivo [LICENSE](LICENSE) para más detalles.
