document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('clearButton').addEventListener('click', function() {
        document.getElementById('patientForm').reset();
    });
});
