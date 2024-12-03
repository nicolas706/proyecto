//layout inicial al cargar la pagina
const tablaInicial = document.getElementById("vistaInicial");
//Tabla principal, muestra de registros
const barraBusqueda = document.getElementById("busqueda");
const tituloTabla = document.getElementById("resultado").querySelector("thead");
const tabla = document.getElementById("resultado").querySelector("tbody");
//Edicion
let formularioEdicion = document.getElementById("formularioEdicion");
let botonesEdicion = document.getElementById("botonEdicion");
//Nuevo Registro
let botonNuevo = document.getElementById("nuevoRegistro");
//Variables para manejar los datos
let datosJson;
let tablaConsultada;
let apiConsultada;
let funcionGet;
let funcionPost;
let funcionDelete;



// Función para simplificar la creación de inputs
function crearInput(type, placeholder) {
    const input = document.createElement("input");
    input.setAttribute("type", type);
    input.setAttribute("placeholder", placeholder);
    return input;
}

//Consulta a la BD
async function cargarPersona(){
    tablaConsultada = "persona";
    apiConsultada = "api_persona";
    funcionGet = "mostrarPersona";
    funcionPost = "actualizarPersona";
    funcionDelete = "eliminarPersona";
    datosJson = await solicitudGet(apiConsultada, funcionGet);
    tablaInicial.style.display = "none";
    mostrarDatos(datosJson, tablaPersona.columnas);
    //console.log(datosJson);
}   

async function cargarCosecha() {
    tablaConsultada = "cosecha";
    apiConsultada = "api_cosecha";
    funcionGet = "mostrarCosecha";
    funcionPost = "actualizarCosecha";
    funcionDelete = "borrarCosecha";
    datosJson = await solicitudGet(apiConsultada, funcionGet);
    tablaInicial.style.display = "none";
    mostrarDatos(datosJson, tablaCosecha.columnas);
    //console.log(datosJson);
}

function nuevoRegistro() {
    // Limpia la pantalla
    tituloTabla.innerHTML = "";
    tabla.innerHTML = "";
    console.log("Botón nuevo Registro");
    botonNuevo.innerHTML = "";

    // Crear inputs dinámicos
    const inputNombre = crearInput("text", "Ingrese Nombre");
    const inputRut = crearInput("number", "Ingrese RUT");
    const inputApellidoPaterno = crearInput("text", "Ingrese Apellido Paterno");
    const inputApellidoMaterno = crearInput("text", "Ingrese Apellido Materno");
    const inputSexo = crearInput("text", "Ingrese Sexo");
    const inputFechaNacimiento = crearInput("date", "Ingrese fecha de nacimiento");
    const inputTelefono = crearInput("text", "Ingrese teléfono");

    // Agregar inputs a la tabla
    tabla.appendChild(inputNombre);
    tabla.appendChild(inputRut);
    tabla.appendChild(inputApellidoPaterno);
    tabla.appendChild(inputApellidoMaterno);
    tabla.appendChild(inputSexo);
    tabla.appendChild(inputFechaNacimiento);
    tabla.appendChild(inputTelefono);

    botonesEdicion.innerHTML = "";

    // Botón Editar
    const botonGuardar = document.createElement("button");
    botonGuardar.textContent = "Enviar";
    botonGuardar.addEventListener("click", () => guardarCambiosHandler);
    tabla.appendChild(botonGuardar);

    // Botón Eliminar
    const botonCancelar = document.createElement("button");
    botonCancelar.textContent = "Cancelar";
    botonCancelar.addEventListener("click", () => cancelarEdicionHandler);
    tabla.appendChild(botonCancelar);

    // Manejador de guardar cambios
    function guardarCambiosHandler() {
        console.log("Botón guardar cambios nuevo registro");

        // Crear y guardar nueva persona
        const nuevaPersona = new Persona(
            inputNombre.value,
            inputRut.value,
            inputApellidoPaterno.value,
            inputApellidoMaterno.value,
            inputSexo.value,
            inputFechaNacimiento.value,
            inputTelefono.value
        );
        solicitudPost(nuevaPersona);
        console.log("Datos guardados de persona: ", nuevaPersona);

        // Limpiar la pantalla
        botonesEdicion.style.display = "none";
        tabla.innerHTML = "";
        cargarPersona();
    }

    // Manejador de cancelar edición
    function cancelarEdicionHandler() {
        botonesEdicion.style.display = "none";
        tabla.innerHTML = "";
        mostrarDatos(datosJson);
    }
}

//Se elimina la fila
function eliminarRegistro(index){
    datosJson.splice(index, 1);
    console.log("boton eliminar")
    mostrarDatos(datosJson);
}

//Funcion fetch para nuevo registro
function solicitudPost(datos, apiConsultada, funcion){
    fetch (`http://localhost/mvc/endPoint/${apiConsultada}.php?funcion=${funcion}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(datos)
    })
    .then(response => {
        if (!response) {
            throw new Error("Error en la solicitud: ", response.status);
        }
        return response.json();
    })
    .then(result => {
        console.log('Respuesta del servidor: ', result);
        alert("Nuevo registro Creado, se recomienda volver a consultar la tabla")
    })
    .catch(error => {
        console.error("Error: ", error);
    })
}

function solicitudDelate(api, id){
    console.log(`Solicutud delete, se rescata la api consultada: ${api} y el id de la fila ${id}`);
    console.log(`Se convonca a la funcion: ${funcionDelete} y a la tabla ${tablaConsultada}`)
    data = {
        tabla: tablaConsultada,
        condicion: "id="+id
    }
    //fetch delate
    if (confirm("¿Estás seguro que deseas eliminar este registro?")) {
        fetch(`http://localhost/mvc/endPoint/${api}.php?funcion=${funcionDelete}`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            console.log("Resultado:", result);
            if (result) {
              alert("Registro eliminado exitosamente.");
            } else {
                alert("Error: " + result.message);
            }
        })
        .catch(error => {
            console.error("Error en el fetch:", error);
        })
    }
}