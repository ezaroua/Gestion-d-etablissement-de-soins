document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('clearButton').addEventListener('click', function () {
        document.getElementById('patientForm').reset();
    });
});

// Pour rendre les lignes cliquables
const rows = document.querySelectorAll('.clickable-row');
rows.forEach(row => {
    row.addEventListener('click', function () {
        const patientId = this.getAttribute('data-id');
        window.location.href = `src/views/patient_detail.php?id=${patientId}`;
    });
});

function afficherPartie(id) {
    var parties = document.querySelectorAll('.partie');
    for (var i = 0; i < parties.length; i++) {
        parties[i].classList.remove('visible');
    }
    document.getElementById(id).classList.add('visible');
}

function redirectTo(url) {
    window.location.href = url;
}