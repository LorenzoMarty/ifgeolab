const fileInput = document.getElementById('carrossel');
const fileList = document.getElementById('fileList');
let filesArray = [];

fileInput.addEventListener('change', () => {
    for (const file of fileInput.files) {
        if (file.type.startsWith('image/')) {
            filesArray.push(file);
        }
    }
    updateFileList();
});

function updateFileList() {
    fileList.innerHTML = '';
    filesArray.forEach((file, index) => {
        const li = document.createElement('li');
        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        img.onload = () => URL.revokeObjectURL(img.src);

        const info = document.createElement('span');
        info.textContent = file.name;

        const removeButton = document.createElement('button');
        removeButton.textContent = 'Remove';
        removeButton.addEventListener('click', () => {
            filesArray.splice(index, 1);
            updateFileList();
        });

        li.appendChild(img);
        li.appendChild(info);
        li.appendChild(removeButton);
        fileList.appendChild(li);
    });
}

/* document.getElementById('cadMineral').addEventListener('submit', (e) => {
    e.preventDefault();
    let f = document.getElementById('cadMineral');
    const formData = new FormData(f);
    const fileInput = document.getElementById('carrossel');
    const filesArray = fileInput.files;
    for (let i = 0; i < filesArray.length; i++) {
        formData.append('carrossel[]', filesArray[i]);
    }
    
    fetch('cadastrar.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert('Upload bem-sucedido!');
        fileInput.value = '';  
    })
    .catch(error => {
        console.error('Erro:', error);
        alert('Falha no upload.');
    });
}); */