<template>
    <div class="flex flex-row md:flex-col hover:rotate-2 duration-[0.05s] hover:text-dark p-[20px] bg-white">
        <!-- <div class="w-1/3 md:w-full md:h-[150px] bg-dark-yellow  ">
            <p class="text-center">image</p>
        </div> -->
        <!-- <div class="w-1/3 md:w-full md:h-[150px] bg-dark-yellow  ">
            <p class="text-center">image</p>
        </div> -->
        <img :src=" image ? `http://localhost:8080/guitars/${image}` : '/src//assets/img/base_guitar.png'" alt="image guitare" class="w-1/3 h-[100px] md:w-full md:h-[150px] bg-white object-contain ">
        <div class="w-2/3 md:w-full md:h-auto bg-white flex flex-col gap-[5px]">
            <h4> {{brand}} </h4>
            <p> {{content}} </p>
            <p class="text-xs italic font-bold text-right "> {{price}} € </p>
        </div>
    </div>
</template>
<script setup>
import { RouterLink } from 'vue-router';
const props = defineProps ({
    id: Number,
    brand: String,
    content: String,
    price: Number,
    image: String
})


</script>