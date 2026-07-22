<?php require 'partials/embeds.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Lanzamientos — Mac Music Project</title>
<?php include 'partials/head-assets.php'; ?>
</head>
<body data-page="lanzamientos">
<?php include 'partials/cookie-banner.php'; ?>
<div class="layout">

<?php include 'partials/brand-panel.php'; ?>

  <main class="content-panel">

<?php include 'partials/subnav.php'; ?>

    <section class="page-body">
      <p class="eyebrow">Catálogo</p>
      <h1>Lanzamientos</h1>
      <p class="lede">El catálogo de música ya publicada por Mac Music Project. Haz clic en la portada para escuchar o ver cada lanzamiento.</p>

      <?php
      $releases = [
        [
          'type'      => 'spotify',
          'title'     => 'Reza',
          'desc'      => 'Sencillo — 2026',
          'url'       => 'https://open.spotify.com/track/REPLACE_WITH_REAL_TRACK_ID',
          'thumbnail' => 'assets/portada_reza.png',
          'synopsis'  => [
      'title'    => 'REZA',
      'subtitle' => 'No pide ser creída. Impone su existencia.',
      'body' => 'Nace desde un territorio de presión insoportable, donde la identidad fue puesta a prueba, atacada y empujada al límite del silencio. No habla de un conflicto: lo sobrevive.<br><br>Es un blues roto, sucio, sin redención, atravesado por un gospel que ya no consuela, sino que arde. Una mezcla imposible entre lo espiritual y lo devastado, donde cada nota suena como si fuera la última resistencia antes del colapso.<br><br>Aquí la verdad no es luz ni bandera: es una herida abierta que se niega a cerrarse aunque el mundo insista en enterrarla.<br><br>No hay estructura que alivie. No hay estribillo que salve. No hay aire entre golpes.<br><br>La canción avanza como una caída lenta hacia un punto donde el dolor deja de ser interno y se vuelve declaración.<br><br>“REZA” toma su propio título y lo rompe desde dentro. Ya no es fe, ni súplica, ni devoción. Es la palabra dicha al borde del enfrentamiento, convertida en eco seco, en advertencia final.<br><br>Cada verso es una prueba de supervivencia. Cada silencio, una marca de lo que intentó borrarse. Cada instante, una insistencia brutal en seguir existiendo incluso cuando todo empujaba hacia lo contrario.<br><br>Y cuando parece que todo termina, no hay redención: hay permanencia.<br><br>El resultado no es una canción que se escucha: es una experiencia que se soporta.<br><br>Un punto de ruptura donde el dolor deja de ser silencio y se convierte en respuesta.<br><br><strong>“REZA” pertenece al EP titulado “OLAS NEGRAS”, que será publicado el día 11/09/2026.</strong>',
    ],
        ],
        [
          'type'      => 'spotify',
          'title'     => 'Soledad',
          'desc'      => 'Sencillo — 2026',
          'url'       => 'https://open.spotify.com/track/REPLACE_WITH_REAL_TRACK_ID',
          'thumbnail' => 'assets/portada_soledad.png',
          'synopsis'  => 'Escrito y producido en 2026 — sustituye este texto por la sinopsis real de la pista.',
        ],
        [
          'type'      => 'tiktok',
          'title'     => 'Clip (placeholder)',
          'desc'      => 'Extracto corto',
          'url'       => 'https://www.tiktok.com/@macmusicproject/video/REPLACE_WITH_REAL_VIDEO_ID',
          'thumbnail' => 'assets/logo.jpg',
          'synopsis'  => 'Sustituye por la sinopsis real del clip.',
        ],
      ];
      ?>

      <div class="release-grid">
        <?php foreach ($releases as $release): ?>
          <?php echo render_release($release); ?>
        <?php endforeach; ?>
      </div>
    </section>

<?php include 'partials/footer.php'; ?>
  </main>

</div>

<script src="script.js"></script>
</body>
</html>
