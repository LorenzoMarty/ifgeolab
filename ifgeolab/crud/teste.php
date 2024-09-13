<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MultiFile Test</title>
</head>

<body>
    <div class="MultiFile-wrap">
        <input type="file" multiple="multiple" id="upload_files" name="multifile-test[]">
        <ul id="F9-Log"></ul>
    </div>

    <script src="../js/jquery.min.js" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/cropperjs@1.5.12/dist/cropper.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/cropperjs@1.5.12/dist/cropper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on("change", "#upload_files", async function(evt) {
            var tgt = evt.target || window.event.srcElement,
                files = tgt.files;

            // FileReader support
            if (FileReader && files && files.length) {
                for (let x = 0; x < this.files.length; x++) {
                    var fr = new FileReader();
                    fr.onload = function(e) {
                        var originalImgContainer = document.createElement('div');
                        originalImgContainer.style.marginBottom = '20px';

                        // Exibir a imagem original
                        var originalImg = document.createElement('img');
                        originalImg.src = e.currentTarget.result;
                        originalImg.style.width = "200px";
                        originalImg.style.height = "auto";
                        originalImgContainer.append(originalImg);

                        // Contêiner para a imagem recortada
                        var croppedImgContainer = document.createElement('div');
                        var croppedImg = document.createElement('img');
                        croppedImg.style.width = "200px";
                        croppedImg.style.height = "auto";
                        croppedImgContainer.append(croppedImg);

                        document.body.append(originalImgContainer);
                        document.body.append(croppedImgContainer);

                        originalImg.addEventListener("click", function() {
                            Swal.fire({
                                title: 'Crop your image',
                                html: '<div id="crop-container" style="max-width:100%;">' +
                                    '<img id="image-to-crop" src="' + e.currentTarget.result + '" style="max-width:100%;" />' +
                                    '</div>',
                                didOpen: () => {
                                    // Inicializar o Cropper.js na imagem dentro do SweetAlert2
                                    var imageElement = document.getElementById('image-to-crop');
                                    var cropper = new Cropper(imageElement, {
                                        aspectRatio: 16 / 9,
                                        viewMode: 1,
                                        autoCropArea: 1,
                                        movable: false,
                                        cropBoxResizable: true,
                                    });

                                    // Quando o usuário clicar em "Crop", atualizar a imagem recortada
                                    Swal.getConfirmButton().addEventListener('click', function() {
                                        var croppedCanvas = cropper.getCroppedCanvas();
                                        var croppedImageURL = croppedCanvas.toDataURL('image/jpeg');

                                        // Atualizar a imagem recortada existente
                                        croppedImg.src = croppedImageURL;
                                    });
                                },
                                showCancelButton: true,
                                confirmButtonText: 'Crop',
                            });
                        });
                    };
                    fr.readAsDataURL(files[x]);
                }
            }
        });
    </script>
</body>

</html>