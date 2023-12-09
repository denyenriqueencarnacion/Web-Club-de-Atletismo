<?php
function generarTarjetas($titulo, $cantidad)
{
    echo '<div class="container-fluid w-75 mt-2">
            <center>
                <h1 class="pb-1 p-lg-1 bg-dark bg-gradient text-white rounded">'.$titulo.'</h1>
            </center>

            <div class="album py-5 ">
                <div class="container">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">';
    
    // Generar las tarjetas según la cantidad especificada
    for ($i = 0; $i < $cantidad; $i++) {
        echo '<div class="col">
                <div class="card shadow-sm">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Imagen" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Imagen</text>
                    </svg>
                    <div class="card-body">
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="#" class="stretched-link text-decoration-none ">Ver</a>
                            <small class="text-muted">9 mins</small>
                        </div>
                    </div>
                </div>
            </div>';
    }

    echo '</div></div></div></div>';
}

// Generar los diferentes contenedores con diferentes cantidades de tarjetas
// generarTarjetas("Tecnicas de vallas, carrera, saltos y lanzamientos", 3);
// generarTarjetas("PARTE DE PREVENTIVOS", 4);
// generarTarjetas("PARTE DE ENTRENAMIENTOS", 6);
?>
