        document
            .getElementById("registerForm")
            .addEventListener("submit", function (e) {
                e.preventDefault();
                const name = document.getElementById("name").value;
                const email = document.getElementById("email").value;
                const password = document.getElementById("password").value;
                const confirmPassword = document.getElementById("confirmPassword").value;

                console.log("Register attempt:", {
                    name,
                    email,
                    password,
                    confirmPassword,
                });

                // Aqui você pode adicionar a lógica de cadastro
                // window.location.href = '/dashboard'; // Redirecionamento após cadastro
            });