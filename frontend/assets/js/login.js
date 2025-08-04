document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            try {
                const response = await fetch('http://localhost:8000/login', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({ email, password }),
                });
                const result = await response.json();
                if (response.ok) {
                    alert(result.message); // Exibe: Login realizado com sucesso!
                    // Opcional: redireciona para a tela principal
                    window.location.href = 'telaPrincipal.html';
                } else {
                    alert('Erro: ' + result.message); // Exibe: Email ou senha inválidos.
                }
            } catch (error) {
                alert('Erro de conexão com o servidor.');
            }
        });
    }
});