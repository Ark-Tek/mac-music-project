// MAC MUSIC PROJECT — shared behaviour

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

  // Release cards: clicking the thumbnail lazy-loads the real embed
  // and reveals the synopsis text underneath it.
  document.querySelectorAll(".release-card").forEach((card) => {
    const thumb = card.querySelector(".release-thumb");
    const body = card.querySelector(".release-card-body");
    const template = card.querySelector(".release-embed-tpl");
    const synopsis = card.querySelector(".release-synopsis");
    if (!thumb || !body || !template) return;

    thumb.addEventListener("click", () => {
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
    }, { once: true });
  });
});
