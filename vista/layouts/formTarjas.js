//Se recojen los elementos y se declaran variables para la tabla variedad
let idHuerto;
let opcionVariedad = document.createElement("option");
opcionVariedad.textContent = "Seleccione un huerto primero";
let datosVariedad;
const inputVariedad = document.createElement("select");
inputVariedad.id = "variedadId";
inputVariedad.name = "variedades";
inputVariedad.required = true;

// Función auxiliar para crear un label y un input  
function crearCampo(labelText, inputId, inputType, placeholder) {

    const label = document.createElement("label");
    label.textContent = labelText;
    label.setAttribute("for", inputId);

    const input = document.createElement("input");
    input.setAttribute("type", inputType);
    input.setAttribute("id", inputId);
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
        case "tipoCaja":
            filas.forEach(fila => {
                const option = document.createElement("option");
                option.value = fila.nombre;
                option.textContent = fila.nombre;
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
                    if(fila.id == idHuerto){
                        console.log(fila.nombre, "<= nombre variedad y id huerto=>", idHuerto);
                        const option = document.createElement("option");
                        option.value = fila.nombre;
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
                option.value = fila.anio;
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
                    option.value = fila.nombre;
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
                    option.value = fila.nombre;
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
async function formularioTarja(){
    //Se limpia la pantalla
    tablaInicial.style.display = "none";
    tituloTabla.innerHTML = "";
    tablaTarjas.innerHTML = "";
    tabla.innerHTML = "";
    botonNuevo.innerHTML = "";
    botonesEdicion.innerHTML = "";

    try {
        const response = await fetch("http://localhost/mvc/endPoint/api_tarja.php");
        const result = await response.json();

        if (!result.success) {
            console.error("Error en el servidor:", result.message);
            return;
        }

        if (result){
            const datos = Object.entries(result.data);
            //Input del codigo de la tarja
            const inputCodigo = crearCampo("Código Tarja", "inputCodigoTarja", "number", "Ingrese un número");

            datos.forEach(tablaTarjas =>{
                //Se recoje la llave y los datos de cada tablaTarjas
                let keys = tablaTarjas[0];
                let columnas = tablaTarjas[1];
                let filas;
                //console.log("Esta es la key: ",keys);
                //console.log("Estas son las columnas: ", columnas);

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
                        crearSelect("Seleccione el tipo de caja", "cajaId", keys, columnas, "tipoCaja");
                    break;
                }
            })

            //Input de cantidad de cajas
            const inputCantCaja = crearCampo("Cantidad de cajas", "inputCantCaja", "number", "Ingrese la cantidad")

            const guardar = document.createElement("button");
            guardar.textContent = "Guardar";
            guardar.setAttribute("id", "enviarForm");
            guardar.addEventListener('click', () => {
                const selects = document.querySelectorAll('.selectTarja');
                const registros = [];

                selects.forEach(select => {
                    registros.push(select.value);
                });

                console.log(registros);
                alert("Registro guardado exitosamente", registros);
            })
            tablaTarjas.appendChild(guardar);
            }
    } catch(error){
        console.log("Error en lo solicitud:", error)
    }
} 