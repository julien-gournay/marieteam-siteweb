document.addEventListener("DOMContentLoaded", function () {
  const menuIcon = document.getElementById("menuIcon");
  const closeMenu = document.getElementById("closeMenu");
  const navMenu = document.getElementById("navMenu");

  menuIcon.addEventListener("click", function () {
    navMenu.classList.toggle("active");
  });

  closeMenu.addEventListener("click", function () {
    navMenu.classList.remove("active");
  });
});
