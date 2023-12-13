<?php
session_start();
require_once "BD/conexionBD.php";
// require_once "../../Filtros/FiltroAdmin.php";
require "Controladores/NombreUsuario.php";
require "Controladores/CrearUsuarios.php";
$msg = registrarUsuario($conexion);
$usuario = recuerdaUsuario($conexion);
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='utf-8' />
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/calendario.css">
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.10/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.10/index.global.min.js'></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth'
            });
            calendar.render();
        });
    </script>
    <title>Calendario de competiciones</title>
</head>

<body>
    <!-- BARRA DE NAVEGACION -->
    <nav class="navbar navbar-expand-lg navbar-light bg-dark" id="encabezado">
        <div class="container-fluid">
            <a class="navbar-brand text-white fw-bold" href="index.php"><img class="media-object rounded-circle" src="img/logo.jpg" width="50" height="50"> CDA San Juan De Aznalfarache</a>
            <button class="navbar-toggler bg-danger" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-white-50" aria-current="page" id="texcab" href="Calendario_Competiciones.php">Calendario de
                            Competiciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white-50" id="texcab" href="Album.php">Albumes</a>
                    </li>
                </ul>
                <?php
                if (!empty($usuario)) {
                    echo '<div class="btn-group">
            <button type="button" class="btn dropdown-toggle text-white" data-bs-toggle="dropdown" aria-expanded="false">
                ' . $usuario["Nombre_de_usuario"] . ' (' . $usuario["Tipo"] . ')
            </button>
            <ul class="dropdown-menu bg-dark w-100">
                <li><a class="dropdown-item text-white" id="prueba" href="index.php">Volver a inicio</a></li>
                <li><hr class="dropdown-divider text-white"></li>
                <li><a class="dropdown-item text-white" id="prueba2" href="CerrarSession.php">Cerrar Sesion</a></li>
            </ul>
          </div>';
                } else {
                    echo "Invitado";
                }
                ?>

            </div>
        </div>
    </nav>
    <!-- BARRA DE NAVEGACION  -->

    <?php if (isset($usuario) && $usuario["Tipo"] == "Administrador") : ?>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventoModal">
            Crear Evento
        </button>

        <!-- Ventana Modal -->
        <div class="modal fade" id="eventoModal" tabindex="-1" aria-labelledby="eventoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eventoModalLabel">Crear Evento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="eventoForm">
                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título del Evento</label>
                                <input type="text" class="form-control" id="titulo" required>
                            </div>
                            <div class="mb-3">
                                <label for="fecha" class="form-label">Fecha del Evento</label>
                                <input type="date" class="form-control" id="fecha" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Crear Evento</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>


    <!-- CALENDARIO -->
    <div id='calendar'></div>
    <!-- CALENDARIO -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: obtenerEventosGuardados()
            });
            calendar.render();

            // Agregar evento submit al formulario
            document.getElementById('eventoForm').addEventListener('submit', function(event) {
                event.preventDefault();
                var titulo = document.getElementById('titulo').value;
                var fecha = document.getElementById('fecha').value;

                var evento = {
                    title: titulo,
                    start: fecha
                };
                calendar.addEvent(evento);
                guardarEvento(evento);
                var modal = new bootstrap.Modal(document.getElementById('eventoModal'));
                modal.hide();
            });

            function obtenerEventosGuardados() {
                var eventos = [];
                var cookies = document.cookie.split(';');
                cookies.forEach(function(cookie) {
                    var partes = cookie.split('=');
                    if (partes[0].trim() === 'evento') {
                        JSON.parse(decodeURIComponent(partes[1])).forEach(function(evento) {
                            evento.start = new Date(evento.start);
                            eventos.push(evento);
                        });
                    }
                });
                return eventos;
            }

            function guardarEvento(evento) {
                var eventosGuardados = obtenerEventosGuardados();
                eventosGuardados.push({
                    title: evento.title,
                    start: new Date(evento.start).toISOString()
                });
                document.cookie = 'evento=' + encodeURIComponent(JSON.stringify(eventosGuardados)) + '; expires=Thu, 18 Dec 2025 12:00:00 UTC; path=/';
            }
        });
    </script>

    <footer class="footer mt-auto py-3 bg-danger">
        <div class="container-fluid">
            <span class="text-white" id="letra">CDA San Juan De Aznalfarache | <span>Deny Enrique</span> </span>
        </div>
    </footer>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</html>