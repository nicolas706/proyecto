let boton = document.getElementById("miBoton")
let tabla = document.getElementById("resultado").querySelector("tbody");
boton.addEventListener('click', cargarDatos);
let datosJson;

function cargarDatos(){     

    fetch('http://localhost/mvc/endPoint/api_mostrar_persona.php?tabla=persona')
    .then(response => response.json())
    .then(data => {
        if (data && data.data) {
                    
            datosJson = data.data[0];
            tabla.innerHTML = "";

            datosJson.forEach((element, index) => {
                console.log(element)

                let fila = document.createElement("tr")

                let numFila = document.createElement("td")
                numFila.setAttribute("scope", "row")
                numFila.textContent = index + 1;
                fila.appendChild(numFila)

                let celdaNombre = document.createElement("td");
                celdaNombre.textContent = element.nombre;
                fila.appendChild(celdaNombre);

                let celdaRut = document.createElement("td");
                celdaRut.textContent = element.rut;
                fila.appendChild(celdaRut);

                let celdaApellido = document.createElement("td");
                celdaApellido.textContent = element.apellido_paterno + " " +element.apellido_materno;
                fila.appendChild(celdaApellido);

                tabla.appendChild(fila);
                });
        } else {
            console.error('Error:', data.message);
        }
    })
    .catch(error => console.error('Error de conexión:', error));
            
}   