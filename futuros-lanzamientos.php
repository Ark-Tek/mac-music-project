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
      <p class="lede">Lo que viene: haz clic en la portada para ver de qué trata cada lanzamiento antes de su publicación, o reproduce un adelanto en vídeo cuando esté disponible.</p>

      <?php
      // ---------------------------------------------------------------
      // To add or update an upcoming release, edit this list.
      //
      // Info-only card (no 'video' key): thumbnail + synopsis reveal
      // on click, nothing plays.
      //
      // Video card (add a 'video' key with the path to an .mp4 file):
      // thumbnail + native video player on click. Self-hosted, no
      // third party involved, so no cookie consent is needed.
      //
      // synopsis follows the same structured format used on
      // Lanzamientos: title / subtitle / body (body accepts HTML —
      // <br>, <strong>, <em> — for formatted paragraphs).
      // ---------------------------------------------------------------
      $upcoming = [
        [
          'title'     => 'Próximo lanzamiento (placeholder)',
          'desc'      => 'Fecha por confirmar',
          'thumbnail' => 'assets/logo.jpg',
          'synopsis'  => [
            'title'    => 'TÍTULO DEL LANZAMIENTO',
            'subtitle' => 'Sustituye por una frase corta que describa la pista o el proyecto.',
            'body'     => 'Sustituye este párrafo por la sinopsis real: de qué trata la canción, qué la inspiró, o cualquier detalle que quieras adelantar antes de su publicación.<br><br>Puedes usar <strong>negrita</strong> o <em>cursiva</em> para dar énfasis, igual que en las fichas de Lanzamientos.',
          ],
        ],
        [
          'title'     => 'Adelanto en vídeo 1 (placeholder)',
          'desc'      => 'Fecha por confirmar',
          'thumbnail' => 'assets/logo.jpg',
          'video'     => 'assets/Preview1.mp4',
          'synopsis'  => [
            'title'    => 'ADELANTO EN VÍDEO 1',
            'subtitle' => 'Sustituye por una frase corta que describa este adelanto.',
            'body'     => 'Sustituye este párrafo por la sinopsis real del vídeo. Sube tu archivo .mp4 a la carpeta assets/ y actualiza la ruta en el campo \'video\' de este elemento.',
          ],
        ],
        [
          'title'     => 'Adelanto en vídeo 2 (placeholder)',
          'desc'      => 'Fecha por confirmar',
          'thumbnail' => 'assets/logo.jpg',
          'video'     => 'assets/Preview2.mp4',
          'synopsis'  => [
            'title'    => 'ADELANTO EN VÍDEO 2',
            'subtitle' => 'Sustituye por una frase corta que describa este segundo adelanto.',
            'body'     => 'Sustituye este párrafo por la sinopsis real de este segundo vídeo.',
          ],
        ],
      ];
      ?>

      <div class="release-grid">
        <?php foreach ($upcoming as $item): ?>
          <?php echo !empty($item['video']) ? render_upcoming_video($item) : render_upcoming($item); ?>
        <?php endforeach; ?>
      </div>
    </section>

<?php include 'partials/footer.php'; ?>
  </main>

</div>

<script src="script.js"></script>
</body>
</html>
