<template>
    <article class="lightbg">
        <section class="max-w-[1280px] m-auto p-4">
            <div class="grid md:grid-cols-4 gap-8">
                <div class="md:col-span-1 w-full">
                    <h4 class="p-4"> Filtres</h4>
                    <div class="border border-solid shadow-2xl p-4 flex flex-col gap-4">
                        <div class="flex flex-col">
                            <label for=""> Marque </label>
                            <select name="brand" id="" v-model="brandFilter" class="p-2 border border-solid" @change="getFilteredGuitar()">
                                <option :value="null" selected> Tout </option>
                                <option :value="brand.name" v-for="brand in brandStore.brands">  {{ brand.name }}</option>
                            </select>
                        </div>
                        <!-- <div class="flex flex-col">
                            <label for=""> Prix Maximal </label>
                            <input type="range" name="" id="" :max="guitarStore.maxValue" min="0" step="1" v-model="rangePrice" @change="getFilteredGuitar()">
                            Prix: {{ rangePrice }} €
                        </div> -->
                    </div>
                </div>
                <div class="md:col-span-3 ">
                    <h4 class="p-4">Articles</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 overflow-y-scroll custom-scrollbar max-h-[650px]  ">
                        <ArticleCard :guitar="article" class="card" v-for="article in guitarStore.guitars"/>
                    </div>
                </div>
            </div>
        </section>
    </article>
</template>
<script setup>
import { useGuitarStore }  from '@/stores/guitarStore.js'
import { useBrandStore }  from '@/stores/brandStore.js'
import  ArticleCard  from '@/components/ArticleCard.vue'
import {ref} from 'vue';

const guitarStore = useGuitarStore()
const brandStore = useBrandStore()

guitarStore.fetchAllGuitars()
brandStore.fetchBrands()

const brandFilter = ref(null);
const rangePrice = ref(0)

async function getFilteredGuitar()
{
    if(brandFilter.value == null)
    {
       await  guitarStore.fetchAllGuitars()
       await guitarStore.getMaxGuitarValue()
    } else {
    await guitarStore.fetchFilteredGuitars(brandFilter.value)
    await guitarStore.getMaxGuitarValue()
    }
}
</script>