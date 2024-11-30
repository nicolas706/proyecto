const botonCosecha = document.getElementById("botonCosecha");

let botonCosechaNuevo = document.getElementById("nuevoRegistro");
botonCosecha.addEventListener('click', cargarCosecha);
let botonCosechaesEdicion = document.getElementById("botonEdicion")
/*/layout inicial al cargar la pagina
const tablaInicial = document.getElementById("vistaInicial");
const botonCosecha = document.getElementById("botonCosechaCosecha");
//Tabla principal, muestra de registros
const barraBusqueda = document.getElementById("busqueda");
const tituloTabla = document.getElementById("resultado").querySelector("thead");
const tabla = document.getElementById("resultado").querySelector("tbody");
let datosJson;
botonCosecha.addEventListener('click', cargarCosecha);
//Edicion
let formularioEdicion = document.getElementById("formularioEdicion");
let botonCosechaesEdicion = document.getElementById("botonCosechaEdicion");
let guardarCambios = document.getElementById("guardarCambios");
let cancelarEdicion = document.getElementById("cancelarEdicion");
//Nuevo Registro
let botonCosechaNuevo = document.getElementById("nuevoRegistro");*/

// Función para simplificar la creación de inputs
function crearInput(type, placeholder) {
    const input = document.createElement("input");
    input.setAttribute("type", type);
    input.setAttribute("placeholder", placeholder);
    return input;
}

//Consulta a la BD
function cargarCosecha(){     
    let datos;
    fetch('http://localhost/mvc/endPoint/api_cosecha.php?funcion=mostrarCosecha')
    .then(response => response.json())
    .then(data => {
        if (data && data.data) {
            console.log("Datos obtenidos, primera función: ", data.data[0])
            datos = data.data[0];
            mostrarCosecha(datos);
        } else {
            console.error('Error:', data.message);
        }
    })
    .catch(error => console.error('Error de conexión:', error));
}   

//Desplieuge de filas obtenidas
function mostrarCosecha(datos){
    //Se recogen los archivos en DATA y se limpia la hoja HTML
    datosJson = datos;
    tablaInicial.style.display = "none";
    tituloTabla.innerHTML = "";
    tabla.innerHTML = "";

    //creacion de primera fila, titulos
    let fila = document.createElement("tr");
    
    //Columna Numero
    let cosechas = document.createElement("th");
    cosechas.setAttribute("scope", "col");
    cosechas.textContent = "";
    fila.appendChild(cosechas);

    //Columna anio
    let anio = document.createElement("th");
    anio.setAttribute("scope", "col");
    anio.textContent = "Año";
    fila.appendChild(anio);

    //Columna detalle
    let detalle = document.createElement("th");
    detalle.setAttribute("scope", "col");
    detalle.textContent = "Detalle";
    fila.appendChild(detalle);

    //Columna botonCosechas
    let botonCosechas = document.createElement("th");
    botonCosechas.setAttribute("scope", "col");
    botonCosechas.textContent = "ACCION";
    fila.appendChild(botonCosechas);

    //Guadado en fila
    tituloTabla.appendChild(fila);

    //Creación de filas para cada registro
    datosJson.forEach((element, index) => {
        let fila = document.createElement("tr")

        //Columna numero
        let numFila = document.createElement("td")
        numFila.setAttribute("scope", "row")
        numFila.textContent = index + 1;
        fila.appendChild(numFila)

        //Columna anio
        let Columnaanio = document.createElement("td");
        Columnaanio.textContent = element.anio;
        fila.appendChild(Columnaanio);

        //Columna detalle
        let Columnadetalle = document.createElement("td");
        Columnadetalle.textContent = element.detalle;
        fila.appendChild(Columnadetalle);

        //Columna botonCosechaes, editar y eliminar
        const ColumnaAccion = document.createElement("td")

        //Editar
        const botonCosechaEditar = document.createElement("button");
        botonCosechaEditar.textContent = "Editar";
        botonCosechaEditar.addEventListener("click", () => mostrarEdicion(index));
        ColumnaAccion.appendChild(botonCosechaEditar);
        
        //Eliminar
        const botonCosechaEliminar = document.createElement("button");
        botonCosechaEliminar.textContent = "Eliminar";
        botonCosechaEliminar.addEventListener("click", () => eliminarRegistro(index));
        ColumnaAccion.appendChild(botonCosechaEliminar);

        //Guardado fila
        fila.appendChild(ColumnaAccion);
        tabla.appendChild(fila);
        });
    
    botonCosechaNuevo.style.display = "block";
    botonCosechaNuevo.addEventListener('click', () => nuevoRegistro())

}

