<template>
  <div class="row">
    <div class="col">
      <div class="card p-4">
        <div class="row">
          <div class="col">
            <h4 class="text-info">{{ note.title }}</h4>

            <!--editar para mostrar ultima edição-->
            <small class="text-secondary">
              <strong>{{ formattedDate }}</strong>
            </small>
          </div>

          <div class="col text-end">
            <button
              class="btn btn-outline-secondary btn-sm mx-1"
              @click="onEdit"
            >
              <i class="fa-regular fa-pen-to-square"></i>
            </button>

            <button
              class="btn btn-outline-danger btn-sm mx-1"
              @click="onDelete"
            >
              <i class="fa-regular fa-trash-can"></i>
            </button>
          </div>
        </div>

        <hr>

        <p class="text-secondary">{{ note.text }}</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useRouter } from 'vue-router'

const props = defineProps({
  note: {
    type: Object,
    required: true
  }
})

const emit = defineEmits(['delete'])

const router = useRouter()

const formattedDate = computed(() => {
  const date =
    props.note.updated_at !== props.note.created_at
      ? props.note.updated_at
      : props.note.created_at

  return new Date(date).toLocaleString('en-US', {
    month: 'long',
    day: 'numeric',
    year: 'numeric',
    hour: 'numeric',
    minute: '2-digit'
  })
})

function onEdit() {
  router.push({
    name: 'edit',
    params: { id: props.note.id }
  })
}

function onDelete() {
  router.push({
    name: 'delete',
    params: { id: props.note.id }
  })
}
</script>
