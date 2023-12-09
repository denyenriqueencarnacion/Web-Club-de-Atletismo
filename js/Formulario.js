document.getElementById('tipo').addEventListener('change', function() {
    var campoDescripcion = document.getElementById('Descripcion');
    if (this.value === 'Entrenador') {
        campoDescripcion.style.display = 'block';
    } else {
        campoDescripcion.style.display = 'none';
    }
});
document.getElementById('tipo').addEventListener('change', function() {
    var grupo = document.getElementById('grupo');
    var PruebaPrincipal = document.getElementById('prueba_principal');
    var Marca = document.getElementById('marca');
    var Categoria = document.getElementById('categoria');
    if (this.value === 'Atleta') {
        grupo.style.display = 'block';
        PruebaPrincipal.style.display = 'block';
        Marca.style.display = 'block';
        Categoria.style.display = 'block';
    } else {
        grupo.style.display = 'none';
        grupo.style.display = 'none';
        PruebaPrincipal.style.display = 'none';
        Marca.style.display = 'none';
        Categoria.style.display = 'none';
    }
});