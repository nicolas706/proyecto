const configEntidades = {
    persona: {
        columnas: [
            {clave: 'nombre', titulo: 'Nombre',},
            {clave: 'apellido_paterno', titulo: 'Apellido Paterno'},
            {clave: 'apellido_materno', titulo: 'Apellido Materno'},
            //{clave: 'rut', titulo: 'Rut'}, 
            //{clave: 'sexo', titulo: 'Sexo'},
            //{clave: 'fecha_de_nacimiento', titulo: 'Fecha de Nacimiento'},
            //{clave: 'telefono', titulo: 'Telefono'}
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
        /*columnas: [  Vista ideal
            {clave: 'id', titulo: 'ID'},
            {clave: 'codigo', titulo: 'Codigo'},
            {clave: 'persona_nombre', titulo: 'Nombre'},
            {clave: 'persona_apellido_paterno', titulo: 'Apellido Paterno'},
            {clave: 'persona_apellido_materno', titulo: 'Apellido Materno'},
            {clave: 'tipo_trabajo_nombre', titulo: 'Trabajo'},
            {clave: 'cosecha_año', titulo: 'Año cosecha'}
        ]*/

        columnas: [
            {clave: 'id', titulo: 'ID'},
            {clave: 'cosecha_id', titulo: 'ID de cosecha'},
            {clave: 'tipo_trabajo_id', titulo: 'ID del tipo Trabajo'},
            {clave: 'persona_id', titulo: 'ID de la persona'},
            {clave: 'codigo', titulo: 'Codigo relaciona'}
        ]        
    }
}