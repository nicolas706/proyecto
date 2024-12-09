const configEntidades = {
    persona: {
        columnas: [
            {clave: 'nombre', titulo: 'Nombre',},
            {clave: 'apellido_paterno', titulo: 'Apellido Paterno'},
            {clave: 'apellido_materno', titulo: 'Apellido Materno'},
            {clave: 'rut', titulo: 'Rut'}, 
            {clave: 'sexo', titulo: 'Sexo'},
            {clave: 'fecha_de_nacimiento', titulo: 'Fecha de Nacimiento'},
            {clave: 'telefono', titulo: 'Telefono'}
        ]
    },

    cosecha: {
        columnas: [
            {clave: 'anio', titulo: 'Año'},
            {clave: 'detalle', titulo: 'Descripción'},
            {clave: 'activa', titulo: 'Estado'}
        ]
    },

    trabajador: {
        columnas: [
            //{clave: 'id', titulo: 'ID'},
            {clave: 'persona_nombre', titulo: 'Nombre'},
            {clave: 'tipo_trabajo', titulo: 'Tipo de Trabajo'},
            {clave: 'cosecha_anio', titulo: 'Año de Cosecha'},
            {clave: 'codigo', titulo: 'Codigo'}
        ]       
    },

    tarja: {
        columnas:[
            {clave: 'id', titulo:'ID'},
            {clave: 'codigo', titulo: 'Codigo de Tarja'},
            {clave: 'total_fisico', titulo: 'Total Fisico de cajas'},
            //{clave: 'codigos_registrados', titulo: 'Total de Códigos de barra'},
            {clave: 'fecha', titulo: 'Fecha'}
        ],

        fila:[
            {clave: 'tarja_id', titulo:'Tarja ID'},
            {clave: 'codigo', titulo: 'Titulo'},
            {clave: 'anio', titulo: 'Año Cosecha'},
            {clave: 'nombre', titulo: 'Carro'},
            //{clave: 'nombre_persona', titulo: 'Persona'},
            //{clave: 'tipo_trabajo', titulo: 'Tipo de Trabajo'},
            {clave: 'nombre_huerto', titulo: 'Huerto'},
            {clave: 'nombre_variedad', titulo: 'Variedad'},
            {clave: 'nombre_tipo_caja', titulo: 'Tipo de Caja'},
            {clave: 'total_fisico', titulo: 'Total Físico'},
            {clave: 'codigos_registrados', titulo: 'Códigos de Barra'}
        ]
    },

    cosecheros: {
        columnas:[
            //{clave: 'tarja_id', titulo: 'ID de la Tarja'},
            {clave: 'nombre_cosechero', titulo: 'Nombre Completo'},
            {clave: 'cantidad_cajas', titulo: 'Cantidad de Cajas en la Tarja'}
        ]
    }
}