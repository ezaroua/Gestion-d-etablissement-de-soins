document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('clearButton').addEventListener('click', function() {
        document.getElementById('patientForm').reset();
    });
});

    // Pour rendre les lignes cliquables
    const rows = document.querySelectorAll('.clickable-row');
    rows.forEach(row => {
        row.addEventListener('click', function() {
            const patientId = this.getAttribute('data-id');
            window.location.href = `src/views/patient_detail.php?id=${patientId}`;
        });
    });
