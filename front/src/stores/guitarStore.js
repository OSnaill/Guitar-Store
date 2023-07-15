import axios from "axios";
import { defineStore } from 'pinia';
import { stringify } from "postcss";
import { toRaw, watch } from "vue";

export const useGuitarStore = defineStore('api', {

    state: () => {
        return {
            guitars : [],
            singleGuitar: Object,
            isLoaded: false,
            cart: localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')) : [],
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
        console.log(JSON.stringify(this.cart))
        localStorage.setItem('cart', JSON.stringify(this.cart))
        this.cartCount++
      },
      async removeFromCart(article, id) {
        this.cart.splice(id, 1);
        localStorage.setItem('cart', JSON.stringify(this.cart))
        this.cartCount--
      }
    },
  })