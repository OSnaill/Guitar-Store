<script>
import ArticleList from '../components/ArticleList.vue';
import Infos from '../components/Infos.vue';
export default {
  components: { ArticleList, Infos }

}
</script>

<template>
  <main>
    <article class="bg-gradient-to-r from-yellow-50 to-white p-[20px] flex flex-col justify-center items-center h-[400px] md:h-[500px]">
      <section class="max-w-[400px] flex flex-col gap-[10px]">
        <h1>
          Bienvenue sur <span class="text-dark-yellow">Guitar Store</span>
        </h1>
        <p> Votre boutique de guitares de proximité </p>
        <div class="flex flex-row gap-[10px] ">
          <a href="#"><button class="text-black"> Rechercher </button></a>
          <a><button class="bg-white text-black"> à propos </button></a>
        </div>
      </section>
    </article>
    <ArticleList />
    <Infos />
  </main>
  <footer class="p-[20px] bg-black text-white">
    <section class="max-w-[1280px] m-auto flex flex-row justify-between">
      <div class="p-[20px]">
        <h4 class="p-[20px]"> Contact </h4>
        <div class="p-[20px]">
          <p>@: <span class="text-dark-yellow font-bold">john.doe@gmail.com</span></p>
          <p>tel: <span class="text-dark-yellow font-bold">01.02.03.04.05</span></p>
        </div>
      </div>
      <div>
        <h4 class="p-[20px]"> Développeur </h4>
        <div class="p-[20px] flex flex-col">
          <p>Souquière Boris</p>
          <a href="https://github.com/OSnaill" class="text-white" target="_blank">Github</a>
          <a href="https://www.linkedin.com/in/souquiere-boris/" class="text-white" target="_blank">Linkedin</a>
        </div>
      </div>
    </section>
  </footer>
</template>
