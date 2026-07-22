<?php
/**
 * Embed helpers — convert a normal share link into the official,
 * platform-hosted embed markup. No media file ever touches our
 * own server; everything streams from Spotify/YouTube/TikTok.
 */

function extract_youtube_id(string $url): string {
    if (preg_match('/(?:v=|youtu\.be\/)([A-Za-z0-9_-]{6,})/', $url, $m)) {
        return $m[1];
    }
    return '';
}

function extract_tiktok_id(string $url): string {
    if (preg_match('/video\/(\d+)/', $url, $m)) {
        return $m[1];
    }
    return '';
}

function spotify_embed_iframe(string $shareUrl): string {
    $clean = preg_replace('/\?.*$/', '', $shareUrl);
    $embedUrl = str_replace('open.spotify.com/', 'open.spotify.com/embed/', $clean);

    return '<iframe class="release-embed release-embed--spotify" '
         . 'src="' . htmlspecialchars($embedUrl, ENT_QUOTES) . '" '
         . 'width="100%" height="152" frameborder="0" '
         . 'allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" '
         . 'loading="lazy"></iframe>';
}

function youtube_embed_iframe(string $shareUrl): string {
    $videoId = extract_youtube_id($shareUrl);
    $src = 'https://www.youtube-nocookie.com/embed/' . htmlspecialchars($videoId, ENT_QUOTES) . '?autoplay=1';

    return '<div class="release-embed-wrap">'
         . '<iframe class="release-embed release-embed--youtube" '
         . 'src="' . $src . '" '
         . 'frameborder="0" '
         . 'allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" '
         . 'allowfullscreen loading="lazy"></iframe>'
         . '</div>';
}

function tiktok_embed_blockquote(string $shareUrl): string {
    $videoId = extract_tiktok_id($shareUrl);
    $safeUrl = htmlspecialchars($shareUrl, ENT_QUOTES);

    return '<blockquote class="tiktok-embed" cite="' . $safeUrl . '" '
         . 'data-video-id="' . htmlspecialchars($videoId, ENT_QUOTES) . '" '
         . 'style="max-width: 325px; min-width: 260px;">'
         . '<section></section></blockquote>';
}

function default_thumbnail(array $item): string {
    if (!empty($item['thumbnail'])) {
        return $item['thumbnail'];
    }
    if (($item['type'] ?? '') === 'youtube') {
        $id = extract_youtube_id($item['url'] ?? '');
        if ($id !== '') {
            return 'https://img.youtube.com/vi/' . $id . '/hqdefault.jpg';
        }
    }
    return 'assets/logo.jpg';
}

function build_synopsis_html($synopsis): string {
    $synopsis_html = '';
    if (is_array($synopsis)) {
        $s_title    = htmlspecialchars($synopsis['title'] ?? '');
        $s_subtitle = htmlspecialchars($synopsis['subtitle'] ?? '');
        $s_body     = $synopsis['body'] ?? ''; // Body contains intentional HTML

        $synopsis_html .= '<div class="release-synopsis-structured">';
        if ($s_title !== '')    $synopsis_html .= '<h3 class="synopsis-title">' . $s_title . '</h3>';
        if ($s_subtitle !== '') $synopsis_html .= '<p class="synopsis-subtitle">' . $s_subtitle . '</p>';
        if ($s_body !== '')     $synopsis_html .= '<div class="synopsis-body">' . $s_body . '</div>';
        $synopsis_html .= '</div>';
    } elseif (is_string($synopsis) && $synopsis !== '') {
        $synopsis_html = '<p class="release-synopsis">' . htmlspecialchars($synopsis) . '</p>';
    }
    return $synopsis_html;
}

function render_release(array $item): string {
    $title     = htmlspecialchars($item['title'] ?? '', ENT_QUOTES);
    $desc      = htmlspecialchars($item['desc'] ?? '', ENT_QUOTES);
    $type      = $item['type'] ?? '';
    $url       = $item['url'] ?? '';
    $thumbnail = htmlspecialchars(default_thumbnail($item), ENT_QUOTES);
    $synopsis_html = build_synopsis_html($item['synopsis'] ?? '');

    switch ($type) {
        case 'spotify':
            $embed = spotify_embed_iframe($url);
            $badge = 'Spotify';
            break;
        case 'youtube':
            $embed = youtube_embed_iframe($url);
            $badge = 'YouTube';
            break;
        case 'tiktok':
            $embed = tiktok_embed_blockquote($url);
            $badge = 'TikTok';
            break;
        default:
            return '';
    }

    $html  = '<div class="release-card" data-type="' . htmlspecialchars($type, ENT_QUOTES) . '">';

    $html .= '<button class="release-thumb" type="button" aria-label="Reproducir ' . $title . '">';
    $html .= '<img src="' . $thumbnail . '" alt="Portada de ' . $title . '" loading="lazy">';
    $html .= '<span class="release-thumb-play" aria-hidden="true">&#9658;</span>';
    $html .= '</button>';

    $html .= '<div class="release-card-head">';
    $html .= '<span class="release-badge">' . $badge . '</span>';
    $html .= '<span class="release-card-title">' . $title . '</span>';
    if ($desc !== '') {
        $html .= '<span class="release-card-desc">' . $desc . '</span>';
    }
    $html .= '</div>';

    $html .= '<div class="release-card-body"></div>';

    if ($synopsis_html !== '') {
        $html .= '<div class="release-synopsis-wrapper" hidden>' . $synopsis_html . '</div>';
    }

    $html .= '<template class="release-embed-tpl">' . $embed . '</template>';

    $html .= '</div>';

    return $html;
}

function render_upcoming(array $item): string {
    $title     = htmlspecialchars($item['title'] ?? '', ENT_QUOTES);
    $desc      = htmlspecialchars($item['desc'] ?? '', ENT_QUOTES);
    $thumbnail = htmlspecialchars(!empty($item['thumbnail']) ? $item['thumbnail'] : 'assets/logo.jpg', ENT_QUOTES);
    $synopsis_html = build_synopsis_html($item['synopsis'] ?? '');

    $html  = '<div class="release-card" data-type="upcoming">';

    $html .= '<button class="release-thumb" type="button" aria-label="Ver información de ' . $title . '">';
    $html .= '<img src="' . $thumbnail . '" alt="Portada de ' . $title . '" loading="lazy">';
    $html .= '<span class="release-thumb-play release-thumb-info" aria-hidden="true">&#8505;</span>';
    $html .= '</button>';

    $html .= '<div class="release-card-head">';
    $html .= '<span class="release-badge release-badge--upcoming">Próximamente</span>';
    $html .= '<span class="release-card-title">' . $title . '</span>';
    if ($desc !== '') {
        $html .= '<span class="release-card-desc">' . $desc . '</span>';
    }
    $html .= '</div>';

    if ($synopsis_html !== '') {
        $html .= '<div class="release-synopsis-wrapper" hidden>' . $synopsis_html . '</div>';
    }

    $html .= '</div>';

    return $html;
}
