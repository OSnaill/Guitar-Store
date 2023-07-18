<template>
    <nav class="absolute w-full h-screen top-0 left-0" @Click="closeCart()" v-if="isCartOpen">
        <a href="#" @click.prevent="closeCart" class=" block w-full h-screen top-0  z-0 bg-opacity-80"></a>
        <div class=" absolute  top-4 bottom-[20px]  w-5/6 md:w-1/3 right-0">
            <div class="h-[600px]  bg-white rounded-l-lg z-10  shadow-lg overflow-y-scroll border border-solid">
                <section class="p-4 flex flex-row justify-between">
                    <h3 >Panier</h3>
                    <a href="#" @click.prevent="closeCart()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-[20px] h-[20px]" @Click="closeNav()">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    </a>
                </section>
                <section class="p-4 flex flex-col">
                    <div v-for="article, id in store.cart" class="p-4 max-w-[500px] border-b border-solid hover:bg-dark hover:bg-opacity-10 ">
                        <h4>{{ article.brand_name }}</h4>
                        <p class="italic">{{ article.reference }}</p>
                        <p class="font-bold text-right">{{ article.price }} €</p>
                        <a href="#" class="text-rose-700" @click.prevent="remove(article, id)"> Supprimer </a>
                    </div>
                </section>
            </div>
        </div>
    </nav>
</template>
<script setup>
import { useGuitarStore } from '@/stores/guitarStore';
const props = defineProps({
    isCartOpen: Boolean
})
const emit = defineEmits(['close-cart'])
const store = useGuitarStore()


function closeCart(){
    emit('close-cart')
}

function remove(article, id){
    store.removeFromCart(article, id)
}
</script>