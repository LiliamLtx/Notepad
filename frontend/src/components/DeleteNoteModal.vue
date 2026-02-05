<template>
  <div class="modal-backdrop-custom">
    <div class="card delete-card shadow-lg">
      <div class="text-center">
        <i class="fa-solid fa-triangle-exclamation text-warning fs-1 mb-3"></i>
        <h5 class="text-info">{{ note.title }}</h5>
        <p class="text-secondary">
          Are you sure you want to delete this note?
        </p>
      </div>

      <div class="d-flex justify-content-center mt-4">
        <button @click="$emit('close')" class="btn btn-primary px-4 mx-2">
          No
        </button>
        <button @click="confirmDelete" class="btn btn-danger px-4 mx-2">
          Yes
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import api from '@/services/api'

const props = defineProps({
  note: Object
})

const emit = defineEmits(['deleted', 'close'])

async function confirmDelete() {
  try {
    await api.delete(`/notes/${props.note.id}`)
    emit('deleted', props.note.id)
  } catch (e) {
    alert('Erro ao deletar nota')
  }
}
</script>

<style scoped>
.modal-backdrop-custom {
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,0.4);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 999;
}

.delete-card {
  width: 400px;
  padding: 2rem;
  border-radius: 12px;
}
</style>
