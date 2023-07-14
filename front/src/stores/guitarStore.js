import axios from "axios";
import { defineStore } from 'pinia';
import { toRaw, watch } from "vue";

export const useGuitarStore = defineStore('api', {

    state: () => {
        return {
            guitars : [],
            singleGuitar: Object,
            isLoaded: false,
            cart: [],
            cartCount: 0
        }
    },
  
    actions: {
      async fetchGuitars() {
        const response = await axios.get('http://localhost:8080/api/guitars/')
        this.guitars = response.data
      },
      async fetchOneGuitar(id) {
        const response = await axios.get(`http://localhost:8080/api/guitars/${id}`)
        this.singleGuitar = await toRaw(response.data[0])
        this.isLoaded = true
      },
      async pushToCart(article) {
        this.cart.push(article)
        this.cartCount++
      },
      async removeFromCart(article, id) {
        this.cart.splice(id, 1);
        this.cartCount--
      }
    },
  })