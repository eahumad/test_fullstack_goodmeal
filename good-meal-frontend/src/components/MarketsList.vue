<script setup>
import { ref, onMounted } from "vue";
import MarketCard from "./MarketCard.vue";

const props = defineProps({
  filter: {
    type: String,
    required: true,
  },
});

const markets = ref([]);

onMounted(() => {
  //console.log({ filter });

  fetch(`${import.meta.env.VITE_API_ENDPOINT}markets`)
    .then((response) => response.json())
    .then((data) => (markets.value = data));
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
