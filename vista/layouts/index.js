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
//Variables para manejar los datos
let datosJson;
let tablaConsultada;
let apiConsultada;
let funcionCreate;
let funcionGet;
let funcionPost;
let funcionDelete;

botonNuevo.addEventListener('click', () => {nuevoRegistro(tablaConsultada)});

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