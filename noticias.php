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

      <div class="empty-state">
        <svg class="ring-mini" viewBox="0 0 40 40" aria-hidden="true"><circle cx="20" cy="20" r="17"></circle></svg>
        <h2>Todavía no hay noticias publicadas</h2>
        <p>En cuanto haya un anuncio, aparecerá aquí primero. Mientras tanto, escríbenos si quieres estar al tanto por correo.</p>
      </div>
    </section>

<?php include 'partials/footer.php'; ?>
  </main>

</div>

<script src="script.js"></script>
</body>
</html>
