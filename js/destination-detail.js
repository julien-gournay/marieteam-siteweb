const image = document.querySelector(".cadre-img");

// Ajoute un écouteur pour détecter le défilement
window.addEventListener("scroll", () => {
  // Calcule la progression du défilement (0 en haut, 1 en bas)
  const scrollPosition =
    window.scrollY / (document.body.scrollHeight - window.innerHeight);

  // Applique un effet de zoom progressif (1 à 1.3, par exemple)
  const scale = 1 + scrollPosition * 0.8;

  // Modifie l'échelle de l'image
  image.style.transform = `scale(${scale})`;
});
