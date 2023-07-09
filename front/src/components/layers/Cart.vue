<template>
    <nav class="absolute w-full h-screen top-0 right-0 overflow-hidden" @Click="closeCart()" v-if="isCartOpen" >
        <a href="#" @click="closeCart" class=" block w-screen h-screen top-0  z-0 bg-opacity-80"></a>
        <div class="h-full w-5/6 md:w-1/2 bg-white rounded-l-lg z-10 absolute shadow-lg top-0 right-0">
            <section class="p-[20px] flex flex-row justify-between">
                <h3 >Panier</h3>
                <a href="#" @click="closeCart()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-[20px] h-[20px]" @Click="closeNav()">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                </a>
            </section>
            <section class="p-[20px]">
            </section>
        </div>
    </nav>
</template>
<script>
export default {
    props: {
        isCartOpen: Boolean,
    },
    setup(props) {
        console.log(props)
    },
    methods:{
        closeCart(){
            console.log('aaa')
            this.$emit('close-cart')
        }
    }
}
</script>