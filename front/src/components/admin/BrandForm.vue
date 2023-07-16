<template>
    <article class=" bg-white p-4 border border-solid rounded-md">
        <h3 class="p-4">Ajouter une marque</h3>
        <form class="flex flex-row flex-wrap items-end gap-4 p-4">
            <div class="flex flex-col">
            <label for="brand"> Nom </label>
                <input type="input" name="brand"  v-model="formData.brand">
            </div>
            <button class="font-bold max-h-[40px]" @click.prevent="submitForm()">Submit</button>
        </form>
    </article>
</template>
<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useBrandStore } from '@/stores/brandStore.js';

const formData = ref({
    brand:'',
})

const brandStore = useBrandStore();

// Formulaire d'ajout de guitare
const submitForm= async () => {
    try {
        const token = localStorage.getItem('token');
        const config = {
            headers: {
                Authorization: `Bearer ${token}`
            }
        }
        
        const response = await axios.post('http://localhost:8080/api/brand/create', formData.value, config)

        
        brandStore.fetchBrands();
        formData.value = {
            brand:'',
        };
    } catch {
        console.error('echec formulaire marque')
    }
}
</script>
<script>

</script>