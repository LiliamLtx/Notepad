import axios from 'axios'
import router from '@/router';

const api = axios.create({
  baseURL: 'http://127.0.0.1:8000/api',
  headers: {
    Accept: 'application/json'
  }
})

// Interceptor: envia token automaticamente
api.interceptors.request.use(config => {
  const token = localStorage.getItem('token')
  if (token) {
    config.headers.Authorization = `Bearer ${token}`
  }
  return config
})

api.interceptors.response.use(
  response => response,
  error => {
    if (error.response?.status === 401) {
      localStorage.removeItem('token')
    }
      if (router.currentRoute.value.name !== 'login' && router.currentRoute.value.name !== 'cadastro') {
        router.push('/login')
      }
    return Promise.reject(error)
  }
)

export default api
