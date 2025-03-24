document.addEventListener('DOMContentLoaded', function() {
    const recap = document.querySelector('.cadre-recap');
    if (!recap) return; // Sort si pas de récap sur la page
    
    let isDragging = false;
    let startY = 0;
    let startTransform = 0;
    let currentTransform = parseInt(localStorage.getItem('recapPosition')) || 0;

    // Appliquer la position sauvegardée au chargement
    recap.style.transform = `translateY(${currentTransform}px)`;

    // Ajouter une zone de poignée
    const handle = document.createElement('div');
    handle.className = 'cadre-recap-handle';
    recap.insertBefore(handle, recap.firstChild);

    // Fonction pour mettre à jour la position
    function updatePosition(y) {
        const maxTransform = 0;
        const minTransform = -recap.offsetHeight + 60;
        currentTransform = Math.min(maxTransform, Math.max(minTransform, startTransform + (y - startY)));
        recap.style.transform = `translateY(${currentTransform}px)`;
        
        // Sauvegarder la position
        localStorage.setItem('recapPosition', currentTransform);
    }

    // Fonction pour finaliser la position
    function finalizePosition() {
        const threshold = recap.offsetHeight / 3;
        
        // Ajouter la classe pour l'animation
        recap.classList.add('animating');
        
        if (currentTransform > -threshold) {
            currentTransform = 0;
        } else {
            currentTransform = -recap.offsetHeight + 60;
        }
        
        recap.style.transform = `translateY(${currentTransform}px)`;
        recap.classList.toggle('open', currentTransform === 0);
        
        // Sauvegarder la position finale
        localStorage.setItem('recapPosition', currentTransform);
        
        // Retirer la classe d'animation après la transition
        setTimeout(() => {
            recap.classList.remove('animating');
        }, 300);
    }

    // Gestionnaires d'événements tactiles
    handle.addEventListener('touchstart', function(e) {
        isDragging = true;
        startY = e.touches[0].clientY;
        startTransform = currentTransform;
        recap.classList.add('dragging');
        e.preventDefault();
    });

    document.addEventListener('touchmove', function(e) {
        if (!isDragging) return;
        updatePosition(e.touches[0].clientY);
        e.preventDefault();
    });

    document.addEventListener('touchend', function() {
        if (!isDragging) return;
        isDragging = false;
        recap.classList.remove('dragging');
        finalizePosition();
    });

    // Gestionnaires d'événements souris
    handle.addEventListener('mousedown', function(e) {
        isDragging = true;
        startY = e.clientY;
        startTransform = currentTransform;
        recap.classList.add('dragging');
        e.preventDefault();
    });

    document.addEventListener('mousemove', function(e) {
        if (!isDragging) return;
        updatePosition(e.clientY);
        e.preventDefault();
    });

    document.addEventListener('mouseup', function() {
        if (!isDragging) return;
        isDragging = false;
        recap.classList.remove('dragging');
        finalizePosition();
    });

    // Double-clic pour ouvrir/fermer complètement
    handle.addEventListener('dblclick', function() {
        recap.classList.add('animating');
        const isOpen = recap.classList.contains('open');
        currentTransform = isOpen ? -recap.offsetHeight + 60 : 0;
        recap.style.transform = `translateY(${currentTransform}px)`;
        recap.classList.toggle('open');
        
        // Sauvegarder la position
        localStorage.setItem('recapPosition', currentTransform);
        
        setTimeout(() => {
            recap.classList.remove('animating');
        }, 300);
    });
}); 