<script setup lang="ts">
</script>

<template>
  <main class="container">
      <h1 class="logo">/home=out</h1>

      <div class="description">

        <p>
          Applications built in the =out series.
        </p>
      </div>

    <!-- Your application cards will go here -->
  </main>
</template>

<style scoped>

@font-face {
  font-family:'disc';
  src: url('../font/disc.TTF') format('truetype');
}

.logo {
  font-family: 'disc', sans-serif;
  font-size: 50px;
  position: absolute;
  top: -30px;
  left: 0;
}

.container {
  /* min-height: 100vh; */
  /* padding: ; */
  /* background: #ffffff; */
  /* border: solid white 1px; */
  width: 100%;
  height: 92%;
  margin: 0;
  color: white;
  position: relative;
}

.description {
  position: absolute;
  bottom: 0;
  left: 0;
}



</style>