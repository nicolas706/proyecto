//Se recojen los elementos y se declaran variables para la tabla variedad
let idHuerto;
let opcionVariedad = document.createElement("option");
opcionVariedad.textContent = "Seleccione un huerto primero";
let datosVariedad;
const inputVariedad = document.createElement("select");
inputVariedad.id = "variedadId";
inputVariedad.name = "variedades";
inputVariedad.setAttribute('class', "selectTarja");
inputVariedad.required = true;

// Función auxiliar para crear un label y un input  
function crearCampo(labelText, inputId, inputType, placeholder) {

    const label = document.createElement("label");
    label.textContent = labelText;
    label.setAttribute("for", inputId);

    const input = document.createElement("input");
    input.setAttribute("type", inputType);
    input.setAttribute("id", inputId);
    input.setAttribute('class', "selectTarja");
    input.setAttribute("placeholder", placeholder);

    input.value = 

    tablaTarjas.appendChild(label);
    tablaTarjas.appendChild(input);

    return input;
}

// Función auxiliar para crear un label y un select respectivo para cada campo  
function crearSelect(labelText, selectId, key, filas, campo){
    const label = document.createElement("label");
    label.textContent = labelText;
    label.setAttribute("for", selectId);

    const input = document.createElement("select");
    input.id = selectId;
    input.name = key;
    input.setAttribute('class', "selectTarja");
    input.required = true;
    
    //Para cada tabla se generan los labels y opciones para el select respectivos
    switch (campo){
        //case "huerto":
        case "variedad":
            tablaTarjas.appendChild(label);
            tablaTarjas.appendChild(inputVariedad);
            inputVariedad.appendChild(opcionVariedad);
            datosVariedad = filas;
        break;
        case "carro":
            filas.forEach(fila => {
                const option = document.createElement("option");
                option.value = fila.id;
                option.textContent = fila.nombre;
                input.appendChild(option);
            })
            tablaTarjas.appendChild(label);
            tablaTarjas.appendChild(input);
        break;
        case "tipoCaja":
            filas.forEach(fila => {
                const option = document.createElement("option");
                option.value = fila.id;
                option.textContent = fila.capacidad_kg +" KG";
                input.appendChild(option);
            })
            tablaTarjas.appendChild(label);
            tablaTarjas.appendChild(input);
        break;

        case "huerto":
            input.addEventListener('change', () => {
                inputVariedad.innerHTML = "";
                idHuerto = input.value;
                
                datosVariedad.forEach(fila =>{
                    if(fila.id_huerto == idHuerto){
                        console.log(fila.nombre, "<= nombre variedad y id huerto=>", idHuerto);
                        const option = document.createElement("option");
                        option.value = fila.id_variedad;
                        option.textContent = fila.nombre;
                        inputVariedad.appendChild(option);
                    }
                })
            })
            tablaTarjas.appendChild(label);
            tablaTarjas.appendChild(input);
            filas.forEach(fila => {
                const option = document.createElement("option");
                option.value = fila.id;
                option.textContent = fila.nombre;
                input.appendChild(option);
            })
            tablaTarjas.appendChild(label);
            tablaTarjas.appendChild(input);
        break;

        case "cosecha":
            filas.forEach(fila => {
                const option = document.createElement("option");
                option.value = fila.id;
                option.textContent = fila.anio;
                input.appendChild(option);
            })
            tablaTarjas.appendChild(label);
            tablaTarjas.appendChild(input);
        break;

        case "tractorista":
            filas.forEach(fila => {
                if(fila.tipo_trabajo_id === 1){
                    const option = document.createElement("option");
                    option.value = fila.id;
                    option.textContent = fila.nombre;
                    input.appendChild(option);
                }
            })
            tablaTarjas.appendChild(label);
            tablaTarjas.appendChild(input);
        break;

        case "digitador":
            filas.forEach(fila => {
                if(fila.tipo_trabajo_id === 2){
                    const option = document.createElement("option");
                    option.value = fila.id;
                    option.textContent = fila.nombre;
                    input.appendChild(option);
                }
            })
            tablaTarjas.appendChild(label);
            tablaTarjas.appendChild(input);
        break;
    }
}

//Función con el fetch a la base de datos
async function cargarTarja(){
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
            tablaConsultada = 'tarjas';
            datosJson = result;
            console.log(datosJson);
            mostrarDatos(result.data.tarjas, configEntidades.tarja.columnas, "tarjas");
        }
    } catch(error){
        console.log("Error en lo solicitud:", error)
    }
} 

