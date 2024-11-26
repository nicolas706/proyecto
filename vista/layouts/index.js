//layput inicial al cargar la pagina
let tablaInicial = document.getElementById("vistaInicial");
let boton = document.getElementById("botonPersona");
//Tabla principal, muestra de registros
let tituloTabla = document.getElementById("resultado").querySelector("thead");
let tabla = document.getElementById("resultado").querySelector("tbody");
let datosJson;
boton.addEventListener('click', cargarDatos);
//Edicion
let formularioEdicion = document.getElementById("formularioEdicion");
let botonesEdicion = document.getElementById("botonesEdicion");
let guardarCambios = document.getElementById("guardarCambios");
let cancelarEdicion = document.getElementById("cancelarEdicion");

//Consulta a la BD
function cargarDatos(){     
    let datos;
    fetch('http://localhost/mvc/endPoint/api_mostrar_persona.php?tabla=persona')
    .then(response => response.json())
    .then(data => {
        if (data && data.data) {
            console.log("Datos obtenidos, primera función: ", data.data[0])
            datos = data.data[0];
            mostrarDatos(datos);
        } else {
            console.error('Error:', data.message);
        }
    })
    .catch(error => console.error('Error de conexión:', error));
}   

//Desplieuge de filas obtenidas
function mostrarDatos(datos){
    //Se recogen los archivos en DATA y se limpia la hoja HTML
    datosJson = datos;
    tablaInicial.style.display = "none";
    tituloTabla.innerHTML = "";
    tabla.innerHTML = "";

    //creacion de primera fila, titulos
    let fila = document.createElement("tr");
    
    //Celda Numero
    let personas = document.createElement("th");
    personas.setAttribute("scope", "col");
    personas.textContent = "Personas";
    fila.appendChild(personas);

    //Celda Nombre
    let nombre = document.createElement("th");
    nombre.setAttribute("scope", "col");
    nombre.textContent = "Nombre";
    fila.appendChild(nombre);

    //Celda Rut
    let rut = document.createElement("th");
    rut.setAttribute("scope", "col");
    rut.textContent = "Rut";
    fila.appendChild(rut);

    //Celda Apellido
    let apellidos = document.createElement("th");
    apellidos.setAttribute("scope", "col");
    apellidos.textContent = "Apellidos";
    fila.appendChild(apellidos);

    //Celda Botones
    let botones = document.createElement("th");
    botones.setAttribute("scope", "col");
    botones.textContent = "ACCION";
    fila.appendChild(botones);

    //Guadado en fila
    tituloTabla.appendChild(fila);

    //Creación de filas para cada registro
    datosJson.forEach((element, index) => {
        let fila = document.createElement("tr")

        //Celda numero
        let numFila = document.createElement("td")
        numFila.setAttribute("scope", "row")
        numFila.textContent = index + 1;
        fila.appendChild(numFila)

        //Celda nombre
        let celdaNombre = document.createElement("td");
        celdaNombre.textContent = element.nombre;
        fila.appendChild(celdaNombre);

        //Celda rut
        let celdaRut = document.createElement("td");
        celdaRut.textContent = element.rut;
        fila.appendChild(celdaRut);

        //Celda apellido
        let celdaApellido = document.createElement("td");
        celdaApellido.textContent = element.apellido_paterno;
        fila.appendChild(celdaApellido);

        //Celda Botones, editar y eliminar
        const celdaAccion = document.createElement("td")

        //Editar
        const botonEditar = document.createElement("button");
        botonEditar.textContent = "Editar";
        botonEditar.addEventListener("click", () => mostrarEdicion(index));
        celdaAccion.appendChild(botonEditar);
        
        //Eliminar
        const botonEliminar = document.createElement("button");
        botonEliminar.textContent = "Eliminar";
        botonEliminar.addEventListener("click", () => eliminarRegistro(index));
        celdaAccion.appendChild(botonEliminar);

        //Guardado fila
        fila.appendChild(celdaAccion);
        tabla.appendChild(fila);
        });

        console.log(datosJson);
}

//Se elimina la fila
function eliminarRegistro(index){
    datosJson.splice(index, 1);
    console.log("boton eliminar")
    mostrarDatos(datosJson);
}

//Despliegue formulario edicion
function mostrarEdicion(index) {
    console.log("Boton editar: ", datosJson[index]);
    const registro = datosJson[index];
    //Se limpia la pantalla
    formularioEdicion.innerHTML = "";
    botonesEdicion.style.display = "none";

    //Etiqueta nombre
    const labelNombre = document.createElement("label");
    labelNombre.textContent = "Nombre";
    labelNombre.setAttribute("for", "editNombre");

    const inputNombre = document.createElement("input");
    inputNombre.setAttribute("type", "text");
    inputNombre.setAttribute("id", "editNombre");

    //Etiqueta rut
    const labelRut = document.createElement("label");
    labelRut.textContent = "Rut";
    labelRut.setAttribute("for", "editRut");

    const inputRut = document.createElement("input");
    inputRut.setAttribute("type", "text");
    inputRut.setAttribute("id", "editRut");

    //Etiqueta Apellido
    const labelApellido = document.createElement("label");
    labelApellido.textContent = "Apellido";
    labelApellido.setAttribute("for", "editApellido");

    const inputApellido = document.createElement("input");
    inputNombre.setAttribute("type", "text");
    inputNombre.setAttribute("id", "editApellido");

    formularioEdicion.appendChild(labelNombre);
    formularioEdicion.appendChild(inputNombre);

    formularioEdicion.appendChild(labelRut);
    formularioEdicion.appendChild(inputRut);

    formularioEdicion.appendChild(labelApellido);
    formularioEdicion.appendChild(inputApellido);

    inputNombre.value = registro.nombre;
    inputRut.value = registro.rut;
    inputApellido.value = registro.apellido_paterno;
    
    botonesEdicion.style.display = "block";
    indiceFila = index;

    //Guardar los cambios, funcion anidada
    guardarCambios.addEventListener('click', () => {
        console.log("Boton guardar");
        if (index !== null) {
            datosJson[index] = {
                nombre: inputNombre.value,
                rut: inputRut.value,
                apellido_paterno: inputApellido.value
            }
        }

        botonesEdicion.style.display = "none";
        formularioEdicion.innerHTML = "";
        mostrarDatos(datosJson);
    })
}

cancelarEdicion.addEventListener('click', () => {
    botonesEdicion.style.display = "none";
    formularioEdicion.innerHTML = "";
})