function nuevoRegistro() {
    // Limpia la pantalla
    tituloTabla.innerHTML = "";
    tabla.innerHTML = "";
    console.log("Botón nuevo Registro");
    botonCosechaNuevo.style.display = "none";

    // Crear inputs dinámicos
    const inputanio = crearInput("text", "Ingrese anio");
    const inputdetalle = crearInput("number", "Ingrese detalle");
    const inputApellidoPaterno = crearInput("text", "Ingrese Apellido Paterno");
    const inputApellidoMaterno = crearInput("text", "Ingrese Apellido Materno");
    const inputSexo = crearInput("text", "Ingrese Sexo");
    const inputFechaNacimiento = crearInput("date", "Ingrese fecha de nacimiento");
    const inputTelefono = crearInput("text", "Ingrese teléfono");

    // Agregar inputs a la tabla
    tabla.appendChild(inputanio);
    tabla.appendChild(inputdetalle);
    tabla.appendChild(inputApellidoPaterno);
    tabla.appendChild(inputApellidoMaterno);
    tabla.appendChild(inputSexo);
    tabla.appendChild(inputFechaNacimiento);
    tabla.appendChild(inputTelefono);

    botonCosechaesEdicion.style.display = "block";

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
            inputanio.value,
            inputdetalle.value,
            inputApellidoPaterno.value,
            inputApellidoMaterno.value,
            inputSexo.value,
            inputFechaNacimiento.value,
            inputTelefono.value
        );
        solicitudPost(nuevaPersona);
        console.log("Datos guardados de persona: ", nuevaPersona);

        // Limpiar la pantalla
        botonCosechaesEdicion.style.display = "none";
        tabla.innerHTML = "";
        cargarCosecha();
    }

    // Manejador de cancelar edición
    function cancelarEdicionHandler() {
        botonCosechaesEdicion.style.display = "none";
        tabla.innerHTML = "";
        mostrarCosecha(datosJson);
    }
}

//Se elimina la fila
function eliminarRegistro(index){
    datosJson.splice(index, 1);
    console.log("botonCosecha eliminar")
    mostrarCosecha(datosJson);
}

//Despliegue formulario edicion
function mostrarEdicion(index) {
    const registro = datosJson[index];
    console.log("botonCosecha editar: ", registro);
    //Se limpia la pantalla
    formularioEdicion.innerHTML = "";
    botonCosechaesEdicion.style.display = "none";

    //Etiqueta anio
    const labelanio = document.createElement("label");
    labelanio.textContent = "anio";
    labelanio.setAttribute("for", "editanio");

    const inputanio = document.createElement("input");
    inputanio.setAttribute("type", "text");
    inputanio.setAttribute("id", "editanio");

    //Etiqueta detalle
    const labeldetalle = document.createElement("label");
    labeldetalle.textContent = "detalle";
    labeldetalle.setAttribute("for", "editdetalle");

    const inputdetalle = document.createElement("input");
    inputdetalle.setAttribute("type", "text");
    inputdetalle.setAttribute("id", "editdetalle");

    //Etiqueta Apellido
    const labelApellidoPaterno = document.createElement("label");
    labelApellidoPaterno.textContent = "Apellido";
    labelApellidoPaterno.setAttribute("for", "editApellido");

    const inputApellidoPaterno = document.createElement("input");
    inputApellidoPaterno.setAttribute("type", "text");
    inputApellidoPaterno.setAttribute("id", "editApellido");

    formularioEdicion.appendChild(labelanio);
    formularioEdicion.appendChild(inputanio);

    formularioEdicion.appendChild(labeldetalle);
    formularioEdicion.appendChild(inputdetalle);

    formularioEdicion.appendChild(labelApellidoPaterno);
    formularioEdicion.appendChild(inputApellidoPaterno);

    inputanio.value = registro.anio;
    inputdetalle.value = registro.detalle;
    inputApellidoPaterno.value = registro.apellido_paterno;

    const idFila = registro.id;
    
    botonCosechaesEdicion.style.display = "block";

    //Guardar los cambios, funcion anidada
    guardarCambios.addEventListener('click', () => {
        console.log("botonCosecha guardar");
        if (index !== null) {
            datosJson[index] = {
                anio: inputanio.value,
                detalle: inputdetalle.value,
                apellido_paterno: inputApellidoPaterno.value
            }
            const datosActualizados = `
            anio='${inputanio.value}', 
            detalle='${inputdetalle.value}', 
            apellido_paterno='${inputApellidoPaterno.value}'`;

            solicitudUpdate(idFila ,datosActualizados);
        }

        botonCosechaesEdicion.style.display = "none";
        formularioEdicion.innerHTML = "";
        mostrarCosecha(datosJson);
    })

    //Cancelar cambios, funcion anidada
    cancelarEdicion.addEventListener('click', () => {
        botonCosechaesEdicion.style.display = "none";
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
