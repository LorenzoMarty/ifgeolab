<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Orbiting Models</title>
    <style>
        body {
            margin: 0;
            overflow: hidden;
            background-color: #3a5a40;
        }

        canvas {
            display: block;
        }
    </style>
    <script type="importmap">
        {
            "imports": {
                "three": "https://cdn.jsdelivr.net/npm/three@0.154.0/build/three.module.js",
                "three/examples/jsm/": "https://cdn.jsdelivr.net/npm/three@0.154.0/examples/jsm/"
            }
        }
    </script>
</head>

<body>
    <script type="module">
        import * as THREE from 'three';
        import { GLTFLoader } from 'https://cdn.jsdelivr.net/npm/three@0.154.0/examples/jsm/loaders/GLTFLoader.js';

        // Tamanho e espaçamento das linhas
        const gridSize = 50; // Tamanho total da grade (em unidades)
        const gridSpacing = 0.5; // Espaçamento entre as linhas

        // Material para as linhas
        const lineMaterial = new THREE.LineBasicMaterial({ color: 0x000000, opacity: 0.5, transparent: true });

        // Função para gerar a grade
        function createGrid() {
            const lines = new THREE.Group(); // Agrupando as linhas

            // Gerar linhas paralelas ao eixo X
            for (let i = -gridSize / 2; i <= gridSize / 2; i += gridSpacing) {
                const geometry = new THREE.BufferGeometry();
                const vertices = new Float32Array([
                    -gridSize / 2, 0, i, // Ponto inicial
                    gridSize / 2, 0, i // Ponto final
                ]);
                geometry.setAttribute('position', new THREE.BufferAttribute(vertices, 3));
                const line = new THREE.Line(geometry, lineMaterial);
                lines.add(line);
            }

            // Gerar linhas paralelas ao eixo Z
            for (let i = -gridSize / 2; i <= gridSize / 2; i += gridSpacing) {
                const geometry = new THREE.BufferGeometry();
                const vertices = new Float32Array([
                    i, 0, -gridSize / 2, // Ponto inicial
                    i, 0, gridSize / 2 // Ponto final
                ]);
                geometry.setAttribute('position', new THREE.BufferAttribute(vertices, 3));
                const line = new THREE.Line(geometry, lineMaterial);
                lines.add(line);
            }

            return lines;
        }

        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer();
        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.setClearColor(0x3a5a40, 1);
        document.body.appendChild(renderer.domElement);

        const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
        scene.add(ambientLight);

        const pointLight = new THREE.PointLight(0xffffff, 4);
        pointLight.position.set(10, 10, 10);
        scene.add(pointLight);

        const centralGeometry = new THREE.SphereGeometry(1, 32, 32);
        const centralMaterial = new THREE.MeshPhongMaterial({
            color: 0x3a5a40,
            transparent: true,
            opacity: 0,
        });
        const centralObject = new THREE.Mesh(centralGeometry, centralMaterial);
        scene.add(centralObject);

        const orbitingObjects = [];
        const orbitRadius = 10;
        const numObjects = 5;

        // Criando a grade
        const grid = createGrid();
        scene.add(grid);


        // Adiciona múltiplas instâncias do modelo
        for (let i = 0; i < numObjects; i++) {
            const objLoader = new GLTFLoader();
            objLoader.load('obj/ametista.glb', (gltf) => {
                const originalModel = gltf.scene;
                originalModel.scale.set(2, 2, 2);
                const angle = (i / numObjects) * Math.PI * 2;
                const clonedModel = originalModel.clone(true); // Clona o modelo original

                // Define a posição de cada instância
                clonedModel.position.set(
                    orbitRadius * Math.cos(angle),
                    0,
                    orbitRadius * Math.sin(angle)
                );

                // Adiciona a instância clonada à cena
                scene.add(clonedModel);

                // Armazena informações sobre o objeto em órbita
                orbitingObjects.push({
                    object: clonedModel,
                    angle,
                    targetAngle: angle
                });
            });
        }

        camera.position.set(0, 2, 5);
        camera.lookAt(new THREE.Vector3(0, 0, 0));

        const raycaster = new THREE.Raycaster();
        const mouse = new THREE.Vector2();
        let isRotating = false;
        let targetAngleOffset = 3 * Math.PI / 2;
        let rotationSpeed = 0.1;

        const targetAngle = 1 * Math.PI / 2;  // Ponto de destino fixo para todos

        window.addEventListener('click', (event) => {
            mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
            mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;

            raycaster.setFromCamera(mouse, camera);
            const intersects = raycaster.intersectObjects(orbitingObjects.map(obj => obj.object));

            if (intersects.length > 0) {
                const clickedObject = orbitingObjects.find(obj => obj.object === intersects[0].object);
                if (clickedObject) {
                    const clickedAngle = clickedObject.angle;
                    const rotationNeeded = (targetAngle - clickedAngle + Math.PI * 2) % (Math.PI * 2);
                    orbitingObjects.forEach(obj => {
                        obj.targetAngle = (obj.angle + rotationNeeded) % (2 * Math.PI);
                    });
                    isRotating = true;
                }
            }
        });

        const centralRotationSpeed = 0.02;

        const animate = function () {
            requestAnimationFrame(animate);

            if (isRotating) {
                let allAligned = true;
                orbitingObjects.forEach(obj => {
                    const angleDifference = (obj.targetAngle - obj.angle + Math.PI * 2) % (Math.PI * 2);
                    if (angleDifference > rotationSpeed) {
                        obj.angle += rotationSpeed;
                        obj.angle = obj.angle % (2 * Math.PI);
                        obj.object.position.x = orbitRadius * Math.cos(obj.angle);
                        obj.object.position.z = orbitRadius * Math.sin(obj.angle);
                        allAligned = false;
                    } else {
                        obj.angle = obj.targetAngle;
                        obj.object.position.x = orbitRadius * Math.cos(obj.targetAngle);
                        obj.object.position.z = orbitRadius * Math.sin(obj.targetAngle);
                    }
                });

                if (!allAligned) {
                    centralObject.rotation.y += centralRotationSpeed;  // Faz o objeto central girar
                } else {
                    isRotating = false;
                }
            }

            renderer.render(scene, camera);
        };

        animate();
    </script>
</body>

</html>