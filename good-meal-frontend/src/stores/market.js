import { ref, computed } from "vue";
import { defineStore } from "pinia";

export const useMarketStore = defineStore("market",  {
  state: () => ({
    markets : []
  }),

  actions: {
    async loadMarkets() {
      await fetch(`${import.meta.env.VITE_API_ENDPOINT}markets`)
      .then((response) => response.json())
      .then((data) => (this.markets = data));
    }
  },

  getters: {
    getMarkets(state) {
      return state.markets;
    },
    getMarketsWithStock(state) {
      return state.markets;
    },
    getMarketsNoStock(state) {
      return state.markets;
    },
    getMarketsFavs(state) {
      return state.markets;
    },
    getMarketById(state) {
      return (id) => state.markets.find(market => market.id === id)
    }
  }

  
})