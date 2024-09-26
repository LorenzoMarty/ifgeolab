var swiper = new Swiper(".mySwiper", {
    spaceBetween: 10,
    slidesPerView: 4,
    freeMode: true,
    watchSlidesProgress: true,
});

$(document).on("change", "#upload_files", async function (evt) {
    var tgt = evt.target || window.event.srcElement,
        files = tgt.files;

    // Verificar se o FileReader é suportado
    if (FileReader && files && files.length) {
        for (let x = 0; x < files.length; x++) {
            var fr = new FileReader();
            
            fr.onload = function (e) {
                var swiperWrapper = document.querySelector('.swiper-wrapper'); // Seleciona o wrapper do carrossel

                // Criar o slide para inserir a imagem
                var slide = document.createElement('div');
                slide.classList.add('swiper-slide');

                // Criar a imagem carregada
                var originalImg = document.createElement('img');
                originalImg.src = e.target.result;
                originalImg.style.width = "100%";
                originalImg.style.height = "auto";
                originalImg.style.objectFit = "cover"; // Mantém proporção da imagem

                // Imagem recortada (inicialmente oculta)
                var croppedImg = document.createElement('img');
                croppedImg.style.width = "100%";
                croppedImg.style.height = "auto";
                croppedImg.style.display = "none"; // Inicialmente oculta

                // Adicionar a imagem original e recortada ao slide
                slide.appendChild(originalImg);
                slide.appendChild(croppedImg);

                // Adicionar o slide ao wrapper do Swiper
                swiperWrapper.appendChild(slide);

                // Atualizar o Swiper após adicionar um novo slide
                swiper.update();

                // Ao clicar na imagem original, abrir o SweetAlert2 para o cropper
                originalImg.addEventListener("click", function () {
                    Swal.fire({
                        title: 'Recorte a sua imagem',
                        html: '<div id="crop-container" style="max-width:100%;">' +
                            '<img id="image-to-crop" src="' + e.target.result + '" style="max-width:100%;" />' +
                            '</div>',
                        didOpen: () => {
                            // Inicializar o Cropper.js na imagem dentro do SweetAlert2
                            var imageElement = document.getElementById('image-to-crop');
                            var cropper = new Cropper(imageElement, {
                                aspectRatio: 4 / 3,
                                viewMode: 1,
                                autoCropArea: 1,
                                movable: false,
                                cropBoxResizable: true,
                            });

                            // Quando o usuário clicar em "Crop", atualizar a imagem corrigida
                            Swal.getConfirmButton().addEventListener('click', function () {
                                var croppedCanvas = cropper.getCroppedCanvas();
                                var croppedImageURL = croppedCanvas.toDataURL('image/jpeg');

                                // Substituir a imagem original pela recortada e remover a original
                                originalImg.style.display = "none"; // Ocultar a imagem original
                                croppedImg.src = croppedImageURL;   // Definir o src da imagem recortada
                                croppedImg.style.display = "block"; // Exibir a imagem recortada
                            });
                        },
                        showCancelButton: true,
                        confirmButtonText: 'Recortar',
                    });
                });
            };
            
            fr.readAsDataURL(files[x]);
        }
    }
});