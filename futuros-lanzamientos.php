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
      //
      // synopsis follows the same structured format used on
      // Lanzamientos: title / subtitle / body (body accepts HTML —
      // <br>, <strong>, <em> — for formatted paragraphs).
      // ---------------------------------------------------------------
      $upcoming = [
        [
          'title'     => 'Próximo Lanzamiento - Olas Negras',
          'desc'      => '11/09/2026',
          'thumbnail' => 'assets/portada_olas_negras.png',
          'synopsis'  => [
            'title'    => 'OLAS NEGRAS',
            'subtitle' => '',
            'body'     => '“Olas Negras” es un viaje emocional a través de la fragilidad humana, la resistencia y las cicatrices invisibles que deja la vida cuando golpea con más fuerza. Entre atmósferas oscuras, mares embravecidos, noches de insomnio y silencios que pesan más que las palabras, el EP construye un universo íntimo donde el blues, el gospel, el soul y las texturas del smooth jazz se entrelazan para dar voz a emociones profundas y reales.<br><br>Cada canción representa una marea distinta del alma: la soledad convertida en refugio, el amor roto que aún respira entre las ruinas, la lucha contra quienes intentaron destruir la verdad y la necesidad de mantenerse en pie incluso cuando todo parece derrumbarse. Las letras avanzan como confesiones nocturnas, cargadas de poesía, lluvia, viento, mar y heridas emocionales que nunca terminan de cerrarse.<br><br>La portada del EP resume perfectamente esa identidad: unas olas oscuras golpeando violentamente contra las rocas bajo un cielo amenazante. Una imagen poderosa y cinematográfica que simboliza la lucha constante entre la tempestad exterior y la fortaleza interior. El blanco y negro envejecido aporta una sensación atemporal, casi de viejo vinilo perdido en el tiempo, reforzando el carácter clásico, melancólico y elegante del proyecto.<br><br>“Olas Negras” no busca la perfección artificial ni el ruido vacío. Es música hecha desde la herida, desde la dignidad y desde la necesidad de seguir respirando aun en mitad de la tormenta. Un trabajo profundamente humano donde cada canción funciona como una ola: algunas acarician, otras golpean, pero todas dejan huella.',
          ],
        ],
        [
          'title'     => 'Próximo lanzamiento - Soledad',
          'desc'      => 'Fecha por confirmar',
          'thumbnail' => 'assets/portada_soledad.png',
          'synopsis'  => [
            'title'    => 'SOLEDAD',
            'subtitle' => '',
            'body'     => '“SOLEDAD” es un crudo blues contemporáneo vestido de melancolía y verdad emocional. La canción retrata el diálogo íntimo entre un hombre y la soledad, convertida aquí no en enemiga, sino en refugio y compañera de supervivencia durante las noches más oscuras.<br><br>Entre ladridos lejanos, lluvia golpeando la ventana y silencios cargados de dolor, la obra explora el desgaste emocional, el insomnio y la lucha por no perder la identidad en medio del sufrimiento. La soledad aparece como el último abrazo cuando todo lo demás desaparece, mientras el protagonista promete resistir y conservar la esperanza de volver a levantar el vuelo.<br><br>Con una narrativa profundamente humana y una estética inspirada en el blues más desnudo y el alma espiritual del gospel, la canción forma parte de una nueva propuesta artística donde la inteligencia artificial se utiliza únicamente como herramienta de creación sonora al servicio de una visión autoral plenamente humana.<br><br>“Cuando Vivir Se Convierte en una Fatiga” no busca impresionar: busca decir la verdad.',
          ],
        ],
 /*     [
          'title'     => 'Próximo lanzamiento (placeholder)',
          'desc'      => 'Fecha por confirmar',
          'thumbnail' => 'assets/logo.jpg',
          'synopsis'  => [
            'title'    => 'TÍTULO DEL LANZAMIENTO',
            'subtitle' => 'Sustituye por una frase corta que describa la pista o el proyecto.',
            'body'     => 'Sustituye este párrafo por la sinopsis real: de qué trata la canción, qué la inspiró, o cualquier detalle que quieras adelantar antes de su publicación.<br><br>Puedes usar <strong>negrita</strong> o <em>cursiva</em> para dar énfasis, igual que en las fichas de Lanzamientos.',
          ],
        ], */
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
