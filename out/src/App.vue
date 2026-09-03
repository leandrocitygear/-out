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

    const response = await fetch('/api/apps.php');

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

  <main>

    <h1>=out</h1>

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

  </main>

</template>