<script setup>
import {  onMounted } from "vue";
import { Tabs, Tab } from "vue3-tabs-component";
import MarketsList from "./MarketsList.vue";

import { useMarketStore } from '../stores/market'

const marketStore = useMarketStore()

</script>

<template>
  <div class="markets">
    <tabs class="tabs">
      <tab name="Con Stock">
        <MarketsList :markets="marketStore.getMarketsWithStock" ></MarketsList>
      </tab>
      <tab name="Sin Stock">
        <MarketsList :markets="marketStore.getMarketsNoStock"></MarketsList>
      </tab>
      <tab name="Favoritos">
        <MarketsList :markets="marketStore.getMarketsFavs"></MarketsList>
      </tab>
    </tabs>
  </div>
</template>

<style>
@media (min-width: 429px) {
  .markets {
    padding: 2rem;
  }
}
</style>
