<template>
    <nav class="md:p-[20px] bg-dark">
      <section class="max-w-[1280px] m-auto p-[20px]">
        <h2 class="p-[20px] text-white"> Nouveautés </h2>
        <div class="p-[20px] grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-[20px]">
            <!-- On boucle sur le tableau de guitares -->
            <div v-for="guitar in store.guitars" :key="guitar.id">
            <router-link router-link :to="`/article/${guitar.id}`"   >
              <ArticleCard :id="guitar.id" :brand="guitar.brand_name" :content="guitar.reference" :price="guitar.price" :image="guitar.image" />
            </router-link>
            </div>
          </div>
      </section>
    </nav>
</template>
<script setup>
import ArticleCard from './ArticleCard.vue'
import { useGuitarStore } from '@/stores/guitarStore.js';
import { RouterLink } from 'vue-router';
// On enregistre notre store
const store = useGuitarStore();

// On appelle la méthode qui permet de consommer l'api
store.fetchGuitars();

</script>