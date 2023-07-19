<template>
    <div class="p-[20px] h-[600px] flex flex-col justify-center">
        <article class=" bg-white p-4 border border-solid rounded-md">
            <h3 class="p-4">Ajouter une guitare</h3>
            <form class="flex flex-row flex-wrap items-end gap-4 p-4">
                <div class="flex flex-col">
                <label for="brand"> Marque </label>
                <select name="brand" id="" class="border border-solid border-dark p-[10px]" v-model="formData.brand">
                    <option :value="brand.name" v-for=" brand in brandStore.brands"> {{ brand.name }} </option>
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
                <div class="flex flex-col">
                    <label for="brand"> Image </label>
                    <input type="file" name="price"     v-on:change="onChangeFile" accept="image/*">
                </div>
                <button class="font-bold max-h-[40px]" @click.prevent="submitForm()">Submit</button>
            </form>
        </article>
    </div>
</template>
<script setup>
import { reactive } from 'vue';
import axios from 'axios';
import { useGuitarStore} from '@/stores/guitarStore.js';
import { useBrandStore } from '@/stores/brandStore.js';
import { useRoute } from 'vue-router';


const guitarStore = useGuitarStore();
const brandStore = useBrandStore();

brandStore.fetchBrands();

const formData = reactive({
    id: useRoute().params.id,
    reference:'',
    brand:'',
    price:'',
    image: null
})

function onChangeFile(e) {
    formData.image = e.target.files[0]
}
// Formulaire d'ajout de guitare
const submitForm= async () => {

        const token = localStorage.getItem('token');
        const config = {
            headers: {
                Authorization: `Bearer ${token}`,
                'Content-Type': 'multipart/form-data'
            }
        }
        
        const formDataToSend = new FormData();
        formDataToSend.append('id', formData.id);
        formDataToSend.append('reference', formData.reference);
        formDataToSend.append('brand', formData.brand);
        formDataToSend.append('price', formData.price);
        formDataToSend.append('image', formData.image);

        const response = await axios.post(`http://boris-guitarshop-b.souquiereboris-dev.fr/api/guitars/${formDataToSend.get('id')}/edit`, formDataToSend, config)

        console.log(response)
        guitarStore.fetchGuitars();   
}
</script>
<script>

</script>