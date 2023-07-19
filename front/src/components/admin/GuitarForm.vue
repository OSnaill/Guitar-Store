<template>
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
</template>
<script setup>
import { reactive } from 'vue';
import axios from 'axios';
import { useGuitarStore} from '@/stores/guitarStore.js';
import { useBrandStore } from '@/stores/brandStore.js';

const formData = reactive({
    reference:'',
    brand:'',
    price:'',
    image: ''
})

const guitarStore = useGuitarStore();
const brandStore = useBrandStore();
function onChangeFile(e) {
    console.log(e.target.files[0])
    formData.image = e.target.files[0]
    console.log(formData.image)
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
        // console.log(formData)

        const formDataToSend = new FormData();
        formDataToSend.append('reference', formData.reference);
        formDataToSend.append('brand', formData.brand);
        formDataToSend.append('price', formData.price);
        formDataToSend.append('image', formData.image);

        console.log(formDataToSend)
        const response = await axios.post('http://boris-guitarshop-b.souquiereboris-dev.fr/api/guitars/create', formDataToSend, config)

        console.log(response)
        console.log(formData.value)
        guitarStore.fetchGuitars();   
}
</script>
<script>

</script>