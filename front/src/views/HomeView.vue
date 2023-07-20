<script>
import ArticleList from '../components/ArticleList.vue';
import Infos from '../components/Infos.vue';
export default {
  components: { ArticleList, Infos }

}
</script>

<template>
  <main>
    <article class="h-[550px] md:h-[750px] -mt-[95px] pres">
      <div class="h-full w-full  bg-slate-100 flex flex-col justify-center items-center bg-opacity-30">
        <section class="max-w-[400px] flex flex-col gap-[10px] ">
          <h1>
            Bienvenue sur <span class="text-dark-yellow text-shadow">Guitar Store</span>
          </h1>
          <p class="font-bold"> Votre boutique de guitares de proximité </p>
          <div class="flex flex-row gap-[10px] ">
            <router-link to="/search"><a href="#"><button class="text-black"> Rechercher </button></a></router-link>
          </div>
        </section>
      </div>
    </article>
    <ArticleList />
    <Infos />
  </main>
</template>
