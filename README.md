---

🎨 PngKit🌟 Visión General del Proyecto**PngKit** es una plataforma social diseñada específicamente para artistas, ilustradores y creativos. Nuestro objetivo es crear un espacio donde los usuarios puedan **buscar referencias e inspiración**, coleccionar material de apoyo, interactuar con otros artistas y, por supuesto, **publicar y compartir sus propias obras** de arte digital o tradicional.

Es la comunidad ideal para encontrar el *kit* de recursos e inspiración que todo artista necesita.

  🛠️ Tecnologías UtilizadasEste proyecto está construido principalmente con tecnologías tradicionales de desarrollo web, con un enfoque en la simplicidad y la compatibilidad con entornos de hosting estándar.

| Componente | Tecnología | Descripción |
| --- | --- | --- |
| **Backend/Lógica** | **PHP Puro** | Manejo de la lógica de negocio, autenticación, y gestión de la base de datos. |
| **Base de Datos** | **MySQL / MariaDB** | Almacenamiento de datos relacionales (usuarios, posts, carpetas). |
| **Servidor Web** | **Apache** | Entorno de servidor local para ejecutar los archivos PHP (típicamente a través de XAMPP/WAMP/MAMP). |
| **Frontend** | **HTML, CSS, JavaScript** | Estructura, estilo e interactividad del lado del cliente. |
| **Almacenamiento de Archivos** | **Firebase Storage / Rutas URL** | Se utiliza almacenamiento externo (como Firebase) para manejar los enlaces de las imágenes de perfil/banner y las obras (`enlace` en la tabla `imagenes`). |

  🗄️ Esquema de la Base de DatosLa base de datos `pngkit` utiliza las siguientes tablas clave, lo que demuestra la estructura de una aplicación social enfocada en el contenido y el perfil del artista:

| Tabla | Descripción | Clave Foránea / Clave |
| :--- | :--- | :--- |
| **`usuarios`** | Almacena la información básica de registro (login). | `id` (PK) |
| **`configuracion_perfil`** | Contiene detalles públicos y de personalización del perfil del artista. | `id_usuario` (FK a `usuarios.id`) |
| **`imagenes`** | Almacena los metadatos de las obras publicadas por los usuarios. | `usuario` (FK a `usuarios.id`) |
| **`carpetas`** | Permite a los usuarios organizar su inspiración o referencias (moodboards). | `id_usuario` (FK a `usuarios.id`) |
| **`redes_sociales`** | Almacena los enlaces a las redes sociales del artista. | `id_usuario` (PK/FK a `usuarios.id`) |
| **`seguidores`** | Registra las relaciones de seguimiento entre usuarios. | `usuario_id`, `perfil_id` (FKs a `usuarios.id`) |

> **Nota:** Se utiliza una estrategia de almacenamiento externo para las imágenes, ya que los campos `foto_perfil`, `foto_banner` y `enlace` almacenan URLs de Firebase Storage en lugar de datos binarios en la base de datos.

  🚀 Instalación y Ejecución Local (PHP/MySQL)Sigue estos pasos para configurar y ejecutar **PngKit** en tu entorno local.

  PrerrequisitosAsegúrate de tener instalado un paquete de servidor local como **XAMPP, WAMP, o MAMP**.

  1. Clonar el Repositorio ``bash
git clone https://github.com/tu-usuario/PngKit.git\``

Copia el contenido del repositorio en el directorio raíz de tu servidor web local (ej. `htdocs` en XAMPP).

  2. Configuración de la Base de Datos1. **Inicia** los servicios de **Apache** y **MySQL** en tu paquete de servidor (XAMPP, WAMP, etc.).
2. Accede a **phpMyAdmin** (generalmente en `http://localhost/phpmyadmin`).
3. **Crea** una nueva base de datos llamada `pngkit`.
4. **Importa** el archivo `pngkit.sql` proporcionado en esta nueva base de datos.
* *Alternativamente*, puedes copiar y pegar el contenido completo del archivo `.sql` en la pestaña SQL de phpMyAdmin y ejecutarlo.



  3. Configuración del PHP1. Asegúrate de que tus archivos de conexión a la base de datos (p. ej., `conexion.php` o similar) en el código PHP estén apuntando a:
* **Servidor:** `localhost`
* **Usuario:** `root` (o tu usuario de MySQL local)
* **Contraseña:** (vacía, o la que hayas configurado)
* **Base de datos:** `pngkit`



  4. Acceder al ProyectoAbre tu navegador y navega a la URL local de tu proyecto:

```
http://localhost/PngKit/

```

*(Ajusta la ruta según el directorio donde colocaste los archivos.)*
