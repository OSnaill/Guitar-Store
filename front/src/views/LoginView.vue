<template>
    <main>
        <article class="p-4 border rounded-md border-solid max-w-[400px] m-auto mt-[100px]" v-if="!checkIfConnected()">        
        <h2 class="p-4">Connexion</h2>
        <form @submit="login" class="">
            <div class="flex flex-col p-4">
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" id="username" v-model="credentials.username" required>
            </div>
            <div class="flex flex-col p-4">
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" v-model="credentials.password" required>
            </div>
            <div class="p-4">
            <button type="submit" class="bg-dark-yellow font-bold">Se connecter</button>
            </div>
        </form>
        </article>
        <p v-if="checkIfConnected()" class="text-center mt-[50px] font-bold"> Connecté </p>
    </main>
</template>
<script>
import router from '@/router';

// import { Router } from 'vue-router';

export default {
  data() {
    return {
      credentials: {
        username: '',
        password: ''
      }
    };
  },
  methods: {

    async login(event) {
      event.preventDefault();

      try {
        const response = await fetch('http://localhost:8080/api/login_check', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(this.credentials)
        });

        if (response.ok) {
          const data = await response.json();
          const token = data.token;
          // Faites quelque chose avec le token JWT reçu, comme le stocker dans le local storage ou dans le state Vuex.
          localStorage.setItem('token',token);
          console.log('Token JWT:', token);
          router.push('/')
        } else {
          console.log('Échec de la connexion');
          console.log(this.credentials)
        }
      } catch (error) {
        console.error(error);
      }
    },
    checkIfConnected(){
        if(localStorage.getItem('token'))
        {
            return true;
        }
        return false;
    }
  }
};
</script>