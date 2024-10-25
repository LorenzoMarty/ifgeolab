<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skybox Height Adjustment and Model Grounding</title>
    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
    <style>
        body {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }
        model-viewer {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>

<model-viewer id="model-viewer"
              class="card__model"
              shadow-intensity="2"
              src="obj/arenito.glb"
              max-camera-orbit="auto 90deg"
              autoplay
              auto-rotate
              ar
              ar-scale="fixed"
              camera-controls
              touch-action="pan-y"
              skybox-image="img/fundo.hdr"
              poster="img/geolab-branco.png">
</model-viewer>

<script>
    const modelViewer = document.getElementById('model-viewer');

    modelViewer.addEventListener('scene-graph-ready', () => {
        const scene = modelViewer.model?.scene; 

        if (scene) {
            const box = new modelViewer.constructor.THREE.Box3().setFromObject(scene); 
            const center = new modelViewer.constructor.THREE.Vector3();
            box.getCenter(center);

            const height = box.max.y - box.min.y;

            const offsetY = box.min.y;
            scene.position.y -= offsetY; 

            const skyboxHeight = height * 2;
            modelViewer.environmentImage = 'img/fundo.hdr';

            console.log("Altura do modelo:", height, "metros");
            console.log("Modelo reposicionado para tocar o chão.");

        } else {
            console.error("A cena do modelo não foi carregada corretamente.");
        }
    });
</script>

</body>
</html>
