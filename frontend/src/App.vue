<template>
  <TopBar v-if="showTopBar" />
  <RouterView />
  
  
</template>

<script setup>
import { RouterView } from 'vue-router'
import { computed } from 'vue'
import { useRoute } from 'vue-router'

import TopBar from '@/components/TopBar.vue'

const route = useRoute()

const showTopBar = computed(() => {
  return route.meta.requiresAuth === true
})


</script>

<style>
/* Estilos globais para o seu projeto */
body {
  margin: 0;
  padding: 0;
  background-color: #121212; /* O fundo escuro que você usa */
  color: white;
}
</style>