// MAC MUSIC PROJECT — shared behaviour

// ---------------------------------------------------------------
// Cookie consent — AEPD-compliant: equal-weight accept/reject,
// no pre-ticked boxes, third-party embeds blocked until consented.
// ---------------------------------------------------------------

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
  } catch (e) {
    /* localStorage unavailable — consent just won't persist across visits */
  }
  return value;
}

function hasThirdPartyConsent() {
  const c = getCookieConsent();
  return !!(c && c.thirdparty);
}

document.addEventListener("DOMContentLoaded", () => {
  // Highlight the current page in any subnav
  const current = document.body.getAttribute("data-page");
  if (current) {
    document.querySelectorAll(`.subnav-links a[data-page="${current}"]`)
      .forEach((el) => el.setAttribute("aria-current", "page"));
  }

  // Stagger the homepage track-list buttons
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

    if (!getCookieConsent()) {
      showBanner();
    }

    acceptAllBtn && acceptAllBtn.addEventListener("click", () => {
      setCookieConsent(true);
      hideBanner();
    });

    rejectAllBtn && rejectAllBtn.addEventListener("click", () => {
      setCookieConsent(false);
      hideBanner();
    });

    openConfigBtn && openConfigBtn.addEventListener("click", () => {
      hideBanner();
      showConfig();
    });

    configSaveBtn && configSaveBtn.addEventListener("click", () => {
      setCookieConsent(configThirdparty.checked);
      hideConfig();
    });

    configRejectBtn && configRejectBtn.addEventListener("click", () => {
      setCookieConsent(false);
      hideConfig();
    });

    // Footer "Configurar cookies" link — withdraw/change consent
    // at any time, as easily as it was given.
    document.querySelectorAll(".manage-cookies-link").forEach((link) => {
      link.addEventListener("click", (e) => {
        e.preventDefault();
        showConfig();
      });
    });
  }

  // --- Release cards: consent-gated click-to-play ---
  // Third-party embeds (Spotify/YouTube/TikTok) only load once
  // thirdparty consent has been granted; otherwise clicking shows
  // an inline consent prompt instead of loading anything.
  document.querySelectorAll(".release-card").forEach((card) => {
    const thumb = card.querySelector(".release-thumb");
    const body = card.querySelector(".release-card-body");
    const template = card.querySelector(".release-embed-tpl");
    const synopsis = card.querySelector(".release-synopsis");
    if (!thumb || !body || !template) return;

    function playEmbed() {
      body.innerHTML = template.innerHTML;
      thumb.remove();
      if (synopsis) synopsis.hidden = false;
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
      prompt.innerHTML =
        'Este contenido carga cookies de terceros. <button type="button">Aceptar y reproducir</button>';
      thumb.replaceWith(prompt);
      prompt.querySelector("button").addEventListener("click", () => {
        setCookieConsent(true);
        prompt.remove();
        playEmbed();
      });
    }, { once: true });
  });
});
