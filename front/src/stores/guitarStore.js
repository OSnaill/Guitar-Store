import axios from "axios";
import { defineStore } from 'pinia';
import { ref, toRaw } from "vue"; 

export const useGuitarStore = defineStore('guitarStore', {

    state: () => {
        return {
            guitars : [],
            singleGuitar: Object,
            isLoaded: false,
            cart: localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')) : [],
            cartCount: 0,
            cartAmount: 0,
            maxValue: 0,
        }
    },

    actions: {
      async fetchGuitars() {
        const response = await axios.get('http://localhost:8080/api/guitars/')
        this.guitars = response.data
      },
      async fetchAllGuitars() {
        const response = await axios.get('http://localhost:8080/api/guitars/all')
        await this.getMaxGuitarValue()
        this.guitars = response.data
      },
      async fetchFilteredGuitars(brand) {
          const response = await axios.get(`http://localhost:8080/api/guitars/filter?brand=${brand}`)
          console.log('data :',response.data)
          this.guitars = response.data
      },
      async fetchOneGuitar(id) {
        const response = await axios.get(`http://localhost:8080/api/guitars/${id}`)
        this.singleGuitar = await toRaw(response.data[0])
        this.isLoaded = true
        return this.singleGuitar
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
      },
      async getMaxGuitarValue() {
        let max = 0
        this.guitars.forEach(guitar => {
          if(guitar.price >= max)
          {
            max = guitar.price
          }
       
        });
        this.maxValue = max
      },
      async getCartAmount()
      {
        let amount = 0
        this.cart.forEach(element => {
          amount += element.price
        });
        return amount
      }
    },
    getters: {

    }
  })