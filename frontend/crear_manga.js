const frmActualizar = document.getElementById("registerForm")
const submitBtn = document.getElementById("submitBtn")
const apiUrl = 'http://localhost/biblioteca/src/index.php'
const apinewUrl = 'http://localhost/biblioteca/src/routes/MangaRoute.php'
let fechaRaw = ''

document.addEventListener("DOMContentLoaded", () => {
    loadAutores()
    loadGeneros()
})

document.addEventListener('DOMContentLoaded', function () {
    new tempusDominus.TempusDominus(document.getElementById('datepicker'), {
      localization: {
        format: 'YYYY/MM/DD',  // Formato dd/mm/yyyy
        locale: 'es'          // Idioma español
      },
      defaultDate: moment().format('YYYY/MM/DD'), // Fecha por defecto
      display: {
        components: {
          calendar: true,
          date: true,
          month: true,
          year: true,
          decades: true,
          clock: false, // Desactiva la selección de hora
        }
      },
    })
    // Escuchar el evento de cambio de fecha
    document.getElementById('datepicker').addEventListener('change.td', (e) => {
        const selectedDate = e.detail.date  // Objeto fecha de Tempus Dominus
        if (selectedDate) {
            const formattedDate = moment(selectedDate).format('YYYY/MM/DD') // Formatea la fecha
            document.getElementById('date-input').value = formattedDate // Mostrar en el input
            fechaRaw = formattedDate // Guarda la fecha en una variable global
        }
    })
})

submitBtn.addEventListener('click', async (e) => {
    e.preventDefault()
    crearManga()
})

submitBtn.addEventListener('submit', async (e) => {
    e.preventDefault()
    crearManga()
})

const crearManga = async () => {
    const formdata = new FormData()
    formdata.append('Titulo', document.getElementById('titulo').value)
    formdata.append('Descripcion', document.getElementById('descripcion').value)
    formdata.append('Fecha', fechaRaw)
    formdata.append('Autor', document.getElementById('autor').value)
    formdata.append('Genero', document.getElementById('genero').value)
    formdata.append('Portada', document.getElementById('portada').files[0])
    const url = apinewUrl
    const method = 'POST'
    const res = await fetch(url, {
        method: method,
        body: formdata
    })
    const response = await res.json()
    console.log("XD->",response);
    if (response.mensaje === 'Manga Creado'){
        console.log("Manga creado")
        frmActualizar.reset();
    }else{
        console.log("Error al crear manga")
    }
}

const loadAutores = async () => {
    const url = `${apiUrl}/autores`
    const method = 'GET'
    const res = await fetch(url,{
        method: method,
        headers: {
            'Content-Type': 'application/json',
        }
    })
    const autores = await res.json()
    // Llenar select de autores
    const selectAutores = document.getElementById('autor')
    autores.forEach((autor) => {
        const option = document.createElement('option')
        option.value = autor.id
        option.textContent = autor.nombre
        selectAutores.appendChild(option)
    })
}

const loadGeneros = async () =>{
    const url = `${apiUrl}/generos`
    const method = 'GET'
    const res = await fetch(url,{
        method: method,
        headers: {
            'Content-Type': 'application/json',
        }
    })
    const generos = await res.json()
    // Llenar select de generos
    const selectGeneros = document.getElementById('genero')
    generos.forEach((genero) => {
        const option = document.createElement('option')
        option.value = genero.id
        option.textContent = genero.nombre
        selectGeneros.appendChild(option)
    })
}
