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
          'title'     => 'Titular de la noticia (placeholder)',
          'source'    => 'Nombre del medio',
          'desc'      => 'Fecha por confirmar',
          'thumbnail' => 'assets/logo.jpg',
          'url'       => '#',
          'synopsis'  => [
            'title'    => 'RESUMEN DE LA NOTICIA',
            'subtitle' => 'Sustituye por una frase corta que resuma la cobertura.',
            'body'     => 'Sustituye este párrafo por un breve extracto o resumen de la noticia real, con un enlace al artículo completo debajo.',
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
