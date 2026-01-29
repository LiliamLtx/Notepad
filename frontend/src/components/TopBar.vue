<template>
  <div class="row mb-3 align-items-center">
    <!-- Logo -->
    <div class="col">
      <router-link to="/home">
        <img src="/assets/images/logo.png" alt="Notes logo" />
      </router-link>
    </div>

    <!-- Texto central -->
    <div class="col text-center">
      A simple <span class="text-warning">Laravel</span> project!
    </div>

    <!-- Usuário + logout -->
    <div class="col">
      <div class="d-flex justify-content-end align-items-center">
        <span class="me-3">
          <i class="fa-solid fa-user-circle fa-lg text-secondary me-3"></i>
          {{ user?.username }}
        </span>

        <button @click="logout" class="btn btn-outline-secondary px-3">
          Logout
          <i class="fa-solid fa-arrow-right-from-bracket ms-2"></i>
        </button>
      </div>
    </div>
  </div>
  <hr />
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'
import api from '@/services/api' // axios configurado

const router = useRouter()
const user = ref(null)

onMounted(async () => {
  try {
    const { data } = await api.get('/me')
    user.value = data
  } catch (e) {
    // NÃO faz logout aqui
    user.value = null
  }
})

const logout = async () => {
  try {
    await api.post('/logout')
  } catch (e) {
    // ignora erro
  } finally {
    localStorage.removeItem('token')
    router.push('/login')
  }
}
</script>
