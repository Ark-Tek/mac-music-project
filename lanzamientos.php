<?php 
// 1. Load embed functions (MUST be first)
require 'partials/embeds.php'; 

// 2. Temporary Debug: Check if function loaded
if (!function_exists('render_release')) {
    die('CRITICAL ERROR: render_release() not found. Check partials/embeds.php');
}
?>
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
            'body'     => 'Nace desde un territorio de presión insoportable...<br><br><strong>"REZA" pertenece al EP titulado "OLAS NEGRAS".</strong>',
          ],
        ],
        [
          'type'      => 'spotify',
          'title'     => 'Soledad',
          'desc'      => 'Sencillo — 2026',
          'url'       => 'https://open.spotify.com/track/REPLACE_WITH_REAL_TRACK_ID',
          'thumbnail' => 'assets/portada_soledad.png',
          'synopsis'  => 'Escrito y producido en 2026.',
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
