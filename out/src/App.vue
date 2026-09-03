<script setup lang="ts">
import HomeView from './views/HomeView.vue';



</script>


<template>
  <main class="app">
    <div class="overlaid"></div>
    <div class="viewContainer">
      <HomeView />
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
  display: block;
  position: relative;
  height: 100%;
  width: 100%;
  margin: 0;
  padding: 20px;
  border: solid red 1px;
  background-image: url("./mbid-0e6f4e8b-d961-43cb-a065-79d1686d9c43-31438455035.jpg");
  background-size: cover;
  background-repeat: no-repeat;
}

.overlaid {
   position: absolute; /* 2. Removes it from the normal document flow */
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  /* backdrop-filter: blur(2px); */
  z-index: 1; /* 3. Places it above the background but below content */
}

.viewContainer {
  position: relative;
  z-index: 2;
  border: 1px solid white;
  padding: 10px;
  margin: 0;
  height: 100%;
  width: 100%;
}
</style>