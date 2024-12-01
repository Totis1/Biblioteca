const apiUrl = 'http://localhost/biblioteca/src/index.php'
const registerForm = document.getElementById("registerForm")
const submitBtn = document.getElementById("submitBtn")

const crearAutor = async () => {
    const autor = {
        nombre: document.getElementById('nombre').value,
        nacionalidad: document.getElementById('nacionalidad').value
    }
    const url = `${apiUrl}/autores`
    const method = 'POST'
    const res = await fetch(url, {
        method : method,
        body: JSON.stringify(autor)
    })
    const response = await res.json();
    console.log("XD->",response)
    if (response.mensaje === 'Autor Creado'){
        console.log("Autor creado")
        registerForm.reset();
    }
}

submitBtn.addEventListener('click', async (e) => {
    e.preventDefault();
    crearAutor();
})

submitBtn.addEventListener('submit', async (e) => {
    e.preventDefault();
    crearAutor();
})