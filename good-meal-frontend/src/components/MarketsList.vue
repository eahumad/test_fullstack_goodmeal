<script setup>

import MarketCard from "./MarketCard.vue";

const props = defineProps({
  markets: {
    type: Array,
    required: true,
  }


});


</script>

<template>
  <div class="market-list">
    <market-card v-for="(market, idx) in markets" :key="idx" :market="market">
      {{ filter }}
      {{ market }}
    </market-card>
  </div>
</template>

<style lang="scss">
.market-list {
  padding-top: 1rem;
  width: 100%;
  display: grid;
  gap: 1rem;
  grid-template-columns: repeat(auto-fill, minmax(19rem, 1fr));
}
</style>
