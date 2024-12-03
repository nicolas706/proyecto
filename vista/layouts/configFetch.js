//Funcion para obtener los datos
async function solicitudGet(api, funcionConvocada) {
    try {
        const response = await fetch(`http://localhost/mvc/endPoint/${api}.php?funcion=${funcionConvocada}`);
        const data = await response.json();
        if (data && data.data) {
            //console.log("Datos obtenidos, consulta get:", data.data[0]);
            return data.data[0]; // Retorna los datos obtenidos
        } else {
            console.error("Error: ", data.message);
            return null;
        }
    } catch (error) {
        console.error("Error en la conexión: ", error);
        return null;
    }
}

//Funcion fetch para actualizar registro
function solicitudUpdate(id, datos, tabla, api, funcion){
    //Se guardan los datos a enviar, como el nombre de la tabla, el contenido editado y la condición
    data = {
        tabla: tabla,
        data: datos,
        condicion: "id="+id
    }
    
    console.log("Fila editada: ",id, datos)
    fetch(`http://localhost/mvc/endPoint/${api}.php?funcion=${funcion}`, {
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
/*
function solicitudDelate(api, id){
    //console.log(`Solicutud delete, se rescata la api consultada: ${api} y el id de la fila ${id}`);
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
        if (result.success) {
            alert("Registro eliminado exitosamente.");
        } else {
            alert("Error: " + result.message);
        }
    })
    .catch(error => {
        console.error("Error en el fetch:", error);
    })
    }
    cargarPersona();
}*/