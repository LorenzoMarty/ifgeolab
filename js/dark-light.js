document.addEventListener('DOMContentLoaded', (event) => {
    // Verifica se a preferência do modo escuro está armazenada no localStorage
    const darkMode = localStorage.getItem('darkMode');

    const body = document.body;
    const h2Elements = document.querySelectorAll('h2');
    const h4Elements = document.querySelectorAll('h4'); // Adiciona h4
    const h6Elements = document.querySelectorAll('h6'); // Adiciona h6
    const spanElements = document.querySelectorAll('span'); // Adiciona span
    const questaoElements = document.querySelectorAll('.questao'); // Adiciona .questao
    const toggleButton = document.getElementById('toggleDarkMode');
    const materialboxedImages = document.querySelectorAll('.materialboxed');
    const inputElements = document.querySelectorAll('input');
    const pElements = document.querySelectorAll('p');

    // Aplica a classe de acordo com a preferência armazenada
    if (darkMode === 'enabled') {
        body.classList.add('dark');
        pElements.forEach(p => p.classList.add('dark'));
        h2Elements.forEach(h2 => h2.classList.add('dark'));
        h4Elements.forEach(h4 => h4.classList.add('dark')); // Aplica dark em h4
        h6Elements.forEach(h6 => h6.classList.add('dark')); // Aplica dark em h6
        spanElements.forEach(span => span.classList.add('dark')); // Aplica dark em span
        questaoElements.forEach(questao => questao.classList.add('dark')); // Aplica dark em .questao
        materialboxedImages.forEach(img => img.classList.add('dark'));
        inputElements.forEach(input => input.classList.add('dark'));
    } else {
        body.classList.add('light');
        pElements.forEach(p => p.classList.add('light'));
        h2Elements.forEach(h2 => h2.classList.add('light'));
        h4Elements.forEach(h4 => h4.classList.add('light')); // Aplica light em h4
        h6Elements.forEach(h6 => h6.classList.add('light')); // Aplica light em h6
        spanElements.forEach(span => span.classList.add('light')); // Aplica light em span
        questaoElements.forEach(questao => questao.classList.add('light')); // Aplica light em .questao
        materialboxedImages.forEach(img => img.classList.add('light'));
        inputElements.forEach(input => input.classList.add('light'));
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
        });
        h4Elements.forEach(h4 => {
            h4.classList.toggle('dark');
            h4.classList.toggle('light');
        });
        h6Elements.forEach(h6 => {
            h6.classList.toggle('dark');
            h6.classList.toggle('light');
        });
        spanElements.forEach(span => {
            span.classList.toggle('dark');
            span.classList.toggle('light');
        });
        questaoElements.forEach(questao => {
            questao.classList.toggle('dark');
            questao.classList.toggle('light');
        });
        pElements.forEach(p => {
            p.classList.toggle('dark');
            p.classList.toggle('light');
        });
        materialboxedImages.forEach(img => {
            img.classList.toggle('dark');
            img.classList.toggle('light');
        });
        inputElements.forEach(input => {
            input.classList.toggle('dark');
            input.classList.toggle('light');
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
        // Lógica para atualizar classes das imagens materialboxed, se necessário
    }

    // Inicializa as classes das imagens materialboxed com base no modo atual
    updateMaterialboxedImages(body.classList.contains('dark'));
});
