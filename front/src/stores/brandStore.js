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
        const response = await axios.get('http://localhost:8080/api/brand/')
        this.brands = response.data
      },

    },
  })