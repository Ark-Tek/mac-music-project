function render_release(array $item): string {
    $title     = htmlspecialchars($item['title'] ?? '', ENT_QUOTES);
    $desc      = htmlspecialchars($item['desc'] ?? '', ENT_QUOTES);
    $type      = $item['type'] ?? '';
    $url       = $item['url'] ?? '';
    $thumbnail = htmlspecialchars(default_thumbnail($item), ENT_QUOTES);

    // ✅ NEW: Handle structured synopsis (Array) vs old string
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
