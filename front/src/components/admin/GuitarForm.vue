<template>
    <article class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-[20px] border border-solid rounded-md">
        <h3 class="p-[20px]">Ajouter une guitare</h3>
        <form class="flex flex-row items-center gap-[20px] p-[20px]">
            <div class="flex flex-col">
            <label for="brand"> Marque </label>
            <select name="brand" id="" class="border border-solid border-dark p-[10px]" v-model="formData.brand">
                <option value="Fender"> Fender </option>
                <option value="Ibanez"> Ibanez </option>
            </select>
            </div>
            <div class="flex flex-col">
                <label for="brand"> Référence </label>
                <input type="text" name="reference" id="" class="min-w-[500px]"  v-model="formData.name">
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
import jwt_decode from "jwt-decode";
const formData = ref({
    name:'',
    reference:'',
    brand:'',
    price:''
})



// Formulaire d'ajout de guitare
const submitForm= async () => {
    try {
        const token = localStorage.getItem('token');
        const config = {
            headers: {
                Authorization: `Bearer ${token}`
            }
        }
        
        const response = await axios.post('http://localhost:8080/api/guitars/create', formData.value, config);
        alert('Guitare ajoutée');
        console.log(response);
        formData.value = {
            name:'',
            reference:'',
            brand:'',
            price:''
        };
    } catch {
        console.error(response)
    }
}
</script>