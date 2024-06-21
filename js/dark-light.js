document.addEventListener('DOMContentLoaded', (event) => {
    // Verifica se a preferência do modo escuro está armazenada no localStorage
    const darkMode = localStorage.getItem('darkMode');

    const body = document.body;
    const toggleButton = document.getElementById('toggleDarkMode');

    // Se a preferência for modo escuro, aplica a classe 'dark'
    if (darkMode === 'enabled') {
        body.classList.add('dark');
    } else {
        body.classList.add('light');
    }

    // Atualiza o texto do botão inicialmente
    updateButtonText();

    // Alterna entre modo claro e escuro ao clicar no botão
    toggleButton.addEventListener('click', () => {
        body.classList.toggle('dark');
        body.classList.toggle('light');

        // Atualiza o localStorage de acordo com a classe atual
        if (body.classList.contains('dark')) {
            localStorage.setItem('darkMode', 'enabled');
        } else {
            localStorage.setItem('darkMode', 'disabled');
        }

        // Atualiza o texto do botão
        updateButtonText();
    });

    // Atualiza o texto do botão com base no modo atual
    function updateButtonText() {
        if (body.classList.contains('dark')) {
            toggleButton.textContent = 'Escuro';
        } else {
            toggleButton.textContent = 'Claro';
        }
    }
});