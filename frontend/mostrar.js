const apiUrl = 'http://localhost/biblioteca/src/index.php'
// Llama a la función cuando la página ha cargado
document.addEventListener("DOMContentLoaded", () => {
    loadMangas()
    console.log("carga")
})

const loadMangas = async () => {
    // Obtiene la lista de mangas
    const url = `${apiUrl}/mangas`
    const method = 'GET'
    const res = await fetch(url,{
        method: method,
        headers: {
            'Content-Type': 'application/json'
        }
    })
    const response = await res.json()
    console.log("XD->",response)
    // Llama a la función para generar las cards
    cargarMangas(response)
}

// Función para generar las cards
function cargarMangas(mangas) {
    const mangaList = document.getElementById('mangaList');

    mangas.forEach(manga => {
        // Crear el contenedor de la card
        const colDiv = document.createElement('div');
        colDiv.className = 'col-6 col-sm-6 col-md-4 col-lg-3 manga-item';
        colDiv.setAttribute('data-title', manga.title);

        // Contenido de la card
        colDiv.innerHTML = `
            <div class="card">
                <a href="${manga.link}" class="card-body card-body-custom">
                    <img src="${manga.image}" alt="${manga.title}" height="" width="270vh">
                    <h3 class="card-title">${manga.title}</h3>
                </a>
            </div>`

        // Insertar la card en el contenedor principal
        mangaList.appendChild(colDiv);
    })
    
}