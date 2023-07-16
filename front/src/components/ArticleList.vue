<template>
    <nav class="md:p-4 bg-dark">
      <section class="max-w-[1280px] m-auto p-4">
        <h2 class="p-4 text-white"> Nouveautés </h2>
        <div class="p-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- On boucle sur le tableau de guitares -->
            <div v-for="guitar in store.guitars" :key="guitar.id">
              <ArticleCard :guitar="guitar" />
            </div>
          </div>
      </section>
    </nav>
</template>
<script setup>
import ArticleCard from './ArticleCard.vue'
import { useGuitarStore } from '@/stores/guitarStore.js';
// On enregistre notre store
const store = useGuitarStore();

// On appelle la méthode qui permet de consommer l'api
store.fetchGuitars();

</script>