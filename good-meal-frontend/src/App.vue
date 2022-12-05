<script setup>
import { RouterLink, RouterView } from "vue-router";
import IconHome from "./components/icons/IconHome.vue";
import IconList from "./components/icons/IconList.vue";
import IconPerson from "./components/icons/IconPerson.vue";
</script>

<template>
  <nav>
    <RouterLink to="/"><IconHome /></RouterLink>
    <RouterLink to="/about"><IconList /></RouterLink>
    <RouterLink to="/comptest"><IconPerson /></RouterLink>
  </nav>

  <main>
    <RouterView />
  </main>
</template>
