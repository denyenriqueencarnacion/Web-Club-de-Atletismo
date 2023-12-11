<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>CDA San Juan</title>
</head>

<body>
  <!-- Aqui es donde realizo la barra de navegaciones utilizando los ejemplos de bootstrap -->
  <nav class="navbar navbar-expand-lg navbar-light bg-dark" id="encabezado">
    <div class="container-fluid">
      <a class="navbar-brand text-white fw-bold" href="index.html"><img class="media-object rounded-circle"
          src="img/logo.jpg" width="50" height="50"> CDA San Juan De Aznalfarache</a>
      <button class="navbar-toggler bg-danger" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active text-white-50" aria-current="page" id="texcab"
              href="Calendario_Competiciones.php">Calendario de
              Competiciones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white-50" id="texcab" href="Album.php">Albumes</a>
          </li>
        </ul>
        <div class="d-flex m-2">
         <a href="login.php" class=" text-decoration-none text-dark"> <button class="btn">Iniciar Sesion</button></a>
        </div>
        <!-- <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn  btn-primary" type="submit">Search</button>
        </form> -->
      </div>
    </div>
  </nav>

  <!-- En esta parte es donde realizo todo el cuerpo de la pagina de inicio  -->

  <main class="container p-2">
    <div class="p-md-5 mb-4 rounded" id="fondo-principal">
      <div class="container text-center text-light" id="titulos">
        <div class="bg-dark p-2 rounded border border-success border-3 bg-gradient">
          <h1 id="txts">MAS QUE UN CLUB UNA FAMILIA</h1>
          <p>Persigue tus sueños de ser un deportista profesional junto a nosotros!</p>
        </div>
      </div>
    </div>
    <div class="row mb-2">
      <div class="container-fluid ">
        <div
          class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative bg-dark bg-gradient">
          <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-primary">Nuevo!</strong>
            <h3 class="mb-0" id="txts">Visita Nuestros albumes</h3>
            <div class="mb-1 text-muted">Oct 18</div>
            <p class="card-text text-white">Disfruta de las imagenes de nuestros mejores momento como equipo</p>
            <a href="Album.php" class="stretched-link">Ver albumes</a>
          </div>
          <div class="col-auto d-none d-lg-block">
            <img src="img/equip2o.jpg" width="300" height="250" alt="">
          </div>
        </div>
      </div>
    </div>


    <div class="row g-5">
      <div class="col-md-8">
        <h3 class="pb-1 p-lg-1 mb-4 fst-italic bg-dark text-light bg-gradient rounded text-decoration-underline">
          ATLETA DE LA SEMANA
        </h3>
        <article class="blog-post ">

          <h2>ANA ESTRELLA BATE RECORD DE ESPAÑA SUB16👏🏽👏🏽👏🏽</h2>
          <p class="blog-post-meta">January 22, 2023</p>

          <p>Impresionante lo tuyo!! Eres de otra liga!!! ⭐️🏆💚</p>
          <p>
            Primero ha batido por segunda vez en la temporada, el récord de Andalucía cadete con un salto de 12.21m.
            Pero en el cuarto salto lo ha vuelto a hacer, batiendo su máximo propia marca personal con un salto de
            12.51m.
          </p>
          <p>
            Récord de España Sub16 en Triple Salto!!
            ENHORABUENA CAMPEONA!!! Estamos súper orgullosos de ti!!💪🏽🏆💚⭐️🫶🏽🏃🏽‍♀️
          </p>
          <img src="img/estrella.jpg" width="30%" alt="ESTRELLA" class="pb-5">
          <hr>
          <h2 class="pb-1 p-lg-1 mb-4 fst-italic bg-dark text-light bg-gradient rounded text-decoration-underline">Parte3
          </h2>
          <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Praesentium corporis nisi quos beatae magnam?
            Dolor quae doloremque maiores illum labore quia? Accusantium commodi, tenetur laborum iste quibusdam nulla
            illum hic!</p>
          <ul>
            <li><strong>To bold text</strong>, use <code
                class="language-plaintext highlighter-rouge">&lt;strong&gt;</code>.</li>
            <li><em>To italicize text</em>, use <code class="language-plaintext highlighter-rouge">&lt;em&gt;</code>.
            </li>
            <li>Abbreviations, like <abbr title="HyperText Markup Langage">HTML</abbr> should use <code
                class="language-plaintext highlighter-rouge">&lt;abbr&gt;</code>, with an optional <code
                class="language-plaintext highlighter-rouge">title</code> attribute for the full phrase.</li>
            <li>Citations, like <cite>— Mark Otto</cite>, should use <code
                class="language-plaintext highlighter-rouge">&lt;cite&gt;</code>.</li>
            <li><del>Deleted</del> text should use <code class="language-plaintext highlighter-rouge">&lt;del&gt;</code>
              and <ins>inserted</ins> text should use <code
                class="language-plaintext highlighter-rouge">&lt;ins&gt;</code>.</li>
            <li>Superscript <sup>text</sup> uses <code class="language-plaintext highlighter-rouge">&lt;sup&gt;</code>
              and subscript <sub>text</sub> uses <code class="language-plaintext highlighter-rouge">&lt;sub&gt;</code>.
            </li>
          </ul>
          <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Praesentium corporis nisi quos beatae magnam?
            Dolor quae doloremque maiores illum labore quia? Accusantium commodi, tenetur laborum iste quibusdam nulla
            illum hic!</p>
          <h2>Heading</h2>
          <p>TLorem, ipsum dolor sit amet consectetur adipisicing elit. Praesentium corporis nisi quos beatae magnam?
            Dolor quae doloremque maiores illum labore quia? Accusantium commodi, tenetur laborum iste quibusdam nulla
            illum hic!</p>
          <h3>Sub-heading</h3>
          <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Praesentium corporis nisi quos beatae magnam?
            Dolor quae doloremque maiores illum labore quia? Accusantium commodi, tenetur laborum iste quibusdam nulla
            illum hic!</p>
          <pre><code>Example code block</code></pre>
          <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Praesentium corporis nisi quos beatae magnam?
            Dolor quae doloremque maiores illum labore quia? Accusantium commodi, tenetur laborum iste quibusdam nulla
            illum hic!</p>
        </article>

        <article class="blog-post">
          <hr>
          <h2 class="pb-1 p-lg-1 mb-4 fst-italic text-white bg-dark bg-gradient rounded text-decoration-underline">Parte4
          </h2>
          <p class="blog-post-meta">January 22, 2020</p>

          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit eum id mollitia ducimus amet ratione ipsum ex
            quis, porro ipsa vitae assumenda! Rerum accusantium nobis labore laborum neque voluptatum pariatur!</p>
          <blockquote>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Animi iusto excepturi eos in ab, quae corrupti
              veritatis architecto fugiat rerum voluptatibus harum facilis. Eos sapiente, omnis modi aspernatur fugiat
              harum. <strong>emphasized text</strong> in the middle of it.</p>
          </blockquote>
          <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Excepturi soluta ex ducimus numquam consectetur
            praesentium, similique neque. Fuga earum voluptatibus tempora sint deserunt id adipisci! Adipisci
            consequuntur laborum hic sed!</p>
          <h3>RANKING SEMANAL</h3>
          <p>Posiciones en campeonatos de Andalucia/España</p>
          <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Puesto</th>
                <th>Marca</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Deny enrique</td>
                <td>Campeon</td>
                <td>8.21 60mv</td>
              </tr>
              <tr>
                <td>Eduardo Ramirez</td>
                <td>Campeon</td>
                <td>49.93 400ml</td>
              </tr>
              <tr>
                <td>Ana estrella</td>
                <td>Campeona</td>
                <td>12.51 Triple salto</td>
              </tr>
            </tbody>
          </table>

          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi consequatur sapiente minima optio
            officia consectetur temporibus maxime eius eligendi placeat nihil deserunt fugiat omnis rerum, nam dolorem!
            Natus, voluptatum quo?</p>
        </article>

        <article class="blog-post">
          <hr>
          <h2 class="pb-1 p-lg-1 mb-4 fst-italic bg-dark text-light bg-gradient rounded text-decoration-underline">
            PATROCINADORES</h2>
          <img src="img/ayunta.jpg" alt="">
          <img src="img/logo-faguer.jpg" alt="">
          <img src="img/pancarta MAU LOA CAMPUS VERDES.jpg" width="20%" alt="">
      </div>

      <div class="col-md-4">
        <div class="position-sticky" style="top: 2rem;">
          <div class="p-4 mb-3 text-white bg-dark bg-gradient  rounded">
            <h4 class="fst-italic text-decoration-underline">Sobre Nosotros</h4>
            <p class="mb-0">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Tenetur, provident. Voluptates
              velit error voluptate neque autem. Autem, fuga! Officiis quia veniam laborum nostrum in odit tempore
              perspiciatis, aliquid quos optio?</p>
          </div>

          <div class="p-4 mt-3 bg-dark bg-gradient  rounded">
            <h4 class="fst-italic text-light text-decoration-underline">Siguenos!</h4>
            <ol class="list-unstyled ">
              <li><a class="text-decoration-underline text-white"
                  href="https://www.instagram.com/cdatletismosanjuan/">Instagram</a></li>
              <li><a class="text-decoration-underline text-white" href="#">Twitter</a></li>
              <li><a class="text-decoration-underline text-white" href="#">Facebook</a></li>
            </ol>
          </div>
        </div>
      </div>
    </div>

  </main>
  <!-- fin contenido -->

  <footer class="footer mt-auto py-3 bg-danger">
    <div class="container-fluid">
      <span class="text-white" id="letra">CDA San Juan De Aznalfarache | <span>Deny Enrique</span> </span>
    </div>
  </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
  integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
  integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</html>