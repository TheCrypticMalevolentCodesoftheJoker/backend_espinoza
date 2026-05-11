import * as THREE from "three";
import { GLTFLoader } from "three/examples/jsm/loaders/GLTFLoader.js";
import { OrbitControls } from "three/examples/jsm/controls/OrbitControls.js";

const container = document.getElementById("scene-container");

if (container) {
  const scene = new THREE.Scene();

  const camera = new THREE.PerspectiveCamera(
    60,
    container.clientWidth / container.clientHeight,
    0.1,
    1000,
  );

  const renderer = new THREE.WebGLRenderer({
    alpha: true,
    antialias: true,
    powerPreference: "high-performance",
  });

  renderer.setSize(container.clientWidth, container.clientHeight);
  renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

  renderer.toneMapping = THREE.ACESFilmicToneMapping;
  renderer.toneMappingExposure = 1.3;

  container.appendChild(renderer.domElement);

  scene.add(new THREE.AmbientLight(0xffffff, 1.2));

  const dirLight = new THREE.DirectionalLight(0xffffff, 1.5);
  dirLight.position.set(5, 5, 5);
  scene.add(dirLight);

  const controls = new OrbitControls(camera, renderer.domElement);

  controls.enableDamping = true;
  controls.dampingFactor = 0.05;

  controls.enableZoom = true;
  controls.enablePan = true;

  // 🎯 punto central (CONTROL PRINCIPAL)
  const pivot = new THREE.Group();
  scene.add(pivot);

  const loader = new GLTFLoader();

  let model;

  loader.load("/models/Espinoza.glb", (gltf) => {
    model = gltf.scene;

    // 📏 bounding box
    const box = new THREE.Box3().setFromObject(model);
    const size = box.getSize(new THREE.Vector3());
    const center = box.getCenter(new THREE.Vector3());

    // 🎯 centrar modelo en pivot
    model.position.sub(center);

    // 📐 CONTROL DE TAMAÑO (ÚNICO PUNTO)
    const targetSize = 4.5;
    const maxSize = Math.max(size.x, size.y, size.z);
    const scale = targetSize / maxSize;

    model.scale.setScalar(scale);

    // 📍 apoyar en suelo
    const box2 = new THREE.Box3().setFromObject(model);
    model.position.y -= box2.min.y;

    // 🧩 agregar al pivot
    pivot.add(model);

    // 📷 cámara fija al pivot
    camera.position.set(0, 1.2, 6);
    camera.lookAt(pivot.position);

    controls.target.copy(pivot.position);
    controls.update();
  });

  // 🎮 animación mejorada (rotación + inclinación suave)
  function animate() {
    requestAnimationFrame(animate);

    if (pivot) {
      pivot.rotation.y += 0.002;
      pivot.rotation.x = 0.2;
    }

    controls.update();
    renderer.render(scene, camera);
  }

  animate();
  window.addEventListener("resize", () => {
    const w = container.clientWidth;
    const h = container.clientHeight;

    camera.aspect = w / h;
    camera.updateProjectionMatrix();

    renderer.setSize(w, h);
  });
}
