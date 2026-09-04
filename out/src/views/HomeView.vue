<script setup lang="ts">
import { onMounted, ref } from 'vue'
import { RouterLink } from 'vue-router';


interface AppProject {
  id: number
  name: string
  description: string
  status: string
  platforms: string[]
  iconImage: string
  screenshots: string[]
  github: string
  downloads: Record<string, string>
}

const apps = ref<AppProject[]>([])
const loading = ref(true)
const error = ref('')

onMounted(async () => {
  try {
    const response = await fetch(
      `${import.meta.env.VITE_API_URL}/api/apps.php`
    )

    if (!response.ok) {
      throw new Error('Failed to fetch applications')
    }

    apps.value = await response.json()
  } catch (err) {
    error.value = 'Unable to load applications.'
    console.error(err)
  } finally {
    loading.value = false
  }
})
</script>

<template>
  <main class="container">
      <h1 class="logo">/home=out</h1>

      <div class="description">

        <p>
          The =out series is a collection of applications built to turn ideas into experiences. Each project explores a different concept, problem, or creative direction, bringing together thoughtful design, useful functionality, and a focus on building software that feels distinctly its own.

        </p>

        
          <div
          v-for="app in apps"
          :key="app.id"
          class="app"
        >

          <RouterLink class="link" to="/disc-out">
            
            <img
              class="iconlogo"
              :src="app.iconImage"
              :alt="`${app.name} icon`"
            >
  
            <span>{{ app.name }}</span>
          </RouterLink>
        </div>
        

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
  /* height: 50%; */
  width: 26%;
  /* border: solid; */
  line-height: 1.6;
}

@media (max-width: 768px) {
  .description {
    position: absolute;
    bottom: 60px;
    left: 0;

    height: 50%;
    width: 100%;
    /* border: solid 1px; */
  }
}


.iconlogo {
  height: 80px;
  width: 80px;
}

.link {
  text-decoration: none;
  color: white;
  /* border: solid; */
  display: flex;
  gap: 4px;
  flex-direction: column;
  text-align: center;
}

.app {
  /* border: solid; */
  display: flex;
  justify-content: space-evenly;
  gap: 6px;
}




</style>