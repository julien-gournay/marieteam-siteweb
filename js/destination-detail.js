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

// Gestion des accordéons
document.addEventListener('DOMContentLoaded', function() {
  const accordionButtons = document.querySelectorAll('[data-accordion-target]');
  
  // Vérifie si un accordéon est déjà ouvert
  const hasOpenAccordion = Array.from(accordionButtons).some(button => 
    button.getAttribute('aria-expanded') === 'true'
  );
  
  // Si aucun accordéon n'est ouvert, ouvre le premier
  if (!hasOpenAccordion && accordionButtons.length > 0) {
    const firstButton = accordionButtons[0];
    const firstTargetId = firstButton.getAttribute('data-accordion-target');
    const firstTargetElement = document.querySelector(firstTargetId);
    firstTargetElement.classList.remove('hidden');
    firstButton.setAttribute('aria-expanded', 'true');
  }
  
  accordionButtons.forEach(button => {
    button.addEventListener('click', function() {
      const targetId = this.getAttribute('data-accordion-target');
      const targetElement = document.querySelector(targetId);
      
      // Ferme tous les autres accordéons
      accordionButtons.forEach(otherButton => {
        if (otherButton !== button) {
          const otherTargetId = otherButton.getAttribute('data-accordion-target');
          const otherTargetElement = document.querySelector(otherTargetId);
          otherTargetElement.classList.add('hidden');
          otherButton.setAttribute('aria-expanded', 'false');
        }
      });
      
      // Ouvre l'accordéon cliqué
      targetElement.classList.toggle('hidden');
      this.setAttribute('aria-expanded', targetElement.classList.contains('hidden') ? 'false' : 'true');
    });
  });
});
