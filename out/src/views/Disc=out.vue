<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue';

interface AppProject {
  id: number;
  name: string;
  description: string;
  status: string;
  platforms: string[];
  iconImage: string;
  screenshots: string[];
  github: string;
  downloads: Record<string, string>;
}

const apps = ref<AppProject[]>([]);

const loading = ref(true);
const error = ref<string | null>(null);

const currentScreenshot = ref(0);

let screenshotInterval: ReturnType<typeof setInterval> | undefined;

async function loadApps() {
  try {
    loading.value = true;
    error.value = null;

    const response = await fetch(
      `${import.meta.env.VITE_API_URL}/api/apps.php`
    );

    if (!response.ok) {
      throw new Error(`Server returned ${response.status}`);
    }

    apps.value = await response.json();

    // Preload screenshots
    apps.value.forEach((app) => {
      app.screenshots.forEach((screenshot) => {
        const img = new Image();
        img.src = screenshot;
      });
    });

    // Start screenshot rotation
    if (apps.value.length > 0) {
      const screenshots = apps.value[0]?.screenshots ?? [];

      if (screenshots.length > 0) {
        screenshotInterval = setInterval(() => {
          currentScreenshot.value =
            (currentScreenshot.value + 1) % screenshots.length;
        }, 10000);
      }
    }

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

onUnmounted(() => {
  if (screenshotInterval) {
    clearInterval(screenshotInterval);
  }
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
    <!-- Screenshots -->
<article
          v-for="app in apps"
          :key="app.id"
        >
    <div
      v-if="app.screenshots.length > 0"
      class="screenshotContainer"
    >

      <Transition
        name="screenshotFade"
        mode="out-in"
      >

        <img
          :key="app.screenshots[currentScreenshot]"
          :src="app.screenshots[currentScreenshot]"
          :alt="`${app.name} screenshot ${currentScreenshot + 1}`"
          class="screenshot"
        >

      </Transition>

    </div>
    </article>

  </main>

</template>

<style scoped>

@font-face {
  font-family: 'disc';
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
  border: solid white 1px;
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
  /* height: 100%; */
  /* width: 100%; */
  border: solid;
}

.screenshotContainer {
  position: absolute;
  /* width: 914px; */
  /* width: 60%; */
  /* height: 591px; */
  height: 70%;
  /* overflow: hidden; */
  top: 35%;
  left: 50%;

  transform: translate(-50%, -50%);
  /* border: solid ; */
}

.screenshot {
  width: 100%;
  height: 100%;
  object-fit: contain;
  display: block;
}

/* Screenshot fade */

.screenshotFade-enter-active,
.screenshotFade-leave-active {
  transition: opacity 1s ease;
}

.screenshotFade-enter-from,
.screenshotFade-leave-to {
  opacity: 0;
}

.screenshotFade-enter-to,
.screenshotFade-leave-from {
  opacity: 1;
}

</style>