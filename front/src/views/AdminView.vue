<template>
    <main>
        <article class="max-w-[1280px] m-auto p-[20px] flex flex-row gap-[20px]">
            <section class="p-[20px] border border-solid rounded-lg shadow-xl">
                <div class="flex flex-row justify-between items-center">
                    <h4>Marques</h4>
                    <a href="#"><Button>
                        Ajouter une Marque
                    </Button></a>
                </div>
                <table class="table-auto">
                    <thead class="font-bold border-b border-solid">
                        <tr>
                            <th> # </th>
                            <th> Marque </th>
                            <th> Editer </th>
                            <th> Supprimer </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td> Marque </td>
                            <td> <a href="#" >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class=" fill-yellow-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                </svg>
                                </a>
                            </td>
                            <td> <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>
            <section  class="p-[20px]">
                <div class="flex flex-row justify-between items-center">
                    <h4>Guitares</h4>
                    <Button  @click="switchGuitarFormDisplay()">
                        Ajouter une guitare
                    </Button>
                </div>
                <table class="table-auto">
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
                            <td class="text-sm"> {{ guitar.reference }} </td>
                            <td> {{ guitar.price  }} €</td>
                            <td> <a href="#" >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="m-auto fill-yellow-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                </svg>
                                </a>
                            </td>
                            <td> <a href="#" class="hover:text-rose-900">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="m-auto fill-rose-500 ">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>
            <div class="">
                <GuitarForm  />
            </div>
        </article>
    </main>
</template>
<script setup>
import GuitarForm from '@/components/admin/GuitarForm.vue'
import { useGuitarStore} from '@/stores/guitarStore.js';

const guitarStore = useGuitarStore();

guitarStore.fetchGuitars()

let isGuitarFormOpen = false;
function switchGuitarFormDisplay() {
    isGuitarFormOpen ? isGuitarFormOpen = false : isGuitarFormOpen = true
    console.log(isGuitarFormOpen)
}

</script>