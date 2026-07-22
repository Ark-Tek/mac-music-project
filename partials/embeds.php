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

function render_release(array $item): string {
    $title     = htmlspecialchars($item['title'] ?? '', ENT_QUOTES);
    $desc      = htmlspecialchars($item['desc'] ?? '', ENT_QUOTES);
    $type      = $item['type'] ?? '';
    $url       = $item['url'] ?? '';
    $thumbnail = htmlspecialchars(default_thumbnail($item), ENT_QUOTES);

    // ✅ Handle structured synopsis (Array) vs old string
    $synopsis_html = '';
    if (isset($item['synopsis']) && is_array($item['synopsis'])) {
        $s_title    = htmlspecialchars($item['synopsis']['title'] ?? '');
        $s_subtitle = htmlspecialchars($item['synopsis']['subtitle'] ?? '');
        $s_body     = $item['synopsis']['body'] ?? ''; // Body contains intentional HTML
        
        $synopsis_html .= '<div class="release-synopsis-structured">';
        if ($s_title !== '')    $synopsis_html .= '<h3 class="synopsis-title">' . $s_title . '</h3>';
        if ($s_subtitle !== '') $synopsis_html .= '<p class="synopsis-subtitle">' . $s_subtitle . '</p>';
        if ($s_body !== '')     $synopsis_html .= '<div class="synopsis-body">' . $s_body . '</div>';
        $synopsis_html .= '</div>';
    } elseif (isset($item['synopsis']) && is_string($item['synopsis'])) {
        // Fallback for simple string synopses
        $synopsis_html = '<p class="release-synopsis">' . htmlspecialchars($item['synopsis']) . '</p>';
    }

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

    // ✅ Inject the formatted synopsis HTML
    if ($synopsis_html !== '') {
        $html .= '<div class="release-synopsis-wrapper" hidden>' . $synopsis_html . '</div>';
    }

    $html .= '<template class="release-embed-tpl">' . $embed . '</template>';

    $html .= '</div>';

    return $html;
}
