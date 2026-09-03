<script setup lang="ts">

import { onMounted, ref } from 'vue';

interface AppProject {
  id: number;
  name: string;
  description: string;
  status: string;
  platforms: string[];
}

const apps = ref<AppProject[]>([]);

const loading = ref(true);

const error = ref<string | null>(null);


async function loadApps() {

  try {

    loading.value = true;

    error.value = null;

    const response = await fetch(`${import.meta.env.VITE_API_URL}/api/apps.php`);

    if (!response.ok) {
      throw new Error(
        `Server returned ${response.status}`
      );
    }

    apps.value = await response.json();

  } catch (err) {

    error.value =
      err instanceof Error
        ? err.message
        : 'Failed to load applications.';

  } finally {

    loading.value = false;

  }

}


onMounted(() => {

  loadApps();

});

</script>


<template>

  <main class="container">

    <h1 class="logo">/disc=out</h1>

    <div class="description">

      <p>
        Applications built in the =out series.
      </p>
  
  
      <p v-if="loading">
        Loading applications...
      </p>
  
  
      <p v-if="error">
        {{ error }}
      </p>
  
  
      <section v-if="!loading && !error">
  
        <article
          v-for="app in apps"
          :key="app.id"
        >
  
          <h2>
            {{ app.name }}
          </h2>
  
          <p>
            {{ app.description }}
          </p>
  
          <p>
            Status: {{ app.status }}
          </p>
  
          <p>
            Platforms:
            {{ app.platforms.join(', ') }}
          </p>
  
        </article>
  
      </section>
    </div>

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
  top: 0;
  left: 0;
}


.container {
  /* min-height: 100vh; */
  padding: px;
  /* background: #ffffff; */
  border: solid white 1px;
  width: 800px;
  height: 600px;
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