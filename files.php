<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Arquivos Múltiplos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .file-input {
            margin-bottom: 20px;
        }
        .file-list {
            list-style: none;
            padding: 0;
        }
        .file-list li {
            margin: 5px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Upload de Arquivos Múltiplos</h2>
        <form id="uploadForm">
            <div class="file-input">
                <input type="file" id="fileInput" multiple>
            </div>
            <ul id="fileList" class="file-list"></ul>
            <button type="submit">Upload</button>
        </form>
    </div>

    <script>
        const fileInput = document.getElementById('fileInput');
        const fileList = document.getElementById('fileList');

        fileInput.addEventListener('change', () => {
            fileList.innerHTML = '';
            for (const file of fileInput.files) {
                const li = document.createElement('li');
                li.textContent = `${file.name} (${file.size} bytes)`;
                fileList.appendChild(li);
            }
        });

        document.getElementById('uploadForm').addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = new FormData();
            for (const file of fileInput.files) {
                formData.append('files[]', file);
            }

            fetch('upload.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert('Upload bem-sucedido!');
                fileInput.value = '';
                fileList.innerHTML = '';
            })
            .catch(error => {
                console.error('Erro:', error);
                alert('Falha no upload.');
            });
        });
    </script>
</body>
</html>
