<template>
  <main>
    <article>
      <div v-if="store.isLoaded" class="p-[20px] max-w-[400px] m-auto flex flex-col gap-[20px]">
        <img :src=" store.singleGuitar.image ? `http://localhost:8080/guitars/${store.singleGuitar.image}` : '/src//assets/img/base_guitar.png'" alt="Image guitare" class="max-w-[100px] m-auto">
        <h4>{{ store.singleGuitar.brand_name }}</h4>
        <p class="italic">{{ store.singleGuitar.reference }}</p>
        <p class="font-bold">{{ store.singleGuitar.price }} €</p>
        <button class="font-bold max-w-[125px]" @click="addToCart(store.singleGuitar)">Au panier</button>
      </div>
    </article>
  </main>
</template>
<script setup>
import { useRoute } from 'vue-router';
import { useGuitarStore } from '@/stores/guitarStore';

const route = useRoute();
const store = useGuitarStore();
store.fetchOneGuitar(route.params.id)


 function addToCart(guitar){
    store.pushToCart(guitar);
 } 



</script>