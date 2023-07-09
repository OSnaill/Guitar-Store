<template>
    <header class="p-[20px] flex flex-row justify-between items-center sticky top-0 bg-white bg-opacity-90">
        <section class="flex flex-row gap-[20px] items-center">
            <a href="#" @click.prevent="openNav()" class="md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </a>
            <h4>Guitar Shop</h4>
        </section>
        <section class="flex flex-row gap-[20px] items-center">
            <router-link to="/" class="hidden  md:block" :class="currentRouteName() == 'home'  ? 'text-dark-yellow' : '' "> Accueil</router-link>
            <router-link to="/catalogue" class="hidden  md:block" :class="currentRouteName() == 'catalogue'  ? 'text-dark-yellow' : '' "> guitares </router-link>
            <button class="w-[25px] h-[25px] rounded-full p-[5px] border-[1px]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </button>
            <p> | </p>
            <a href="#"  @click.prevent="openCart()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
            </a>
            <p class="hidden  md:block"> | </p>
            <router-link to="/login" class="hidden  md:block" :class="currentRouteName() == 'login'  ? 'text-dark-yellow' : '' " v-if="isConnected()"> connexion </router-link>
            <p> Connecté </p>
        </section>
        <transition name="slide-fade" class="md:hidden">
            <NavDrawer :isOpen="isNavOpen" @close-nav="closeNav()" />
        </transition>
        <transition name="slide-in">
            <Cart :isCartOpen="isCartOpen" @close-cart="closeCart()"/>
        </transition>
    </header>

</template>
<script>
import NavDrawer from './NavDrawer.vue';
import Cart from './Cart.vue';
import { RouterLink } from 'vue-router';
export default {
    components: {NavDrawer, Cart, RouterLink},
    data(){
        return {
            isNavOpen: false,
            isCartOpen: false,
        }
    },
    methods: {
        openNav(){
            if(this.isCartOpen)
            {
                this.isCartOpen = false;
            }
            this.isNavOpen = true;
        },
        closeNav(){
            console.log('aaa');
            this.isNavOpen = false;
        },
        openCart(){
            if(this.isNavOpen)
            {
                this.isNavOpen = false;
            }
            this.isCartOpen = true;
        },
        closeCart(){
            console.log('aaa 22');
            this.isCartOpen = false;
        },
        currentRouteName(){
            return this.$route.name
        },
        isConnected(){
            if(localStorage.getItem('token')){
                 return true
            } 
            return false
        }
    }
}
</script>

<style scoped>
.slide-fade-enter-active {
  transition: all 0.1s ease-out;
}

.slide-fade-leave-active {
  transition: all 0.1s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateX(-600px);
}
.slide-in-enter-active {
  transition: all 0.1s ease-out;
}

.slide-in-leave-active {
  transition: all 0.1s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-in-enter-from,
.slide-in-leave-to {
  transform: translateX(600px);
}
</style>