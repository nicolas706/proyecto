//Función genérica para mostrar en pantalla las filas de la tabla respectiva
function mostrarDatos(datos, columnas) {
    //Se limpia la tabla
    tabla.innerHTML = "";
    tituloTabla.innerHTML = "";
    //Se crea cabecera, para los respectivos titulos
    const cabecera = document.createElement("tr");

    //Se agregan los titulos
    columnas.forEach(columna => {
        const th = document.createElement("th");
        th.textContent = columna.titulo;
        cabecera.appendChild(th);
    });

    // Agregar columna "Acción" al encabezado
    const thAccion = document.createElement("th");
    thAccion.textContent = "Acción";
    cabecera.appendChild(thAccion);

    tituloTabla.appendChild(cabecera);

    //Creación de cada fila dependiendo de la cantidad de registros 
    datos.forEach((dato, index) => {
        console.log("Este es el id de la fila: "+ dato.id)
        let id = dato.id;
        const fila = document.createElement("tr");
        columnas.forEach(columna => {
            const celda = document.createElement("td");
            celda.textContent = dato[columna.clave] || '';
            fila.appendChild(celda);
        });

        const celdaAccion = document.createElement("td");

        // Botón Editar
        const botonEditar = document.createElement("button");
        botonEditar.textContent = "Editar";
        botonEditar.addEventListener("click", () => mostrarEdicion(index, datos, columnas));
        celdaAccion.appendChild(botonEditar);

        // Botón Eliminar
        const botonEliminar = document.createElement("button");
        botonEliminar.textContent = "Eliminar";
        botonEliminar.addEventListener("click", () => solicitudDelate(apiConsultada, id));
        celdaAccion.appendChild(botonEliminar);

        // Agregar celda de acción a la fila
        fila.appendChild(celdaAccion);

        //Agregar filas a las tablas
        tabla.appendChild(fila);
    });
}

// Función genérica para mostrar el formulario de edición
function mostrarEdicion(index, datosJson, columnas) {
    const registro = datosJson[index];
    console.log("Botón editar: ", registro);

    // Limpia la pantalla
    formularioEdicion.innerHTML = "";
    botonesEdicion.innerHTML = "";

    // Crear los campos dinámicamente según las columnas
    const inputs = {}; // Para almacenar referencias a los inputs generados

    columnas.forEach(columna => {
        if (columna) { // Solo crear campos para columnas editables
            const label = document.createElement("label");
            label.textContent = columna.titulo;
            label.setAttribute("for", `edit${columna.clave}`);

            const input = document.createElement("input");
            //input.setAttribute("type", columna.tipo || "text"); // Por defecto, "text"
            input.setAttribute("type", "text"); // Por defecto, "text"
            input.setAttribute("id", `edit${columna.clave}`);
            input.value = registro[columna.clave] || ''; // Valor inicial

            formularioEdicion.appendChild(label);
            formularioEdicion.appendChild(input);

            inputs[columna.clave] = input; // Almacena la referencia
        }
    });

    const idFila = registro.id; //Se guarda el id de la fila respectiva

    // Botón Guardar cambios
    const botonGuardar = document.createElement("button");
    botonGuardar.textContent = "Guardar";
    botonGuardar.addEventListener("click", () => { //Funcion anonima para guardar datos editados
        console.log("Botón guardar");
        if (index !== null) {
            // Actualizar datos en el array
            columnas.forEach(columna => {
                if (columna) {
                    registro[columna.clave] = inputs[columna.clave].value;
                }
            });
    
            // Crear datos actualizados para enviar
            const datosActualizados = Object.keys(inputs)
                .map(key => `${key}='${inputs[key].value}'`)
                .join(', ');
            console.log(datosActualizados)
            solicitudUpdate(idFila, datosActualizados, tablaConsultada, apiConsultada, funcionPost); // Llama a la función de actualización
        }
    
        botonesEdicion.innerHTML = "";
        formularioEdicion.innerHTML = "";
        mostrarDatos(datosJson, columnas, tabla); // Actualiza la tabla
    }
    );
    botonesEdicion.appendChild(botonGuardar);

    // Botón Cancelar edición
    const botonCancelar = document.createElement("button");
    botonCancelar.textContent = "Cancelar";
    botonCancelar.addEventListener("click", () => {
        botonesEdicion.innerHTML = "";
        formularioEdicion.innerHTML = "";
    });
    botonesEdicion.appendChild(botonCancelar);
}

//Formulario genérico para nuevo registro
function nuevoRegistro(columna, cargarDatosHandler) {
    // Obtén la configuración de la columna desde configcolumnaes
    const config = configcolumnaes[columna];

    if (!config) {
        console.error(`No se encontró configuración para la columna: ${columna}`);
        return;
    }

    // Limpia la pantalla
    tituloTabla.innerHTML = "";
    tabla.innerHTML = "";
    botonNuevo.innerHTML = "";
    console.log(`Creando nuevo registro para: ${columna}`);

    // Crear inputs dinámicos en base a las columnas configuradas
    config.columnas.forEach(columna => {
        const label = document.createElement("label");
        label.textContent = columna.titulo;
        label.setAttribute("for", columna.clave);

        const input = document.createElement("input");
        input.setAttribute("type", columna.tipo || "text"); // Default "text" si no se especifica tipo
        input.setAttribute("id", columna.clave);
        input.placeholder = `Ingrese ${columna.titulo.toLowerCase()}`;

        // Agregar label e input al formulario
        tabla.appendChild(label);
        tabla.appendChild(input);
    });

    // Crear botones
    botonesEdicion.innerHTML = "";

    const botonGuardar = document.createElement("button");
    botonGuardar.textContent = "Guardar";
    botonGuardar.addEventListener("click", guardarCambiosHandler);
    botonesEdicion.appendChild(botonGuardar);

    const botonCancelar = document.createElement("button");
    botonCancelar.textContent = "Cancelar";
    botonCancelar.addEventListener("click", cancelarEdicionHandler);
    botonesEdicion.appendChild(botonCancelar);

    botonesEdicion.style.display = "block";

    // Manejador para guardar los cambios
    function guardarCambiosHandler() {
        console.log(`Guardando nuevo registro para: ${columna}`);

        // Crear un objeto dinámico con los valores de los inputs
        const nuevoRegistro = {};
        config.columnas.forEach(columna => {
            const input = document.getElementById(columna.clave);
            nuevoRegistro[columna.clave] = input.value;
        });

        // Enviar los datos mediante la función proporcionada
        solicitudPost(nuevoRegistro, apiConsultada, funcionPost);
        console.log("Datos guardados: ", nuevoRegistro);

        // Limpiar pantalla y recargar datos
        botonesEdicion.style.display = "none";
        tabla.innerHTML = "";
        cargarDatosHandler(columna);
    }

    // Manejador para cancelar la edición
    function cancelarEdicionHandler() {
        botonesEdicion.style.display = "none";
        tabla.innerHTML = "";
        cargarDatosHandler(columna);
    }
}
