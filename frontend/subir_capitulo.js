const apiUrl = 'http://localhost/biblioteca/src/index.php'
const apinewUrl = 'http://localhost/biblioteca/src/routes/CapituloCreateRoute.php'
const apinewUrlImage = 'http://localhost/biblioteca/src/routes/ImagenCapituloCreateRoute.php'
const registerForm = document.getElementById("registerForm")
const submitBtn = document.getElementById("submitBtn")
const urlParams = new URLSearchParams(window.location.search)
const mangaId = urlParams.get('id')

document.addEventListener("DOMContentLoaded", () => {
    console.log("ID del Manga:", mangaId)
})
const crearCapitulo = async () => {
    const numerocap = document.getElementById("ncap").value
    const titulo = document.getElementById('titulo').value
    const fechaNow = moment().format('YYYY/MM/DD');
    const formdata = new FormData()
    formdata.append('numero', numerocap)
    formdata.append('titulo', titulo)
    formdata.append('manga_id', mangaId)
    formdata.append('fecha', fechaNow)
    const url = apinewUrl
    const method = 'POST'
    const res = await fetch(url, {
        method: method,
        body: formdata
    })
    const response = await res.json()
    console.log("XD->",response);
    if (response.mensaje === 'Capitulo Creado'){
        const idcapitulo = response.id_capitulo
        const archivos = document.getElementById('imagenes').files;  // Obtener la lista de archivos
        if (archivos.length > 0) {
            for (let i = 0; i < archivos.length; i++) {
                const nombreCompleto = archivos[i].name;  // Nombre completo del archivo
                const nombreSinExtension = nombreCompleto.split('.').slice(0, -1).join('.'); // Elimina la extensión
                subirImagen(archivos[i],nombreSinExtension,idcapitulo)
            }
        } else {
            console.log('No se seleccionaron archivos.');
        }
    }else{
        console.log("Error al crear capitulo")
    }
    console.log('Capitulo e Imagenes subidas')
    registerForm.reset()
    setTimeout(function() {
        window.location.href = `http://localhost/biblioteca/frontend/manga.php?id=${mangaId}`
    },10000)
}

const subirImagen = async (imagen, nombre, id) => {
    const formdata = new FormData()
    formdata.append('id_capitulo', id)
    formdata.append('numero_pagina', nombre)
    formdata.append('imagen', imagen)
    
    
    const url = apinewUrlImage
    const method = 'POST'
    const res = await fetch(url, {
        method: method,
        body: formdata
    })
    const response = await res.json()
    console.log("XD->",response)
    if (response.mensaje === 'Imagen Subida'){
        console.log("Imagen subida")
    }else{
        console.log("Error al subir la imagen")
    }
}

/*document.getElementById('imagenes').addEventListener('change', function(event) {
    const archivos = event.target.files;  // Obtener la lista de archivos

    if (archivos.length > 0) {
        for (let i = 0; i < archivos.length; i++) {
            console.log('Nombre del archivo:', archivos[i].name);  // Imprimir el nombre en la consola
        }
    } else {
        console.log('No se seleccionaron archivos.');
    }
})*/

submitBtn.addEventListener("click", async (event) => {
    event.preventDefault();  // Evita el envío real del formulario
    crearCapitulo()

})