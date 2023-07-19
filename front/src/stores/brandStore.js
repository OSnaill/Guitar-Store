import axios from "axios";
import { defineStore } from 'pinia';

export const useBrandStore = defineStore('brandStore', {

    state: () => {
        return {
            brands : [],
        }
    },

    actions: {
      async fetchBrands() {
        const response = await axios.get('https://boris-guitarshop-b.souquiereboris-dev.fr/api/brand/')
        this.brands = response.data
      },

    },
  })