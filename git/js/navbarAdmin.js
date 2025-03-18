document.addEventListener("DOMContentLoaded", function () {
  const sidebar = document.getElementById("logo-sidebar");
  const toggleButton = document.querySelector("[data-drawer-toggle]");

  if (toggleButton && sidebar) {
    toggleButton.addEventListener("click", function () {
      sidebar.classList.toggle("-translate-x-full");
    });
  }

  // Fermer la navbar si l'utilisateur clique en dehors
  document.addEventListener("click", function (event) {
    if (
      !sidebar.contains(event.target) &&
      !toggleButton.contains(event.target)
    ) {
      sidebar.classList.add("-translate-x-full");
    }
  });
});
