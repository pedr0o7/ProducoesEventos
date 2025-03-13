// Validação de formulários
document.addEventListener('DOMContentLoaded', () => {
    // Tooltips
    const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    [...tooltips].forEach(t => new bootstrap.Tooltip(t));
    
    // Validação de datas
    const dateInputs = document.querySelectorAll('input[type="datetime-local"]');
    dateInputs.forEach(input => {
        input.addEventListener('change', () => {
            if (input.min && input.value < input.min) {
                input.setCustomValidity('Data inválida');
            }
        });
    });
});