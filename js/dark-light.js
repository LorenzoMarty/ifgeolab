document.addEventListener('DOMContentLoaded', (event) => {
    // Verifica se a preferência do modo escuro está armazenada no localStorage
    const darkMode = localStorage.getItem('darkMode');

    const body = document.body;
    const h2Elements = document.querySelectorAll('h2');
    const toggleButton = document.getElementById('toggleDarkMode');
    const materialboxedImages = document.querySelectorAll('.materialboxed');

    // Aplica a classe de acordo com a preferência armazenada
    if (darkMode === 'enabled') {
        body.classList.add('dark');
        h2Elements.forEach(h2 => h2.classList.add('dark'));
        materialboxedImages.forEach(img => img.classList.add('dark'));
    } else {
        body.classList.add('light');
        h2Elements.forEach(h2 => h2.classList.add('light'));
        materialboxedImages.forEach(img => img.classList.add('light'));
    }

    // Atualiza o texto do botão inicialmente
    updateButtonText();

    // Alterna entre modo claro e escuro ao clicar no botão
    toggleButton.addEventListener('click', () => {
        body.classList.toggle('dark');
        body.classList.toggle('light');
        h2Elements.forEach(h2 => {
            h2.classList.toggle('dark');
            h2.classList.toggle('light');
        })
        materialboxedImages.forEach(img => {
            img.classList.toggle('dark');
            img.classList.toggle('light');
        });

        // Atualiza o localStorage de acordo com a classe atual
        if (body.classList.contains('dark')) {
            localStorage.setItem('darkMode', 'enabled');
        } else {
            localStorage.setItem('darkMode', 'disabled');
        }

        // Atualiza o texto do botão
        updateButtonText();

        // Atualiza as classes das imagens materialboxed
        updateMaterialboxedImages(body.classList.contains('dark'));
    });

    // Atualiza o texto do botão com base no modo atual
    function updateButtonText() {
        if (body.classList.contains('dark')) {
            toggleButton.textContent = 'Escuro';
        } else {
            toggleButton.textContent = 'Claro';
        }
    }

    // Função para atualizar classes das imagens materialboxed
    function updateMaterialboxedImages(isDarkMode) {
        
    }

    // Inicializa as classes das imagens materialboxed com base no modo atual
    updateMaterialboxedImages(body.classList.contains('dark'));
});
