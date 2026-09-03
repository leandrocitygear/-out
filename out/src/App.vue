```vue
<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue';
import { RouterLink } from 'vue-router';

const backgroundImages = [
  '/bg_images/1.jpg',
  '/bg_images/2.jpg',
  '/bg_images/3.jpg',
  '/bg_images/4.jpg',
  '/bg_images/5.jpg',
  '/bg_images/6.jpg',
  '/bg_images/7.jpg',
  '/bg_images/8.jpg'
];

const currentBackground = ref(backgroundImages[0]);

let currentIndex = 0;
let backgroundInterval: ReturnType<typeof setInterval>;

onMounted(() => {
  // Preload images
  backgroundImages.forEach((image) => {
    const img = new Image();
    img.src = image;
  });

  backgroundInterval = setInterval(() => {
    currentIndex =
      (currentIndex + 1) % backgroundImages.length;

    currentBackground.value =
      backgroundImages[currentIndex];
  }, 15000);
});

onUnmounted(() => {
  clearInterval(backgroundInterval);
});
</script>

<template>
  <main class="app">

    <Transition name="fade" mode="out-in">
      <div
        :key="currentBackground"
        class="background"
        :style="{
          backgroundImage: `url(${currentBackground})`
        }"
      ></div>
    </Transition>
    
    <div class="overlaid"></div>
    
    <div class="viewContainer">
      <h4>STAYING.IN.GOING.OUT</h4>
      <header>
        <nav>
          <RouterLink to="/" class="navBtn">
            <img  class="navIcons" src="./components/icons/home.png" alt="Home">
          </RouterLink>
          <RouterLink to="/disc-out" class="navBtn">
            <img  class="navIcons" src="./components/icons/music.png" alt="Disc=out">
          </RouterLink>
  
        </nav>

      </header>
      <RouterView />
    </div>

  </main>
</template>

<style>
* {
  box-sizing: border-box;
}

html,
body,
#app {
  margin: 0;
  height: 100%;
  width: 100%;
}

body {
  font-family: Arial, sans-serif;
  background: black;
}

.app {
  position: relative;
  height: 100%;
  width: 100%;
  margin: 0;
  padding: 20px;
  overflow: hidden;
}

/* Background */
.background {
  position: absolute;
  inset: 0;

  width: 100%;
  height: 100%;

  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;

  z-index: 0;
}

/* Fade transition */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 1.0s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

.fade-enter-to,
.fade-leave-from {
  opacity: 1;
}

/* Overlay */
.overlaid {
  position: absolute;
  top: 0;
  left: 0;

  width: 100%;
  height: 100%;

  background: rgba(0, 0, 0, 0.5);

  z-index: 1;
}

header {
  /* border: solid white 1px; */
  margin-bottom: 20px;
  position: relative;
}


nav {
  display: flex;
  gap: 10px;
  /* border: solid white 1px; */

}

h4 {
  color: white;
  position: absolute;
  top: -10px;
  right: 5px;
  /* border: solid 1px white; */
}

.navBtn {
  border: solid 1px white;
  background-color: transparent;
  height: 60px;
  width: 60px;
  cursor: pointer;
  color: white;
  position: relative;
  text-decoration: none;
}

.navIcons {
  position: absolute;
  bottom: 0;
  right: 0;
}

.navBtn:hover .navIcons {
   filter: invert(1);
}

.navBtn:hover {
 background-color: white;
}

.navBtn.router-link-active {
 background-color: white;
}
.navBtn.router-link-active .navIcons {
   filter: invert(1);
}

/* Content */
.viewContainer {
  position: relative;
  z-index: 2;

  border: 3px solid white;
  padding: 10px;
  margin: 0;

  height: 100%;
  width: 100%;
}
</style>
```
