<script setup>
import { RouterView } from 'vue-router'
import Header from './components/layers/Header.vue'
// J'ai du renommé "Footer.vue" en FooterComponent pour éviter une erreur
import Footer from './components/layers/FooterComponent.vue'
</script>
<template>
  <Header></Header>
  <RouterView />
  <Footer></Footer>
</template>

<style scoped>
</style>
