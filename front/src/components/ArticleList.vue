<template>
    <nav class="md:p-[20px] bg-dark">
      <section class="max-w-[1280px] m-auto p-[20px]">
        <h2 class="p-[20px] text-white"> Nouveautés </h2>
        <div class="p-[20px] grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-[20px]">
            <ArticleCard :brand="'ibanez'" :content="'Une référence longue'" :price="'499,99'" />
            <ArticleCard :brand="'ibanez'" :content="'Une référence longue'" :price="'499,99'" />
            <ArticleCard :brand="'ibanez'" :content='"Une référence longue"' :price="'499,99'" />
            <ArticleCard :brand="'ibanez'" :content="'Une référence longue'" :price="'499,99'" />
        </div>
      </section>
    </nav>
</template>
<script setup>
import ArticleCard from './ArticleCard.vue'

</script>