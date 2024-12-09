//layout inicial al cargar la pagina
const tablaInicial = document.getElementById("vistaInicial");
//Tabla principal, muestra de registros
const barraBusqueda = document.getElementById("busqueda");
const tituloTabla = document.getElementById("resultado").querySelector("thead");
const tabla = document.getElementById("resultado").querySelector("tbody");
const tablaTarjas = document.getElementById("formularioTarjas");
//Edicion
const formularioEdicion = document.getElementById("formularioEdicion");
const botonesEdicion = document.getElementById("botonEdicion");
//Nuevo Registro
const botonNuevo = document.getElementById("nuevoRegistro");

botonNuevo.addEventListener('click', () => {nuevoRegistro(tablaConsultada)});
//Variables para manejar los datos
let datosJson;
let tablaConsultada;
let apiConsultada;
let funcionCreate;
let funcionGet;
let funcionPost;
let funcionDelete;

//Consulta a la BD
async function cargarPersona(){
    tablaConsultada = "persona";
    apiConsultada = "api_persona";
    funcionGet = "mostrarPersona";
    funcionCreate = "guardarPersona";
    funcionPost = "actualizarPersona";
    funcionDelete = "eliminarPersona";
    datosJson = await solicitudGet(apiConsultada, funcionGet);
    tablaInicial.style.display = "none";
    mostrarDatos(datosJson, configEntidades.persona.columnas);
    console.log(datosJson);
}   

async function cargarCosecha() {
    tablaConsultada = "cosecha";
    apiConsultada = "api_cosecha";
    funcionGet = "mostrarCosecha";
    funcionCreate = "guardarCosecha";
    funcionPost = "actualizarCosecha";
    funcionDelete = "eliminarCosecha";
    datosJson = await solicitudGet(apiConsultada, funcionGet);
    tablaInicial.style.display = "none";
    mostrarDatos(datosJson, configEntidades.cosecha.columnas);
    //console.log(datosJson);
}

async function cargarTrabajador() {
    tablaConsultada = "trabajador";
    apiConsultada = "api_trabajador";
    funcionGet = "mostrarTrabajador";
    funcionCreate = "guardarTrabajador";
    funcionPost = "actualizarTrabajador";
    funcionDelete = "eliminarTrabajador";
    datosJson = await solicitudGet(apiConsultada, funcionGet);
    tablaInicial.style.display = "none";
    mostrarDatos(datosJson, configEntidades.trabajador.columnas);
    //console.log(datosJson);
}

async function cargarCajas() {
    //Se limpia la pantalla
    tablaInicial.style.display = "none";
    tituloTabla.innerHTML = "";
    tablaTarjas.innerHTML = "";
    tabla.innerHTML = "";
    botonNuevo.innerHTML = "";
    botonesEdicion.innerHTML = "";
    formularioEdicion.innerHTML = "";

    try {
        const response = await fetch("http://localhost/mvc/endPoint/api_tarja.php?funcion=mostrarDatos");
        const result = await response.json();

        if (!result.success) {
            console.error("Error en el servidor:", result.message);
            return;
        }

        if (result){
            tablaConsultada = 'total_cajas';
            datosJson = result;
            console.log(datosJson);
            mostrarDatos(result.data.total_cajas, configEntidades.cosecheros.columnas, "total_cajas");
            botonNuevo.innerHTML = "";

            const botonDescargar = document.createElement("button");
            botonDescargar.textContent = "Descargar Excel";

            botonDescargar.addEventListener('click', consultaExcel)
            botonesEdicion.appendChild(botonDescargar);
        }
    } catch(error){
        console.log("Error en lo solicitud:", error)
    }
}
