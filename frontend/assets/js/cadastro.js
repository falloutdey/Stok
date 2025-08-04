document.addEventListener('DOMContentLoaded', () => {
    const registerForm = document.getElementById('registerForm');

    if (registerForm) {
        registerForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            
            const nome = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (password !== confirmPassword) {
                alert('As senhas não coincidem!');
                return;
            }

            try {
                // Esta é a parte que se conecta com o servidor
                const response = await fetch('http://localhost:8000/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        nome: nome,
                        email: email,
                        password: password
                    })
                });

                const result = await response.json();

                if (response.status === 201) { // 201 Created
                    alert(result.message); // Exibe "Usuário cadastrado com sucesso!"
                    // Redireciona para a tela de login para que o usuário possa entrar
                    window.location.href = 'telaLogin.html';
                } else {
                    // Exibe outras mensagens de erro, como "Este email já está em uso."
                    alert('Erro: ' + result.message);
                }

            } catch (error) {
                // Este é o código que gera o alerta "Erro de conexão"
                console.error('Erro ao tentar cadastrar:', error);
                alert('Erro de conexão com o servidor. Verifique o console (F12).');
            }
        });
    }
});