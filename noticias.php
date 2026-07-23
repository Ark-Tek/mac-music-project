<?php require 'partials/embeds.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Noticias — Mac Music Project</title>
<?php include 'partials/head-assets.php'; ?>
</head>
<body data-page="noticias">
<?php include 'partials/cookie-banner.php'; ?>
<div class="layout">

<?php include 'partials/brand-panel.php'; ?>

  <main class="content-panel">

<?php include 'partials/subnav.php'; ?>

    <section class="page-body">
      <p class="eyebrow">Actualidad</p>
      <h1>Noticias</h1>
      <p class="lede">Anuncios, actualizaciones del estudio y todo lo que va pasando con el proyecto, según va ocurriendo.</p>

      <?php
      // ---------------------------------------------------------------
      // To add or update a news item, edit this list.
      // source: outlet/publication name shown as the badge
      // url: link to the full article (opens in a new tab)
      // thumbnail: falls back to the logo if not set
      // synopsis: plain string or the richer title/subtitle/body format
      // ---------------------------------------------------------------
      $news = [
        [
          'title'     => 'REZA, la primera canción nacida entre humano e inteligencia artificial, impulsa desde Cantabria una nueva era musical',
          'source'    => 'Cadena SER · Radio Santander',
          'desc'      => '4 junio 2026',
          'thumbnail' => 'assets/portada_reza.png',
          'url'       => 'https://cadenaser.com/cantabria/2026/06/04/reza-la-primera-cancion-nacida-entre-humano-e-inteligencia-artificial-impulsa-desde-cantabria-una-nueva-era-musical-radio-santander/',
          'synopsis'  => [
            'title'    => 'REZA EN CADENA SER',
            'subtitle' => 'Un productor con más de 30 años de trayectoria fusiona composición humana e IA desde Cantabria.',
            'body'     => 'Pedro Fernández, productor con paso por sellos como BMG y Sony Music, presenta MAC Music Project: una fusión de composición humana e inteligencia artificial que da lugar a "Reza", su primer lanzamiento. La letra es enteramente suya; la IA se usa solo para trasladar esa visión a un sonido que mezcla blues y gospel, géneros poco frecuentes en el mercado español.<br><br>Fernández defiende la tecnología como herramienta, no como sustituto: <strong>"La IA no hace absolutamente nada si no hay un humano detrás"</strong>. El proyecto podría situarse entre los primeros en España en registrar en el Registro de la Propiedad Intelectual una obra creada con apoyo de IA, apoyándose en la autoría humana de todo el proceso.<br><br>"Reza" es el primer adelanto de un EP de cuatro temas con estética visual inspirada en los vinilos clásicos, con lanzamiento completo previsto para septiembre.',
          ],
        ],
        [
          'title'     => 'Segundo titular (placeholder)',
          'source'    => 'Nombre del medio 2',
          'desc'      => 'Fecha por confirmar',
          'thumbnail' => 'assets/logo.jpg',
          'url'       => '#',
          'synopsis'  => [
            'title'    => 'RESUMEN DE LA NOTICIA 2',
            'subtitle' => 'Sustituye por una frase corta que resuma esta segunda cobertura.',
            'body'     => 'Sustituye este párrafo por el extracto real de la segunda noticia, con su enlace correspondiente.',
          ],
        ],
        [
          'title'     => 'Tercer titular (placeholder)',
          'source'    => 'Nombre del medio 3',
          'desc'      => 'Fecha por confirmar',
          'thumbnail' => 'assets/logo.jpg',
          'url'       => '#',
          'synopsis'  => [
            'title'    => 'RESUMEN DE LA NOTICIA 3',
            'subtitle' => 'Sustituye por una frase corta que resuma esta tercera cobertura.',
            'body'     => 'Sustituye este párrafo por el extracto real de la tercera noticia, con su enlace correspondiente.',
          ],
        ],
      ];
      ?>

      <div class="release-grid">
        <?php foreach ($news as $item): ?>
          <?php echo render_news($item); ?>
        <?php endforeach; ?>
      </div>
    </section>

<?php include 'partials/footer.php'; ?>
  </main>

</div>

<script src="script.js"></script>
</body>
</html>
