function showForm() {
    document.getElementById('formContainer').style.display = 'block';
}

function cancelForm() {
    document.getElementById('registrationForm').reset();
    document.getElementById('formContainer').style.display = 'none';
}