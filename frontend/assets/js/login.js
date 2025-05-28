document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault(); // impede reload da página
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            console.log('Login attempt:', { email, password }); // só exibe no console por enquanto
        });