const apiUrl = 'http://localhost/biblioteca/src/index.php'
const registerForm = document.getElementById("registerForm")
const submitBtn = document.getElementById("submitBtn")

document.addEventListener("DOMContentLoaded", () => {

})

const crearUsuario = async () => {
    usuario = {
        nombre: document.getElementById('username').value,
        email: document.getElementById('emailRegister').value,
        contrasena: document.getElementById('passwordRegister').value
    }
    const url = `${apiUrl}/usuarios`
    const method = 'POST'

    const res = await fetch(url, {
        method : method,
        body : JSON.stringify(usuario)
    })

    const response = await res.json();
    console.log("XD->",response);
    if (response.mensaje === 'Usuario Creado'){
        // Redirigir después de 3 segundos
        setTimeout(function() {
            window.location.href = 'https://localhost/biblioteca/frontend/index.html';
        }, 500);  // 3000 milisegundos = 3 segundos 
    }
}

submitBtn.addEventListener('click', async (e) => {
    e.preventDefault();
    crearUsuario();
})

submitBtn.addEventListener('submit', async (e) => {
    e.preventDefault();
    crearUsuario();
})