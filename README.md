# Biblioteca

A continuacion se explicara la base de datos del proyecto:

1. Tabla Manga
Esta tabla almacena la información general de cada manga disponible en la biblioteca.

Campo	Tipo	Descripción
id	INT (PK)	Identificador único de cada manga.
titulo	VARCHAR(255)	Título del manga.
volumen	INT	Número de volumen (si aplica).
fecha_publicacion	DATE	Fecha de publicación del manga.
id_autor	INT (FK)	Relación con el autor del manga (tabla Autor).
id_genero	INT (FK)	Relación con el género (tabla Genero).
total_paginas	INT	Número total de páginas del manga.
portada	LONGBLOB	Imagen de la portada del manga.
Relaciones: id_autor y id_genero son claves foráneas que se enlazan con las tablas Autor y Genero, permitiendo clasificar los mangas por autor y género.
Función de la portada: La imagen de la portada se almacena en este campo para mostrarse como la primera vista del manga en el catálogo.
2. Tabla Autor
Contiene los datos de los autores de los mangas.

Campo	Tipo	Descripción
id	INT (PK)	Identificador único del autor.
nombre	VARCHAR(255)	Nombre del autor.
nacionalidad	VARCHAR(100)	Nacionalidad del autor.
Relación: Cada autor puede estar relacionado con múltiples mangas en la tabla Manga.
3. Tabla Genero
Almacena los géneros disponibles para clasificar los mangas, como Aventura, Fantasía, etc.

Campo	Tipo	Descripción
id	INT (PK)	Identificador único del género.
nombre	VARCHAR(100)	Nombre del género (ej. Aventura).
Relación: Cada género puede estar vinculado a múltiples mangas en la tabla Manga.
4. Tabla Usuario
Contiene la información de los usuarios registrados en la biblioteca virtual.

Campo	Tipo	Descripción
id	INT (PK)	Identificador único del usuario.
nombre	VARCHAR(255)	Nombre del usuario.
email	VARCHAR(255)	Correo electrónico único del usuario.
fecha_registro	DATETIME	Fecha y hora de registro (por defecto actual).
Función: Permite que cada usuario tenga su propio perfil de lectura y progreso en la biblioteca.
5. Tabla Pagina_Manga
Almacena las imágenes de cada página de los mangas.

Campo	Tipo	Descripción
id	INT (PK)	Identificador único de cada página.
id_manga	INT (FK)	Relación con el manga correspondiente.
numero_pagina	INT	Número de la página en el manga.
imagen	LONGBLOB	Imagen de la página (contenido de la página).
Relaciones: id_manga es una clave foránea que se enlaza con la tabla Manga, indicando a cuál manga pertenece cada página.
Función: Permite que el lector virtual recupere y muestre las páginas del manga.
6. Tabla Lectura
Almacena el progreso de lectura de los usuarios para cada manga, permitiéndoles retomar la lectura donde la dejaron.

Campo	Tipo	Descripción
id	INT (PK)	Identificador único del registro de lectura.
id_usuario	INT (FK)	Relación con el usuario que está leyendo el manga.
id_manga	INT (FK)	Relación con el manga que se está leyendo.
pagina_actual	INT	Número de la última página leída por el usuario.
fecha_inicio	DATETIME	Fecha y hora en que se inició la lectura.
fecha_ultima_lectura	DATETIME	Fecha y hora de la última lectura del usuario.
Relaciones: id_usuario y id_manga son claves foráneas que se enlazan con las tablas Usuario y Manga, respectivamente.
Función: Esta tabla permite que el sistema almacene la página actual en la que cada usuario quedó en un manga, para que puedan retomar su lectura fácilmente.
Resumen del Flujo
Usuarios: Se registran y navegan en la biblioteca.
Catálogo de mangas: Cada manga tiene su información básica, portada y se clasifica por autor y género.
Lector virtual: Cuando el usuario abre un manga, el sistema recupera las imágenes de las páginas de la tabla Pagina_Manga.
Progreso de lectura: Cada vez que el usuario lee o detiene la lectura, se actualiza el registro en la tabla Lectura para guardar su progreso.
