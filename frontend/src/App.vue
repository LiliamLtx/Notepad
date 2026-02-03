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

