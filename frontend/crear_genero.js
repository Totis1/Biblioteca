const apiUrl = 'http://localhost/biblioteca/src/index.php'
const registerForm = document.getElementById("registerForm")
const submitBtn = document.getElementById("submitBtn")

const crearGenero = async () => {
    const genero = {
        nombre: document.getElementById('nombre').value
    }
    const url = `${apiUrl}/generos`
    const method = 'POST'
    const res = await fetch(url, {
        method : method,
        body : JSON.stringify(genero)
    })
    const response = await res.json();
    console.log("XD->",response);
    if (response.mensaje === 'Genero Creado'){
        console.log("Genero creado")
        registerForm.reset();
    }
}

submitBtn.addEventListener('click', async (e) => {
    e.preventDefault();
    crearGenero();
})

submitBtn.addEventListener('submit', async (e) => {
    e.preventDefault();
    crearGenero();
})