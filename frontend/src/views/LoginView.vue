<template>
<div class="container mt-5">
  <div class="row justify-content-center">
      <div class="col-md-6 col-sm-8">
        <div class="card p-5 shadow">

          <!-- Logo -->
          <div class="text-center mb-4">
            <img
              src="/assets/images/logo.png"
              alt="Notes logo"
              class="img-fluid"
              style="max-height: 80px"
            />
          </div>

          <!-- FORM -->
          <form @submit.prevent="login">
            <!-- Email -->
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="text_username" class="form-control bg-dark text-info" v-model="text_username" required/>
            </div>

            <!-- Senha -->
            <div class="mb-3">
              <label class="form-label">Senha</label>
              <input type="password" name="text_password" class="form-control bg-dark text-info" v-model="text_password" required/>
            </div>
            <!-- Botão -->
            <button type="submit" class="btn btn-secondary w-100">Login</button>
            <!-- Erro -->
            <div v-if="error" class="alert alert-danger text-center">{{ error }}</div>
          </form>

          <!-- Cadastro -->
          <div class="text-center mt-3">
            Não tem uma conta?
            <router-link
              to="/cadastro"
              class="btn btn-link p-0"
            >
              Cadastre-se
            </router-link>
          </div>

          <!-- Footer -->
          <div class="text-center text-secondary mt-4">
            <small>&copy; {{ new Date().getFullYear() }} Notes</small>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>


<script setup>
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import api from '@/services/api'

const router = useRouter()

const text_username = ref('')
const text_password = ref('')
const error = ref(null)

const login = async () => {
  error.value = null

  try {
    const response = await api.post('/login', {
      text_username: text_username.value,
      text_password: text_password.value
    })

    // salva token
    localStorage.setItem('token', response.data.token)

    // redireciona
    router.push('/home')
  } catch (err) {
    error.value = err.response?.data?.message || 'Erro ao logar'
  }
}
</script>

