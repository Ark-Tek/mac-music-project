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
});
