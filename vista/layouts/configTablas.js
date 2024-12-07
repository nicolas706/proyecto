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
            {clave: 'persona_nombre', titulo: 'Nombre'},
            {clave: 'tipo_trabajo', titulo: 'Tipo de Trabajo'},
            {clave: 'cosecha_anio', titulo: 'Año de Cosecha'},
            {clave: 'codigo', titulo: 'Codigo'}
        ]        
    }
}