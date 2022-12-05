<script setup>
import { Tabs, Tab } from "vue3-tabs-component";
import MarketsList from "./MarketsList.vue";
import MarketFilters from "../enums/MarketFilters";
</script>

<template>
  <div class="markets">
    <tabs class="tabs">
      <tab name="Con Stock">
        <MarketsList :filter="MarketFilters.withStock"></MarketsList>
      </tab>
      <tab name="Sin Stock">
        <MarketsList :filter="MarketFilters.noStock"></MarketsList>
      </tab>
      <tab name="Favoritos">
        <MarketsList :filter="MarketFilters.favs"></MarketsList>
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
