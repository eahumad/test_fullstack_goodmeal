<script setup>
import Card from "./Card.vue";
import IconWalk from "./icons/IconWalk.vue";
import IconPin from "./icons/IconPin.vue";
import IconBag from "./icons/IconBag.vue";

const props = defineProps({
  market: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <RouterLink :to="`/${market.id}/${market.name.replaceAll(' ', '-')}`">
    <card class="market-card">
      <div class="header">
        <img
          :src="market?.cover_url"
          class="cover"
          :alt="`Descuentos en ${market?.name}`"
        />
        <div class="data">
          <div class="hours">Hoy 00:20 - 20:00 hrs</div>
          <div class="type-of-delivery">Despacho</div>
        </div>
      </div>
      <div class="logo">
        <img :src="market?.logo_url" :alt="`Rebajas en ${market?.name}`" />
      </div>
      <div class="body">
        <h2>{{ market.name }}</h2>
        <span class="precios-desde"
          >Desde $5.990 <span class="muted">$12.000</span></span
        >

        <div class="icons">
          <div>
            <icon-walk />
            6 min
          </div>

          <div>
            <icon-pin />
            0,51 km
          </div>

          <div>
            <icon-bag />
            0,51 km
          </div>
        </div>
      </div>
    </card>
  </RouterLink>
</template>

<style lang="scss">
a {
  text-decoration: none;
}

.header {
  max-height: 200px;
  overflow: hidden;
  position: relative;

  img.cover {
    position: absolute;
    width: 100%;
    border-radius: var(--radius) var(--radius) 0 0;
  }

  .data {
    padding: 1rem;
    margin-top: 0.3rem;
    margin-bottom: 0.3rem;
    display: flex;
    flex-direction: column;
    gap: 0.3rem;

    .hours,
    .type-of-delivery {
      border-radius: 20px;
      padding: 0.3rem;
      display: block;
      width: min-content;
      white-space: nowrap;
    }

    .hours {
      background-color: var(--color-pink);
      color: var(--color-white);
    }

    .type-of-delivery {
      background-color: var(--color-pink-soft);
      color: var(--color-pink);
    }
  }
}

.logo {
  top: 25%;
  right: 10%;
  position: absolute;
  width: 7vw;
  height: 7vw;
  z-index: 3;

  img {
    width: 100%;
    min-height: 100%;
    border-radius: 50%;
  }
}

.body {
  padding: 1rem;

  & * {
    z-index: 2;
  }

  h2 {
    color: var(--color-black);
    max-width: 70%;
  }

  .precios-desde {
    color: var(--color-pink);

    .muted {
      color: var(--color-gray);
      text-decoration: line-through;
    }
  }

  .icons {
    color: var(--color-gray-dark);
    display: flex;
    justify-content: space-between;
  }
}
</style>
