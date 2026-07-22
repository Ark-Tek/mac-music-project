<?php require 'partials/embeds.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Futuros Lanzamientos — Mac Music Project</title>
<?php include 'partials/head-assets.php'; ?>
</head>
<body data-page="futuros-lanzamientos">
<?php include 'partials/cookie-banner.php'; ?>
<div class="layout">

<?php include 'partials/brand-panel.php'; ?>

  <main class="content-panel">

<?php include 'partials/subnav.php'; ?>

    <section class="page-body">
      <p class="eyebrow">Próximos</p>
      <h1>Futuros Lanzamientos</h1>
      <p class="lede">Lo que viene: haz clic en la portada para ver de qué trata cada lanzamiento antes de su publicación. Aquí no se reproduce nada — solo información.</p>

      <?php
      // ---------------------------------------------------------------
      // To add or update an upcoming release, edit this list.
      // No 'type' or 'url' needed — nothing plays here, only the
      // thumbnail + synopsis reveal on click. 'thumbnail' is required
      // since there's no share link to auto-derive one from.
      // synopsis can be a plain string or the richer
      // ['title' => ..., 'subtitle' => ..., 'body' => ...] format.
      // ---------------------------------------------------------------
      $upcoming = [
        [
          'title'     => 'Próximo lanzamiento (placeholder)',
          'desc'      => 'Fecha por confirmar',
          'thumbnail' => 'assets/logo.jpg',
          'synopsis'  => 'Sustituye este texto por la sinopsis real de este próximo lanzamiento.',
        ],
      ];
      ?>

      <div class="release-grid">
        <?php foreach ($upcoming as $item): ?>
          <?php echo render_upcoming($item); ?>
        <?php endforeach; ?>
      </div>
    </section>

<?php include 'partials/footer.php'; ?>
  </main>

</div>

<script src="script.js"></script>
</body>
</html>
