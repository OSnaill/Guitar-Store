<template>
    <div class="flex flex-col items-center gap-4 hover:text-dark p-4 bg-white border border-solid shadow-lg border-slate-400 h-full">
        <!-- <div class="w-1/3 md:w-full md:h-[150px] bg-dark-yellow  ">
            <p class="text-center">image</p>
        </div> -->
        <!-- <div class="w-1/3 md:w-full md:h-[150px] bg-dark-yellow  ">
            <p class="text-center">image</p>
        </div> -->
        <img :src=" guitar.image_name ? `https://boris-guitarshop-b.souquiereboris-dev.fr/guitars/${guitar.image_name}` : '/src//assets/img/base_guitar.png'" alt="image guitare" class=" h-[75px] w-full md:h-[100px] bg-white object-contain ">
        <div class="w-full md:h-auto bg-white flex flex-col gap-4">
            <h4> {{guitar.brand_name}} </h4>
            <p> {{guitar.reference}} </p>
            <div class="flex flex-row justify-between items-center">
                <button @click="store.pushToCart(guitar)" class="text-xs font-bold"> Au Panier</button>
                <p class="text-xs italic font-bold text-right "> {{guitar.price}} € </p>
            </div>
        </div>
    </div>
</template>
<script setup>
import { useGuitarStore } from '@/stores/guitarStore';
const store = useGuitarStore();
const props = defineProps ({
    guitar: Object
})


</script>