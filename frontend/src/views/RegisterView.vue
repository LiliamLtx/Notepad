<template>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6 col-sm-8">
        <div class="card p-5 shadow">

          <!-- Logo -->
          <div class="text-center mb-4">
            <img src="/assets/images/logo.png" alt="Notes logo" class="img-fluid" style="max-height: 80px" />
          </div>

          <div class="text-center mb-4">
          <h1> Cadastro </h1>
          </div>
          <!-- FORM -->
          <form @submit.prevent="cadastrar">
            <!--  Nome -->
            <div class="mb-3">
              <label class="form-label">Nome</label>
              <input type="text" name="text_name" class="form-control bg-dark text-info" v-model="text_name"
                required />
            </div>

            <!-- Email -->
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="text_username" class="form-control bg-dark text-info" v-model="text_username"
                required />
            </div>

            <!-- Senha -->
            <div class="mb-3">
              <label class="form-label">Senha</label>
              <input type="password" name="text_password" class="form-control bg-dark text-info" v-model="text_password"
                required />
            </div>
            <!-- Botão -->
            <button type="submit" class="btn btn-secondary w-100">Cadastrar</button>
            <!-- Erro -->
            <div v-if="error" class="alert alert-danger text-center">{{ error }}</div>
          </form>

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
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import api from '@/services/api'

const router = useRouter()


const text_name = ref('')
const text_username = ref('')
const text_password = ref('')
const error = ref(null)
const loading = ref(false)

const cadastrar = async () => {
  error.value = null
  loading.value = true

  try {
    const response = await api.post('/cadastro', {
      text_name: text_name.value,
      text_username: text_username.value,
      text_password: text_password.value
    })

    // salva token
    router.push('/login')

  } catch (err) {
    const statusCode = err.response?.status;
    const data = err.response?.data;

    if (statusCode === 422) {
        const validationErrors = data.errors;
        if (validationErrors) {
            // Transforma o objeto de erros em uma string legível
            error.value = Object.values(validationErrors).flat().join(' ');
        } else {
            error.value = data.message;
        }
    }
     else {
        error.value = data?.message || 'Erro ao processar cadastro';
    }
  } finally {
    loading.value = false
  }
}
</script>