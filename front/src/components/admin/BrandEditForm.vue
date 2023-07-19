<template>
    <article class=" bg-white p-4 border border-solid rounded-md">
        <form class="flex flex-row items-end gap-4">
            <div class="flex flex-col">
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
import { useGuitarStore } from '@/stores/guitarStore.js';

const props = defineProps({
    brand: Object
})

const formData = ref({
    brand:'',
})

const brandStore = useBrandStore();
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
        
        const response = await axios.post(`https://boris-guitarshop-b.souquiereboris-dev.fr/api/brand/${props.brand.id}/edit`, formData.value, config)

        
        brandStore.fetchBrands();
        guitarStore.fetchAllGuitars();

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