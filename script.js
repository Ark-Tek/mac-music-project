// MAC MUSIC PROJECT — shared behaviour

const COOKIE_CONSENT_KEY = "mmp_cookie_consent";

function getCookieConsent() {
  try {
    const raw = localStorage.getItem(COOKIE_CONSENT_KEY);
    return raw ? JSON.parse(raw) : null;
  } catch (e) {
    return null;
  }
}

function setCookieConsent(thirdparty) {
  const value = { necessary: true, thirdparty: !!thirdparty, ts: Date.now() };
  try {
    localStorage.setItem(COOKIE_CONSENT_KEY, JSON.stringify(value));
  } catch (e) {}
  return value;
}

function hasThirdPartyConsent() {
  const c = getCookieConsent();
  return !!(c && c.thirdparty);
}

document.addEventListener("DOMContentLoaded", () => {
  // Highlight current page in subnav
  const current = document.body.getAttribute("data-page");
  if (current) {
    document.querySelectorAll(`.subnav-links a[data-page="${current}"]`)
      .forEach((el) => el.setAttribute("aria-current", "page"));
  }

  // Stagger homepage track-list buttons
  document.querySelectorAll(".nav-btn").forEach((el, i) => {
    el.style.setProperty("--stagger", `${120 + i * 90}ms`);
  });

  // --- Cookie banner / preferences panel wiring ---
  const banner = document.getElementById("cookie-banner");
  const config = document.getElementById("cookie-config");

  if (banner && config) {
    const acceptAllBtn = document.getElementById("cookie-accept-all");
    const rejectAllBtn = document.getElementById("cookie-reject-all");
    const openConfigBtn = document.getElementById("cookie-open-config");
    const configThirdparty = document.getElementById("cookie-cat-thirdparty");
    const configSaveBtn = document.getElementById("cookie-config-save");
    const configRejectBtn = document.getElementById("cookie-config-reject");

    const hideBanner = () => { banner.hidden = true; };
    const showBanner = () => { banner.hidden = false; };
    const hideConfig = () => { config.hidden = true; };
    const showConfig = () => {
      const current = getCookieConsent();
      configThirdparty.checked = !!(current && current.thirdparty);
      config.hidden = false;
    };

    if (!getCookieConsent()) showBanner();

    acceptAllBtn?.addEventListener("click", () => { setCookieConsent(true); hideBanner(); });
    rejectAllBtn?.addEventListener("click", () => { setCookieConsent(false); hideBanner(); });
    openConfigBtn?.addEventListener("click", () => { hideBanner(); showConfig(); });
    configSaveBtn?.addEventListener("click", () => { setCookieConsent(configThirdparty.checked); hideConfig(); });
    configRejectBtn?.addEventListener("click", () => { setCookieConsent(false); hideConfig(); });

    document.querySelectorAll(".manage-cookies-link").forEach((link) => {
      link.addEventListener("click", (e) => { e.preventDefault(); showConfig(); });
    });
  }

  // --- Release cards: consent-gated click-to-play + SYNOPSIS REVEAL ---
  document.querySelectorAll(".release-card").forEach((card) => {
    const thumb = card.querySelector(".release-thumb");
    const synopsisWrapper = card.querySelector(".release-synopsis-wrapper");
    if (!thumb) return;

    function revealSynopsis() {
      if (!synopsisWrapper) return;
      synopsisWrapper.removeAttribute("hidden");
      synopsisWrapper.style.opacity = "0";
      synopsisWrapper.style.transition = "opacity 0.5s ease";
      requestAnimationFrame(() => { synopsisWrapper.style.opacity = "1"; });
    }

    // "Próximamente" cards (Futuros Lanzamientos) and "news" cards
    // (Noticias): no third-party content, no cookies involved —
    // just reveal the synopsis (and, for news, the source link) in place.
    if (card.dataset.type === "upcoming" || card.dataset.type === "news") {
      thumb.addEventListener("click", () => {
        revealSynopsis();
        card.setAttribute("data-playing", "true");
      }, { once: true });
      return;
    }

    // Everything else (Lanzamientos): consent-gated embed playback.
    const body = card.querySelector(".release-card-body");
    const template = card.querySelector(".release-embed-tpl");
    if (!body || !template) return;

    function playEmbed() {
      body.innerHTML = template.innerHTML;
      thumb.remove();
      revealSynopsis();
      card.setAttribute("data-playing", "true");

      if (card.dataset.type === "tiktok") {
        const s = document.createElement("script");
        s.src = "https://www.tiktok.com/embed.js";
        s.async = true;
        document.body.appendChild(s);
      }
    }

    thumb.addEventListener("click", (e) => {
      if (hasThirdPartyConsent()) {
        playEmbed();
        return;
      }

      e.preventDefault();
      const prompt = document.createElement("div");
      prompt.className = "release-consent-prompt";
      prompt.innerHTML = 'Este contenido carga cookies de terceros. <button type="button">Aceptar y reproducir</button>';
      thumb.replaceWith(prompt);
      prompt.querySelector("button").addEventListener("click", () => {
        setCookieConsent(true);
        prompt.remove();
        playEmbed();
      });
    }, { once: true });
  });
});
