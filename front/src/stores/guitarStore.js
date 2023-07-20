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
        const response = await axios.get('https://boris-guitarshop-b.souquiereboris-dev.fr/api/guitars/',{ Proxy: {protocol: 'https'}})
        this.guitars = response.data
      },
      async fetchAllGuitars() {
        const response = await axios.get('https://boris-guitarshop-b.souquiereboris-dev.fr/api/guitars/all')
        await this.getMaxGuitarValue()
        this.guitars = response.data
      },
      async fetchFilteredGuitars(brand) {
          const response = await axios.get(`https://boris-guitarshop-b.souquiereboris-dev.fr/api/guitars/filter?brand=${brand}`)
          console.log('data :',response.data)
          this.guitars = response.data
      },
      async fetchOneGuitar(id) {
        const response = await axios.get(`https://boris-guitarshop-b.souquiereboris-dev.fr/api/guitars/${id}`)
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
        this.guitars.forEach(guitar => {
          if(parseInt(guitar.price) >= this.maxValue)
          {
            console.log('max before', this.maxValue)
            this.maxValue = guitar.price
            console.log('guitar price', guitar.price)
            console.log('max after', this.maxValue)
            
          }

          return this.maxValue + 100
       
        });
        
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