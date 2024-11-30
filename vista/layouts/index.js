//layout inicial al cargar la pagina
const tablaInicial = document.getElementById("vistaInicial");
const boton = document.getElementById("botonPersona");
//Tabla principal, muestra de registros
const barraBusqueda = document.getElementById("busqueda");
const tituloTabla = document.getElementById("resultado").querySelector("thead");
const tabla = document.getElementById("resultado").querySelector("tbody");
let datosJson;
boton.addEventListener('click', cargarDatos);
//Edicion
let formularioEdicion = document.getElementById("formularioEdicion");
let botonesEdicion = document.getElementById("botonEdicion");
let guardarCambios = document.getElementById("guardarCambios");
let cancelarEdicion = document.getElementById("cancelarEdicion");
//Nuevo Registro
let botonNuevo = document.getElementById("nuevoRegistro");

// Función para simplificar la creación de inputs
function crearInput(type, placeholder) {
    const input = document.createElement("input");
    input.setAttribute("type", type);
    input.setAttribute("placeholder", placeholder);
    return input;
}

//Consulta a la BD
function cargarDatos(){     
    let datos;
    fetch('http://localhost/mvc/endPoint/api_persona.php?funcion=mostrarPersona')
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
    personas.textContent = "";
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
    
    botonNuevo.style.display = "block";
    botonNuevo.addEventListener('click', () => nuevoRegistro())

}

function nuevoRegistro() {
    // Limpia la pantalla
    tituloTabla.innerHTML = "";
    tabla.innerHTML = "";
    console.log("Botón nuevo Registro");
    botonNuevo.style.display = "none";

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

    botonesEdicion.style.display = "block";

    // **Eliminar listeners anteriores**
    guardarCambios.removeEventListener('click', guardarCambiosHandler);
    cancelarEdicion.removeEventListener('click', cancelarEdicionHandler);

    // **Añadir nuevos listeners**
    guardarCambios.addEventListener('click', guardarCambiosHandler);
    cancelarEdicion.addEventListener('click', cancelarEdicionHandler);

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
        cargarDatos();
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

//Despliegue formulario edicion
function mostrarEdicion(index) {
    const registro = datosJson[index];
    console.log("Boton editar: ", registro);
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
    const labelApellidoPaterno = document.createElement("label");
    labelApellidoPaterno.textContent = "Apellido";
    labelApellidoPaterno.setAttribute("for", "editApellido");

    const inputApellidoPaterno = document.createElement("input");
    inputApellidoPaterno.setAttribute("type", "text");
    inputApellidoPaterno.setAttribute("id", "editApellido");

    formularioEdicion.appendChild(labelNombre);
    formularioEdicion.appendChild(inputNombre);

    formularioEdicion.appendChild(labelRut);
    formularioEdicion.appendChild(inputRut);

    formularioEdicion.appendChild(labelApellidoPaterno);
    formularioEdicion.appendChild(inputApellidoPaterno);

    inputNombre.value = registro.nombre;
    inputRut.value = registro.rut;
    inputApellidoPaterno.value = registro.apellido_paterno;

    const idFila = registro.id;
    
    botonesEdicion.style.display = "block";

    //Guardar los cambios, funcion anidada
    guardarCambios.addEventListener('click', () => {
        console.log("Boton guardar");
        if (index !== null) {
            datosJson[index] = {
                nombre: inputNombre.value,
                rut: inputRut.value,
                apellido_paterno: inputApellidoPaterno.value
            }
            const datosActualizados = `
            nombre='${inputNombre.value}', 
            rut='${inputRut.value}', 
            apellido_paterno='${inputApellidoPaterno.value}'`;

            solicitudUpdate(idFila ,datosActualizados);
        }

        botonesEdicion.style.display = "none";
        formularioEdicion.innerHTML = "";
        mostrarDatos(datosJson);
    })

    //Cancelar cambios, funcion anidada
    cancelarEdicion.addEventListener('click', () => {
        botonesEdicion.style.display = "none";
        formularioEdicion.innerHTML = "";
    })
}

//Funcion fetch para nuevo registro
function solicitudPost(datos){
    fetch ('http://localhost/mvc/endPoint/api_persona.php?funcion=guardarPersona', {
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
    })
    .catch(error => {
        console.error("Error: ", error);
    })
}

//Funcion fetch para actualizar registro
function solicitudUpdate(id, datos){
    data = {
        tabla: "persona",
        data: datos,
        condicion: "id="+id
    }
    console.log("Fila editada: ",id, datos)
    fetch('http://localhost/mvc/endPoint/api_persona.php?funcion=actualizarPersona', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    
    .then(response => {
        if (!response) {
            throw new Error(`Error en la solicitud ${response.status}`);
        }
        return response
    })
    .then(result => {
        console.log("Respuesta del servidor: ", result);
        if(result){
            alert("Registro actualizado");
        } else {
            alert("Error en la solicitud");
        }
    })
    .catch(error => {
        console.error("Error en la solicitud:", error);
    })
}
