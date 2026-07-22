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
          'title'     => 'Reza',
          'desc'      => 'Sencillo — 2026',
          'url'       => 'https://open.spotify.com/track/REPLACE_WITH_REAL_TRACK_ID',
          'thumbnail' => 'assets/portada_reza.png',
          'synopsis' => [
    'title'    => 'LA PICARONA',
    'subtitle' => 'Una explosiva adaptación en salsa de la legendaria "La Fuente de Cacho"',
    'body'     => 'Desde el corazón de Santander (Cantabria, España) nace la inspiración de La Picarona. Una obra que conserva el alma de la tradición, pero la envuelve en un ritmo ardiente, sensual y contagioso, capaz de conquistar cualquier pista de baile del mundo.<br><br>Entre miradas que encienden la noche, sonrisas provocadoras y secretos que solo la madrugada conoce, la historia juega con el deseo, la seducción y la picardía. La protagonista despierta la imaginación de todos a su paso, mientras una pregunta resuena entre los acordes salseros: ¿quién será la picarona que entretiene a ese hombre hasta las dos de la mañana?<br><br>Con elegancia, doble sentido y un inconfundible sabor latino, La Picarona transforma una melodía que ha acompañado durante generaciones al pueblo cántabro en un himno moderno al baile, la pasión y la alegría de vivir.<br><br><strong>Esta versión nace con un propósito claro: llevar el nombre de Santander, de Cantabria y de la histórica Fuente de Cacho mucho más allá de sus fronteras. Porque las grandes canciones no entienden de fronteras: se sienten, se cantan... y, sobre todo, se bailan.</strong>',
    ],
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
