<template>
    <article class=" bg-white p-[20px] border border-solid rounded-md">
        <h3 class="p-[20px]">Ajouter une guitare</h3>
        <form class="flex flex-row flex-wrap items-center gap-[20px] p-[20px]">
            <div class="flex flex-col">
            <label for="brand"> Marque </label>
            <select name="brand" id="" class="border border-solid border-dark p-[10px]" v-model="formData.brand">
                <option value="Fender"> Fender </option>
                <option value="Ibanez"> Ibanez </option>
            </select>
            </div>
            <div class="flex flex-col">
                <label for="brand"> Référence </label>
                <input type="text" name="reference" id="" class="min-w-[500px]"  v-model="formData.reference">
            </div>
            <div class="flex flex-col">
            <label for="brand"> Prix </label>
                <input type="float" name="price"  v-model="formData.price">
            </div>
            <button class="font-bold max-h-[40px]" @click.prevent="submitForm()">Submit</button>
        </form>
    </article>
</template>
<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useGuitarStore} from '@/stores/guitarStore.js';
const formData = ref({
    reference:'',
    brand:'',
    price:''
})
const guitarStore = useGuitarStore();
// Formulaire d'ajout de guitare
const submitForm= async () => {
    try {
        const token = localStorage.getItem('token');
        const config = {
            headers: {
                Authorization: `Bearer ${token}`
            }
        }
        
        const response = await axios.post('http://localhost:8080/api/guitars/create', formData.value, config)

        
        guitarStore.fetchGuitars();
        formData.value = {
            name:'',
            reference:'',
            brand:'',
            price:''
        };
    } catch {
        console.error('truc')
    }
}
</script>
<script>

</script>