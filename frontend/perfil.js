const apiUrl = 'http://localhost/biblioteca/src/index.php'
const frmActualizar = document.getElementById("frmActualizar")
const submitBtn = document.getElementById("submitBtn")
const apinewUrl = 'http://localhost/biblioteca/src/routes/ImagenUsuarioRoute.php'
const urlParams = new URLSearchParams(window.location.search)
const userId = urlParams.get('id')

document.addEventListener("DOMContentLoaded", () => {
    if (userId){
        console.log("ID del Usuario:", userId)
    }else{
        window.location.href = "http://localhost/biblioteca/frontend/index.php"
    }
    
})

const actualizarUsuario = async () => {
    const imagen = document.getElementById('foto_perfil').files[0]
    usuario = {
        id: userId,
        nombre: document.getElementById('nombre').value,
        email: document.getElementById('email').value,
        contrasena: document.getElementById('contrasena').value
    }
    
    console.log("all ->", usuario)
    const url = `${apiUrl}/usuarios`
    const method = 'PUT'

    const res = await fetch(url, {
        method : method,
        body : JSON.stringify(usuario)
    })

    const response = await res.json()
    console.log("XD->",response)
    if (response.mensaje === 'Usuario SemiActualizado'){
        actualizarImagen(userId,imagen)
    }
}

const actualizarImagen = async (id, imagen) => {
    const formdata = new FormData()
    formdata.append('id', id)
    formdata.append('foto_perfil', imagen)
    const url = apinewUrl
    const method = 'POST'
    const res = await fetch(url, {
        method : method,
        body : formdata
    })
    const response = await res.json()
    console.log("Imagen->",response)
    if(response.mensaje === 'Usuario Actualizado'){
        window.location.href = 'http://localhost/biblioteca/frontend/login.php'
        console.log("Imagen actualizada")
    } 
    else{
        console.log("Error al actualizar la imagen")
    }
}

submitBtn.addEventListener('click', async (e) => {
    e.preventDefault()
    actualizarUsuario()
})

submitBtn.addEventListener('submit', async (e) => {
    e.preventDefault()
    actualizarUsuario()
})