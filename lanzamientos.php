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
      // ✅ SAFE DECLARATION: Only defines the function if it doesn't exist yet
      if (!function_exists('render_release')) {
        function render_release($release) {
          $synopsis_title = '';
          $synopsis_subtitle = '';
          $synopsis_body = '';

          // Handle structured synopsis (Array)
          if (isset($release['synopsis']) && is_array($release['synopsis'])) {
            $synopsis_title    = '<h3 class="synopsis-title">' . htmlspecialchars($release['synopsis']['title']) . '</h3>';
            $synopsis_subtitle = '<p class="synopsis-subtitle">' . htmlspecialchars($release['synopsis']['subtitle']) . '</p>';
            $synopsis_body     = '<div class="synopsis-body">' . $release['synopsis']['body'] . '</div>';
          } 
          // Handle simple synopsis (String)
          elseif (isset($release['synopsis']) && is_string($release['synopsis'])) {
            $synopsis_body = '<div class="synopsis-body">' . htmlspecialchars($release['synopsis']) . '</div>';
          }

          return '
            <article class="release-card">
              <a href="' . htmlspecialchars($release['url']) . '" target="_blank" rel="noopener">
                <img src="' . htmlspecialchars($release['thumbnail']) . '" alt="' . htmlspecialchars($release['title']) . '">
              </a>
              <h2>' . htmlspecialchars($release['title']) . '</h2>
              <p class="desc">' . htmlspecialchars($release['desc']) . '</p>
              <div class="synopsis-container">
                ' . $synopsis_title . '
                ' . $synopsis_subtitle . '
                ' . $synopsis_body . '
              </div>
            </article>
          ';
        }
      }

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
        // ... rest of your releases
      ];
      ?>

      <!-- DEBUG: Remove this line once it works -->
      <?php if(empty($releases)) echo '<p style="color:red">ERROR: Releases array is empty!</p>'; ?>

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
