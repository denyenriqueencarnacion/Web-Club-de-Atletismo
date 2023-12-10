document.getElementById('cantidad').addEventListener('change', function () {
    const cantidad = parseInt(this.value);
    const contenedorTexto = document.getElementById('contenedor-texto');
    contenedorTexto.innerHTML = ''; // Limpiar el contenido actual

    for (let i = 1; i <= 6; i++) {
        const nuevoTextarea = document.createElement('div');
        nuevoTextarea.classList.add('mb-3');
        nuevoTextarea.innerHTML = `
            <label for="textoTarjeta${i}" class="form-label">Contenido ${i}</label>
            <textarea class="form-control" id="textoTarjeta${i}" name="textoTarjeta${i}" rows="3"></textarea>
        `;
        if (i <= cantidad) {
            contenedorTexto.appendChild(nuevoTextarea);
        }
    }
});
