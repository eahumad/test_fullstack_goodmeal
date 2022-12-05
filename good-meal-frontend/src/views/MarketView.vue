<script setup>
import { ref, onMounted } from 'vue'
import { useMarketStore } from '../stores/market'
import IconPin from "../components/icons/IconPin.vue";
import IconClock from "../components/icons/IconClock.vue";
import { Tabs, Tab } from "vue3-tabs-component";

const props = defineProps({
  id: {
    type: String,
    required: true,
  },
});

const marketId = ref(0)
const marketStore = useMarketStore()
const getMarketById = marketStore.getMarketById;


onMounted(async () => {
  marketId.value = parseInt(props.id)
})


</script>

<template>
  <div class="info">
    <div class="cover">
      <img :src="getMarketById(marketId)?.cover_url" class="cover" :alt="`Descuentos en ${getMarketById(marketId)?.name}`" />
    </div>
    <div class="logo">
      <img :src="getMarketById(marketId)?.logo_url" :alt="`Rebajas en ${getMarketById(marketId)?.name}`" />
    </div>

    <h2>Acerca de la tienda</h2>
    <a><icon-pin /> {{getMarketById(marketId)?.address}} </a>
    <a><icon-clock/>Hoy de 09:00 a 21 hrs</a>
  </div>
  <div class="products">
    <tabs>
      <tab name="Cat">

      </tab>
    </tabs>
  </div>
  <div class="cart">
  </div>
</template>


<style>

</style>