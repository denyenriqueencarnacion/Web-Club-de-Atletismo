document.addEventListener('DOMContentLoaded', function() {
    // Configuración inicial
    var campoDescripcion = document.getElementById('Descripcion');
    var grupo = document.getElementById('grupo');
    var PruebaPrincipal = document.getElementById('prueba_principal');
    var Marca = document.getElementById('marca');
    var Categoria = document.getElementById('categoria');

    campoDescripcion.style.display = 'none';
    grupo.style.display = 'block';
    PruebaPrincipal.style.display = 'block';
    Marca.style.display = 'block';
    Categoria.style.display = 'block';

    // Manejar cambios en el tipo
    document.getElementById('tipo').addEventListener('change', function() {
        if (this.value === 'Entrenador') {
            campoDescripcion.style.display = 'block';
            grupo.style.display = 'none';
            PruebaPrincipal.style.display = 'none';
            Marca.style.display = 'none';
            Categoria.style.display = 'none';
        } else {
            campoDescripcion.style.display = 'none';
            grupo.style.display = 'block';
            PruebaPrincipal.style.display = 'block';
            Marca.style.display = 'block';
            Categoria.style.display = 'block';
        }
    });
});
