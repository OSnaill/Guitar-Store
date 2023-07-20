<template>
    <main>
        <article class="max-w-[1280px] m-auto p-4 grid grid-cols-3 gap-4">
            <section class=" col-span-1 flex flex-col gap-4">
                <BrandForm />
                <div class="border border-solid rounded-lg shadow-xl  p-4">
                    <div class="flex flex-row justify-between p-4 ">
                        <h4>Marques</h4>
                    </div>
                    <table class="table-auto m-auto">
                        <thead class="font-bold border-b border-solid">
                            <tr>
                                <th> # </th>
                                <th> Marque </th>
                                <th> Editer </th>
                                <th> Supprimer </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="brand in brandStore.brands" class="relative">
                                <td>{{  brand.id  }}</td>
                                <td> {{ brand.name }} </td>
                                <td> <a href="#" class="m-auto" @click.prevent="displayedEditBrand(brand.id)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class=" fill-yellow-500 m-auto">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                    </svg>
                                    </a>
                                </td>
                                <td> 
                                    <a href="#" @click.prevent="removeBrand(brand.id)" class="hover:text-rose-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 m-auto fill-rose-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                    </a>
                                </td>
                                <BrandEditForm :brand="brand" v-if="displayedBrand == brand.id" class="absolute -top-2"/>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
            <section class="col-span-2 flex flex-col gap-4">
                <GuitarForm />
                <div class="p-4 border border-solid rounded-md">
                <div class="flex flex-row justify-between items-center">
                    <h4>Guitares</h4>
                </div>
                <table class="table-auto w-full">
                    <thead class="font-bold border-b border-solid">
                        <tr>
                            <th> # </th>
                            <th> Marque </th>
                            <th> Référence </th>
                            <th> Prix </th>
                            <th> Editer </th>
                            <th> Supprimer </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="guitar in guitarStore.guitars">
                            <td>{{ guitar.id }}</td>
                            <td> {{ guitar.brand_name }} </td>
                            <td class="text-xs"> {{ guitar.reference }} </td>
                            <td> {{ guitar.price  }} €</td>
                            <td> 
                                <router-link :to="{name:'edit', params: {id: guitar.id}}">
                                    <a href="#" >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="m-auto fill-yellow-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                    </svg>
                                    </a>
                                </router-link>
                            </td>
                            <td> <a href="#" @click.prevent="deleteGuitar(guitar.id)" class="hover:text-rose-900">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="m-auto fill-rose-500 ">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            </section>
        </article>
    </main>
</template>
<script setup>
import GuitarForm from '@/components/admin/GuitarForm.vue'
import BrandForm from '@/components/admin/BrandForm.vue'
import { useGuitarStore} from '@/stores/guitarStore.js';
import { useBrandStore } from '@/stores/brandStore.js';
import axios from 'axios';
import BrandEditForm from '@/components/admin/BrandEditForm.vue';
import {ref} from 'vue'
const guitarStore = useGuitarStore();
const brandStore = useBrandStore();

brandStore.fetchBrands()
guitarStore.fetchAllGuitars()

async function deleteGuitar(guitarId)
{
    try {
          const token = localStorage.getItem('token');

          const response = await axios.delete(`https://boris-guitarshop-b.souquiereboris-dev.fr/api/guitars/${guitarId}/delete`, {
            headers: {
                  Authorization: `Bearer ${token}`
              },
          })
          console.log(response)
          guitarStore.fetchAllGuitars()
      } catch {
          console.error('aag')
      }
    
}

function updateGuitarList()
{
    guitarStore.fetchAllGuitars()
}

let displayedBrand = ref(null)

function displayedEditBrand(brand_id)
{
    if(displayedBrand.value == brand_id)
    {
        displayedBrand.value = null
        return
    }
    displayedBrand.value = brand_id
}


async function removeBrand(brand_id)
{
    console.log('allo ?')
    try {
        const token = localStorage.getItem('token');
        const config = {
            headers: {
                Authorization: `Bearer ${token}`
            }
        }
        
        const response = await axios.delete(`https://boris-guitarshop-b.souquiereboris-dev.fr/api/brand/${brand_id}/delete`, config)

        brandStore.fetchBrands();
        guitarStore.fetchAllGuitars();
        // console.log(response);
    } catch {
        console.error('echec')
    }
}

</script>