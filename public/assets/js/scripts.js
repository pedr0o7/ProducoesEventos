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
document.addEventListener('DOMContentLoaded', () => {
    // Carrinho de compras
    const cart = {
        items: JSON.parse(localStorage.getItem('cart')) || [],
        updateCount() {
            document.getElementById('cart-count').textContent = this.items.length;
        },
        addItem(event) {
            this.items.push(event);
            localStorage.setItem('cart', JSON.stringify(this.items));
            this.updateCount();
        }
    };

    cart.updateCount();

    // Eventos de compra
    document.querySelectorAll('.buy-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const event = {
                id: btn.dataset.eventId,
                name: btn.dataset.eventName,
                price: btn.dataset.eventPrice
            };
            cart.addItem(event);
        });
    });

    // Validação de formulário
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', e => {
            if (!form.checkValidity()) {
                e.preventDefault();
                form.classList.add('was-validated');
            }
        });
    });
});