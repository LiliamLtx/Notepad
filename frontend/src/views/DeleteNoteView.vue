<template>
  <div class="container mt-5 text-center">
    <h4 class="text-info mb-3">Delete note</h4>
    <p class="text-secondary">Are you sure you want to delete this note?</p>

    <button @click="router.push('/home')" class="btn btn-primary px-5 m-2">
      No
    </button>
    <button @click="confirmDelete" class="btn btn-danger px-5 m-2">
      Yes
    </button>
  </div>
</template>

<script setup>
import { useRoute, useRouter } from 'vue-router'
import api from '@/services/api'

const route = useRoute()
const router = useRouter()
const noteId = route.params.id

async function confirmDelete() {
  try {
    await api.delete(`/notes/${noteId}`)
    router.push('/home')
  } catch (error) {
    console.error(error)
    alert('Erro ao deletar nota')
  }
}
</script>
