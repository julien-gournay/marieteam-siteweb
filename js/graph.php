<script>
// 🚨 Graphique 1 : Ligne (incidents categories)
const ctx1 = document.getElementById('incidentChart').getContext('2d');
const incidentChart = new Chart(ctx1, {
    type: 'doughnut',
    data: {
        labels: <?php echo json_encode($labelsIncidents); ?>,
datasets: [{
    label: 'Nombre d’incidents',
    data: <?php echo json_encode($dataIncidents); ?>,
backgroundColor: [
    '#f87171', '#fb923c', '#facc15', '#34d399', '#60a5fa', '#a78bfa'
],
    borderWidth: 1
}]
},
options: {
    responsive: true,
        plugins: {
        legend: {
            display : false
        }
    }
}
});

// 🎯 Graphique 2 : Ligne (traversées de la semaine)
const ctx2 = document.getElementById('weeklyLineChart').getContext('2d');
const weeklyLineChart = new Chart(ctx2, {
    type: 'line',
    data: {
        labels: ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'], // Labels de la semaine
        datasets: [{
            label: 'Nombre de traversées',
            data: <?php echo json_encode($dataSemaine); ?>,
borderColor: 'rgb(238,81,81)',
    backgroundColor: 'rgb(238,81,81,0.2)',
    tension: 0.3,
    fill: true,
    pointRadius: 5,
    pointHoverRadius: 7
}]
},
options: {
    responsive: true,

        plugins: {
        legend: {
            display: false
        },
    }
}
});

// 🌍 Graphique 3 : Ligne (top destinations)
const ctx3 = document.getElementById('topDestChart').getContext('2d');
const topDestChart =new Chart(ctx3, {
    type: 'bar',
    data: {
        labels: <?= json_encode($labelsDest) ?>,
datasets: [{
    label: 'Réservations',
    data: <?= json_encode($dataDest) ?>,
backgroundColor: [
    'rgba(75, 192, 192, 0.6)',
    'rgba(255, 159, 64, 0.6)',
    'rgba(255, 99, 132, 0.6)',
    'rgba(54, 162, 235, 0.6)',
    'rgba(153, 102, 255, 0.6)'
],
    borderColor: 'rgba(0, 0, 0, 0.1)',
    borderWidth: 1
}]
},
options: {
    responsive: true,
        plugins: {
        legend: {
            display: false
        },
    },
    scales: {
        y: {
            beginAtZero: true,
                ticks: {
                stepSize: 1
            }
        }
    }
}
});

// 🧁 Graphique 4 : Camembert (passagers par type)
const ctx4 = document.getElementById('passengerPieChart').getContext('2d');
const passengerPieChart = new Chart(ctx4, {
    type: 'pie',
    data: {
        labels: <?php echo json_encode($labelsType); ?>,
datasets: [{
    label: 'Nombre de passagers',
    data: <?php echo json_encode($dataPassagers); ?>,
backgroundColor: ['#3b82f6', '#10b981', '#f59e0b'],
    borderColor: '#ffffff',
    borderWidth: 2
}]
},
options: {
    responsive: true,
        plugins: {
        legend: {
            display : false
        },
        tooltip: {
            callbacks: {
                label: function(context) {
                    const label = context.label || '';
                    const value = context.raw || 0;
                    return `${label}: ${value} passagers`;
                }
            }
        }
    }
}
});
</script>