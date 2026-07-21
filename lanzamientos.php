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
          'title'     => 'Olas Negras',
          'desc'      => 'Sencillo — 2026',
          'url'       => 'https://open.spotify.com/track/REPLACE_WITH_REAL_TRACK_ID',
          'thumbnail' => 'assets/portada_olas_negras.png',
          'synopsis'  => 'Escrito y producido en 2026 — sustituye este texto por la sinopsis real de la pista.',
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
