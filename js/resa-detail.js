function confirmerSuppression() {
  document.getElementById("overlay").style.display = "block"; // Montrer l'overlay
  document.getElementById("confirmationDiv").style.display = "block"; // Montrer la popup
  return false; // Empêche le rechargement de la page
}

function fermerConfirmation() {
  document.getElementById("overlay").style.display = "none"; // Cacher l'overlay
  document.getElementById("confirmationDiv").style.display = "none"; // Cacher la popup
}