function formularioTarja(result){
    //Se limpia la pantalla
    tablaInicial.style.display = "none";
    tituloTabla.innerHTML = "";
    tablaTarjas.innerHTML = "";
    tabla.innerHTML = "";
    botonNuevo.innerHTML = "";
    botonesEdicion.innerHTML = "";
    formularioEdicion.innerHTML = "";

    const datos = Object.entries(result.data);
    //Input del codigo de la tarja
    const inputCodigo = crearCampo("Código Tarja", "inputCodigoTarja", "number", "Ingrese un número");
    console.log(datos);

    datos.forEach(tablaTarjas =>{
        //Se recoje la llave y los datos de cada tablaTarjas
        let keys = tablaTarjas[0];
        let columnas = tablaTarjas[1];
        let filas;

        //Se crean los select con los datos respectivos
        switch (keys) {
            case "cosechas":
                crearSelect("Año de cosecha", "cosechaId", keys, columnas, "cosecha");
            break;

            case "huertos":
                crearSelect("Seleccione un Huerto", "huertoId", keys, columnas, "huerto");
            break;

            case "carros":
                crearSelect("Selecciones el carro que se usó", "carroId", keys, columnas, "carro");
            break;

            case "variedades":
                crearSelect("Selecciones la variedad", "variedadId", keys, columnas, "variedad");
            break;

            case "trabajadores":
                crearSelect("Seleccione al Tractorista", "tractoristaId", keys, columnas, "tractorista");
                crearSelect("Seleccione al Digitador", "digitadorId", keys, columnas, "digitador");
            break;

            case "tipo_cajas":
                crearSelect("Seleccione el tipo de caja", "tipo_caja", keys, columnas, "tipoCaja");
            break;
        }
    })

    //Input de cantidad de cajas
    const inputCantCaja = crearCampo("Cantidad de cajas", "cantidadCajas", "number", "Ingrese la cantidad")

    const guardar = document.createElement("button");
    guardar.textContent = "Guardar";
    guardar.setAttribute("id", "enviarForm");
    guardar.addEventListener('click', () => {
        const selects = document.querySelectorAll('.selectTarja');
        const registros = {};
        
        selects.forEach(select => {
            //Datos guardados en JSON con la key guardada como el ID del input
            registros[select.id] = select.value;
        });

        console.log(registros);
        alert("Registro guardado exitosamente ", registros);
    })
    tablaTarjas.appendChild(guardar);
            
}

async function vistaTarja(index, parametros){
    console.log("ID de la tarja: ", index);
    //Se limpia la pantalla
    tablaInicial.style.display = "none";
    tituloTabla.innerHTML = "";
    tablaTarjas.innerHTML = "";
    tabla.innerHTML = "";
    botonNuevo.innerHTML = "";
    botonesEdicion.innerHTML = "";
    formularioEdicion.innerHTML = "";
    try{
        const response = await fetch("http://localhost/mvc/endPoint/api_tarja.php?funcion=mostrarFilas");
        const result = await response.json();

        console.log(result.data);
        let datosTarjas = Object.values(result.data);
        let idConsultada = index;
        //console.log("Datos recuperados ", datosJson);
        //Titulos de la tabla
        const cabecera = document.createElement("tr");
        const thPropiedad = document.createElement("th");
        thPropiedad.textContent = "Propiedad";
        const thInfo = document.createElement("th");
        thInfo.textContent = "Resultado";

        cabecera.appendChild(thPropiedad);
        cabecera.appendChild(thInfo);

        tituloTabla.appendChild(cabecera);

        //Filas de la columna principal
        //Se pasa por cada elemento de la tarja
        datosTarjas[0].forEach(fila => {
            if (idConsultada == fila.tarja_id){
                let valores = Object.entries(fila);
                console.log("Info de la fila: ", valores);
                valores.forEach(registro =>{
                    const fila = document.createElement("tr");
                    parametros.forEach(columna =>{
                        if(columna.clave == registro[0]){
                            //console.log(`Este es el valor de la columna ${columna.clave}: ${registro[1]}`)
                            const celda1 = document.createElement("td");
                            celda1.textContent = columna.titulo;
                            const celda2 = document.createElement("td");
                            celda2.textContent = registro[1];

                            fila.appendChild(celda1);
                            fila.appendChild(celda2);

                            tabla.appendChild(fila);
                        }
                    })
                })   
            } else {
                //console.log("Ignorar fila");
            }    
        })

        //Tabla de cantidad de cajas por cosechero
        const tablaCosechero = document.createElement("table");
        const cabeceraCosechero = document.createElement("thead");
        const bodyCosechero = document.createElement("tbody");

        const tituloCosechero = document.createElement("tr");

        const cantCajas = Object.values(datosJson.data.cajas_cosechero);
        console.log("Object filas: ",cantCajas);

        //Titulos
        const columnasCosechero = configEntidades.cosecheros.columnas;
        columnasCosechero.forEach(columnas => {
            const th = document.createElement("th");
            th.textContent  = columnas.titulo;
            tituloCosechero.appendChild(th);
        })
        
        cantCajas.forEach(filas => {
            if(idConsultada == filas.tarja_id){
                console.log("Cosechero de la Tarja ", filas.nombre_cosechero);
                const fila = document.createElement("tr");
                columnasCosechero.forEach(columna => {
                    const celda = document.createElement("td");
                    celda.textContent = filas[columna.clave];
                    fila.appendChild(celda);
                })
                bodyCosechero.appendChild(fila);
            }
        })

        cabeceraCosechero.appendChild(tituloCosechero);

        tablaCosechero.appendChild(cabeceraCosechero);
        tablaCosechero.appendChild(bodyCosechero);
        
        formularioEdicion.appendChild(tablaCosechero);

    } catch(error){
        console.log("Error en lo solicitud:", error)
    }
}


function consultaExcel(){
    fetch('http://localhost/mvc/endPoint/api_excel.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            fecha: '' // Cambiar por la fecha deseada
        }),
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.blob();
        })
        .then(blob => {
            // Descargar el archivo Excel
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'listado_cajas_por_trabajador.xlsx';
            document.body.appendChild(a);
            a.click();
            a.remove();
        })
        .catch(error => console.error('Error:', error));
    
}