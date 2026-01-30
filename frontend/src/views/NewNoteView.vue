<template>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col">

        <!-- TopBar -->
        <TopBar />

        <!-- Header -->
        <div class="row">
          <div class="col">
            <p class="display-6 mb-0">NEW NOTE</p>
          </div>
          <div class="col text-end">
            <button class="btn btn-outline-danger" @click="goHome">
              <i class="fa-solid fa-xmark"></i>
            </button>
          </div>
        </div>

        <!-- Form -->
        <form @submit.prevent="submit">
          <div class="row mt-3">
            <div class="col">

              <div class="mb-3">
                <label class="form-label">Note Title</label>
                <input
                  type="text"
                  class="form-control bg-primary text-white"
                  v-model="form.title"
                />
                <div v-if="errors.title" class="text-danger">
                  {{ errors.title }}
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label">Note Text</label>
                <textarea
                  class="form-control bg-primary text-white"
                  rows="5"
                  v-model="form.text"
                ></textarea>
                <div v-if="errors.text" class="text-danger">
                  {{ errors.text }}
                </div>
              </div>

            </div>
          </div>

          <div class="row mt-3">
            <div class="col text-end">
              <button
                type="button"
                class="btn btn-primary px-5"
                @click="goHome"
              >
                <i class="fa-solid fa-ban me-2"></i>Cancel
              </button>

              <button type="submit" class="btn btn-secondary px-5 ms-2">
                <i class="fa-regular fa-circle-check me-2"></i>Save
              </button>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import { useRouter } from 'vue-router'
import api from '@/services/api'

const router = useRouter()

const form = reactive({
  title: '',
  text: ''
})

const errors = reactive({})

function goHome() {
  router.push('/home')
}

async function submit() {
  errors.title = null
  errors.text = null

  try {
    await api.post('/notes', {
      title: form.title,
      text: form.text
    })

    router.push('/home')
  } catch (error) {
    if (error.response?.status === 422) {
      const apiErrors = error.response.data.errors
      errors.title = apiErrors.title?.[0]
      errors.text = apiErrors.text?.[0]
    }
  }
}
</script>
