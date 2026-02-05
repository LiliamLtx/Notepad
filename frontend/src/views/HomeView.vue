<template>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col">

        <!-- no notes -->
        <div v-if="!hasNotes" class="row mt-5">
          <div class="col text-center">
            <p class="display-6 mb-5 text-secondary opacity-50">
              You have no notes available!
            </p>

            <RouterLink to="/new" id="new" data-test="button-new" class="btn btn-secondary btn-lg p-3 px-5">
              <i class="fa-regular fa-pen-to-square me-3"></i>
              Create Your First Note
            </RouterLink>
          </div>
        </div>

        <!-- notes available -->
        <div v-else>
          <div class="d-flex justify-content-end mb-3">
            <RouterLink to="/new" class="btn btn-secondary px-3">
              <i class="fa-regular fa-pen-to-square me-2"></i>
              New Note
            </RouterLink>
          </div>

          <!-- lista de notas -->
          <NotesCard v-for="note in notes" :key="note.id" :note="note" @delete="openDeleteModal" />
        </div>
      </div>
    </div>
  </div>
  <DeleteNoteModal v-if="noteToDelete" :note="noteToDelete" @close="noteToDelete = null" @deleted="handleDeleted" />
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import { RouterLink } from 'vue-router'
import api from '@/services/api'
import NotesCard from '@/components/NotesCard.vue'
import DeleteNoteModal from '@/components/DeleteNoteModal.vue' //

const notes = ref([])
const noteToDelete = ref(null)

function openDeleteModal(note) {
  noteToDelete.value = note
}

function handleDeleted(id) {
  notes.value = notes.value.filter(n => n.id !== id)
  noteToDelete.value = null
}

onMounted(async () => {
  const { data } = await api.get('/notes')
  notes.value = data
})

const hasNotes = computed(() => notes.value.length > 0)
</script>