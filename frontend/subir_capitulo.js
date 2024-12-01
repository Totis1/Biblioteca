const apiUrl = 'http://localhost/biblioteca/src/index.php'
const registerForm = document.getElementById("registerForm")
const submitBtn = document.getElementById("submitBtn")

document.addEventListener("DOMContentLoaded", () => {

})

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
    const archivos = document.getElementById('imagenes').files;  // Obtener la lista de archivos
    if (archivos.length > 0) {
        for (let i = 0; i < archivos.length; i++) {
            const nombreCompleto = archivos[i].name;  // Nombre completo del archivo
            const nombreSinExtension = nombreCompleto.split('.').slice(0, -1).join('.'); // Elimina la extensión
            console.log('Nombre del archivo sin extensión:', nombreSinExtension);
        }
    } else {
        console.log('No se seleccionaron archivos.');
    }
})