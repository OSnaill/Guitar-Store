<template>
    <nav class="absolute w-screen h-screen top-0 left-0 overflow-hidden md:hidden pb-[20px]" @Click="closeNav()" v-if="isOpen" >
        <a href="#" @click="closeNav" class=" block w-screen h-screen top-0 left-0 bg-dark z-0 bg-opacity-80"></a>
        <div class="h-full w-5/6 bg-white rounded-r-lg z-10 absolute top-0 left-0">
            <section class="p-4 flex flex-row justify-between">
                <h3>Menu</h3>
                <a href="#" @click="closeNav">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-[20px] h-[20px]" @Click="closeNav()">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                </a>
            </section>
            <section class="p-4 flex flex-col">
                <router-link class="p-4 text-lg" to="/"  :class="currentRouteName() == 'home'  ? 'text-dark-yellow' : '' "> Accueil</router-link>
                <router-link class="p-4 text-lg" to="/search"  :class="currentRouteName() == 'search'  ? 'text-dark-yellow' : '' "> Rechercher</router-link>
            </section>
        </div>
    </nav>
</template>
<script>
// import { RouterLink } from 'vue-router'

export default {
    components: {
        // RouterLink
    },
    props: {
        isOpen: Boolean,
    },
    setup(props) {
        console.log(props)
    },
    methods:{
        closeNav(){
            this.$emit('close-nav')
        },
        currentRouteName(){
            return this.$route.name
        }
    }
}
</script>