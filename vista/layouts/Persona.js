class Persona {
    constructor(rut, nombre, apellido_paterno, apellido_materno, sexo, fecha_de_nacimiento, telefono) {
        this.rut = rut;
        this.nombre = nombre;
        this.apellido_paterno = apellido_paterno;
        this.apellido_materno = apellido_materno;
        this.sexo = sexo;
        this.fecha_de_nacimiento = fecha_de_nacimiento;
        this.telefono = telefono;

        this.columnas = [
            {clave: 'nombre', titulo: 'Nombre',},
            {clave: 'apellido_paterno', titulo: 'Apellido Paterno'},
            {clave: 'rut', titulo: 'Rut'}, 
            {clave: 'sexo', titulo: 'Sexo'}
        ]
    }
}
