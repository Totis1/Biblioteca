const apiUrl = 'https://localhost/biblioteca/src/index.php'
const frmLogin = document.getElementById("frmLogin")
const submitBtn = document.getElementById("submitBtn")

document.addEventListener("DOMContentLoaded", () => {

})

const loginUsuario = async () => {
    usuario = {
        email: document.getElementById('email').value
    }
    const url = `${apiUrl}/login`
    const method = 'POST'

    const res = await fetch(url, {
        method: method,
        body : JSON.stringify(usuario)
    })

    const response = await res.json()
    console.log("XD->",response)
}

submitBtn.addEventListener('click', async (e) => {
    e.preventDefault()
    loginUsuario()
})

submitBtn.addEventListener('submit', async (e) => {
    e.preventDefault()
    loginUsuario()
})