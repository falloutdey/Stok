// Funções de validação compartilhadas
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(String(email).toLowerCase());
}

function validatePassword(password) {
    return password.length >= 8;
}

// Simulação de autenticação (substituir por chamadas reais à API)
const authService = {
    login: async (email, password) => {
        // Simulação de chamada à API
        return new Promise((resolve) => {
            setTimeout(() => {
                if (email === 'admin@example.com' && password === '12345678') {
                    resolve({ success: true });
                } else {
                    resolve({ success: false, message: 'Credenciais inválidas' });
                }
            }, 1000);
        });
    },

    register: async (userData) => {
        // Simulação de chamada à API
        return new Promise((resolve) => {
            setTimeout(() => {
                if (userData.password === userData.confirmPassword) {
                    resolve({ success: true });
                } else {
                    resolve({ success: false, message: 'As senhas não coincidem' });
                }
            }, 1000);
        });
    }
};