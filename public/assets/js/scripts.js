function buscarCEP() {
    const cep = document.getElementById('cep').value;
    if (cep.length !== 8) return;

    fetch(`https://viacep.com.br/ws/${cep}/json/`)
        .then(response => response.json())
        .then(data => {
            if (!data.erro) {
                document.getElementById('pais').value = 'Brasil';
                document.getElementById('logradouro').value = data.logradouro;
                document.getElementById('cidade').value = data.localidade;
                document.getElementById('estado').value = data.uf;
                document.getElementById('location_name').focus();
            }
        });
}

// Auto-fechar alertas após 5 segundos
document.addEventListener('DOMContentLoaded', function () {
    const alerts = document.querySelectorAll('.alert');

    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Toggle Sidebar
    document.querySelector('#sidebarCollapse').addEventListener('click', function () {
        document.querySelector('#sidebar').classList.toggle('active');
    });

    // Gráfico de Exemplo
    const ctx = document.getElementById('eventChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Eventos Ativos', 'Vendidos', 'Cancelados'],
                datasets: [{
                    label: 'Estatísticas',
                    data: [12, 19, 3],
                    backgroundColor: [
                        '#3498db',
                        '#2ecc71',
                        '#e74c3c'
                    ]
                }]
            }
        });
    }
});

// Força da Senha
function checkPasswordStrength(password) {
    let strength = 0;

    if (password.length >= 8) strength += 1;
    if (password.match(/[A-Z]/)) strength += 1;
    if (password.match(/[0-9]/)) strength += 1;
    if (password.match(/[^A-Za-z0-9]/)) strength += 1;

    return strength;
}

// Atualizar força da senha
document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('new_password');
    const strengthBar = document.createElement('div');
    strengthBar.className = 'password-strength';
    passwordInput.parentNode.insertBefore(strengthBar, passwordInput.nextSibling);

    passwordInput.addEventListener('input', function () {
        const strength = checkPasswordStrength(this.value);
        const colors = ['#dc3545', '#ffc107', '#28a745'];
        strengthBar.innerHTML = `<div style="width: ${strength * 25}%; 
                                background-color: ${colors[strength - 1] || colors[0]}"></div>`;
    });
});

// Script para mostrar/esconder senha
document.getElementById('togglePassword').addEventListener('click', function () {
    const passwordField = document.getElementById('new_password');
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
    this.querySelector('i').classList.toggle('bi-eye-slash');
});