//Función genérica para mostrar en pantalla las filas de la tabla respectiva
function mostrarDatos(datos, columnas, value) {
    //Se limpia la tabla
    tabla.innerHTML = "";
    tituloTabla.innerHTML = "";
    tablaTarjas.innerHTML = "";
    botonNuevo.innerHTML = "";
    botonesEdicion.innerHTML = "";
    formularioEdicion.innerHTML = "";


    //Se crea cabecera, para los respectivos titulos
    const botonNuevoRegistro = document.createElement("button");
    botonNuevoRegistro.textContent = "Nuevo Registro";
    botonNuevo.appendChild(botonNuevoRegistro);
    console.log("Datos ingresados a mostrarDatos: ", datos);
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
        //console.log("Este es el id de la fila: "+ dato.id)
        let id = dato.id;
        const fila = document.createElement("tr");
        columnas.forEach(columna => {
            const celda = document.createElement("td");
            celda.textContent = dato[columna.clave] || '';
            fila.appendChild(celda);
        });

        const celdaAccion = document.createElement("td");

        if(value == "tarjas"||value =="total_cajas") {
            // Botón Editar
            const consultaTarja = document.createElement("button");
            consultaTarja.textContent = "Ver Detalles";
            consultaTarja.addEventListener("click", () => vistaTarja(id, configEntidades.tarja.fila));
            celdaAccion.appendChild(consultaTarja);
        } else {
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
        }
        
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
    botonNuevo.innerHTML = "";

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
function nuevoRegistro(tablaConsultada) {
    botonNuevo.innerHTML = "";
    // Obtén la configuración de la columna desde configcolumnaes
    const config = configEntidades[tablaConsultada];

    if (tablaConsultada == 'tarjas'){
        console.log("Formualrio para Tarjas")
        formularioTarja(datosJson);
        return;
    }

    if (!config) {
        console.error(`No se encontró configuración para la columna: ${tablaConsultada}`);
        return;
    }

    // Limpia la pantalla
    tituloTabla.innerHTML = "";
    tabla.innerHTML = "";
    botonNuevo.innerHTML = "";
    console.log(`Creando nuevo registro para: ${tablaConsultada}`);

    // Crear inputs dinámicos en base a las columnas configuradas
    config.columnas.forEach(columna => {
        const label = document.createElement("label");
        label.textContent = columna.titulo;
        label.setAttribute("for", columna.clave);

        const input = document.createElement("input");
        input.setAttribute("type", columna.clave === 'fecha_de_nacimiento' ? 'date' : (columna.tipo || "text"));
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
        console.log(`Guardando nuevo registro para: ${tablaConsultada}`);

        // Crear un objeto dinámico con los valores de los inputs
        const nuevoRegistro = {};
        config.columnas.forEach(columna => {
            const input = document.getElementById(columna.clave);
            nuevoRegistro[columna.clave] = input.value;
        });

        // Enviar los datos mediante la función proporcionada
        solicitudPost(nuevoRegistro, apiConsultada, funcionCreate);
        console.log("Datos guardados: ", nuevoRegistro);
        console.log("Se recomienda volver a consultar la tabla");

        // Limpiar pantalla y recargar datos
        botonesEdicion.style.display = "none";
        tabla.innerHTML = "";
        mostrarDatos(datosJson, config.columnas);
    }

    // Manejador para cancelar la edición
    function cancelarEdicionHandler() {
        botonesEdicion.style.display = "none";
        tabla.innerHTML = "";
        mostrarDatos(datosJson, config.columnas);
    }
}
