document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('loginForm');

    if (loginForm) {
        loginForm.addEventListener('submit', async function(e) {
            e.preventDefault(); // Impede o recarregamento da página

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            try {
                const response = await fetch('http://localhost:8000/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ email: email, password: password }),
                });

                const result = await response.json();

                if (response.ok) {
                    alert(result.message); // Exibe "Login realizado com sucesso!"
                    // Salva informações do usuário e redireciona
                    localStorage.setItem('usuario', JSON.stringify(result.usuario));
                    window.location.href = 'telaPrincipal.html'; // Redireciona para a página principal
                } else {
                    alert(result.message); // Exibe "Email ou senha inválidos."
                }

            } catch (error) {
                console.error('Erro ao tentar fazer login:', error);
                alert('Não foi possível conectar ao servidor. Tente novamente mais tarde.');
            }
        });
    }
});