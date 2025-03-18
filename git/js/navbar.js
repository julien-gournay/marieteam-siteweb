// Attendre que le DOM soit chargé
document.addEventListener("DOMContentLoaded", function () {
  const menuIcon = document.querySelector(".bx-menu");
  const closeIcon = document.querySelector(".bx-x");
  const navLinks = document.querySelector(".nav-links");

  // Ouvrir le menu
  menuIcon.addEventListener("click", () => {
    navLinks.classList.add("active");
  });

  // Fermer le menu
  closeIcon.addEventListener("click", () => {
    navLinks.classList.remove("active");
  });

  // Fermer le menu quand on clique sur un lien
  document.querySelectorAll(".nav-links a").forEach((link) => {
    link.addEventListener("click", () => {
      navLinks.classList.remove("active");
    });
  });
});
