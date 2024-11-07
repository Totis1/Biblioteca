# Biblioteca

Este proyecto es una biblioteca virtual para almacenar y leer mangas en línea. Permite a los usuarios registrados navegar en un catálogo de mangas, visualizar la portada de cada manga, y leer sus páginas a través de un lector virtual. Además, cada usuario puede retomar su lectura desde la última página leída gracias al sistema de progreso de lectura.

Estructura de la Base de Datos
La base de datos está compuesta por varias tablas que organizan la información de los mangas, los usuarios, y el progreso de lectura de cada usuario. A continuación, se describe cada tabla y su función en el sistema.

Tabla Manga
Almacena la información general de cada manga disponible en la biblioteca.

| Campo | Tipo | Descripción |
| --- | --- | --- |
id	INT (PK)	Identificador único de cada manga.
titulo	VARCHAR(255)	Título del manga.
volumen	INT	Número de volumen (si aplica).
fecha_publicacion	DATE	Fecha de publicación del manga.
id_autor	INT (FK)	Relación con el autor del manga (tabla Autor).
id_genero	INT (FK)	Relación con el género (tabla Genero).
total_paginas	INT	Número total de páginas del manga.
portada	LONGBLOB	Imagen de la portada del manga.

Tabla Autor
Contiene los datos de los autores de los mangas.

| Campo | Tipo | Descripción |
| --- | --- | --- |
| id | INT (PK) |	Identificador único del autor. |
|nombre |	VARCHAR(255)	| Nombre del autor.|
|nacionalidad |	VARCHAR(100) | Nacionalidad del autor.|

Tabla Genero
Almacena los géneros disponibles para clasificar los mangas, como Aventura, Fantasía, etc.

| Campo | Tipo | Descripción |
| --- | --- | --- |
id	INT (PK)	Identificador único del género.
nombre	VARCHAR(100)	Nombre del género (ej. Aventura).

Tabla Usuario
Contiene la información de los usuarios registrados en la biblioteca virtual.

| Campo | Tipo | Descripción |
| --- | --- | --- |
id	INT (PK)	Identificador único del usuario.
nombre	VARCHAR(255)	Nombre del usuario.
email	VARCHAR(255)	Correo electrónico único del usuario.
fecha_registro	DATETIME	Fecha y hora de registro (por defecto actual).

Tabla Pagina_Manga
Almacena las imágenes de cada página de los mangas.

| Campo | Tipo | Descripción |
| --- | --- | --- |
id	INT (PK)	Identificador único de cada página.
id_manga	INT (FK)	Relación con el manga correspondiente.
numero_pagina	INT	Número de la página en el manga.
imagen	LONGBLOB	Imagen de la página (contenido de la página).
Tabla Lectura
Almacena el progreso de lectura de los usuarios para cada manga, permitiéndoles retomar la lectura donde la dejaron.

| Campo | Tipo | Descripción |
| --- | --- | --- |
id	INT (PK)	Identificador único del registro de lectura.
id_usuario	INT (FK)	Relación con el usuario que está leyendo el manga.
id_manga	INT (FK)	Relación con el manga que se está leyendo.
pagina_actual	INT	Número de la última página leída por el usuario.
fecha_inicio	DATETIME	Fecha y hora en que se inició la lectura.
fecha_ultima_lectura	DATETIME	Fecha y hora de la última lectura del usuario.

#Funcionalidad del Sistema

Usuarios: Los usuarios pueden registrarse y navegar en el catálogo de mangas.
Catálogo de mangas: Cada manga tiene información básica, una portada y se clasifica por autor y género.
Lector virtual: Al seleccionar un manga, el usuario puede leer cada página a través de un lector virtual que recupera las imágenes de las páginas desde la tabla Pagina_Manga.
Progreso de lectura: El sistema almacena la última página leída de cada usuario en la tabla Lectura, permitiendo retomar la lectura donde la dejaron.
Este diseño de base de datos permite un funcionamiento completo de la biblioteca virtual, ofreciendo una experiencia de lectura continua y personalizada para cada usuario.
