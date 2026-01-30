import { createRouter, createWebHistory } from 'vue-router'
import LoginView from '../views/LoginView.vue'
import RegisterView from '@/views/RegisterView.vue'
import HomeView from '@/views/HomeView.vue'
import NewNoteView from '@/views/NewNoteView.vue'
import EditNoteView from '@/views/EditNoteView.vue'
import DeleteNoteView from '@/views/DeleteNoteView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/login',
      name: 'login',
      component: LoginView,
      meta: { guestOnly: true }
    },
    {
      path: '/cadastro',
      name: 'cadastro',
      component: RegisterView,
      meta: { guestOnly: true }
    },
    {
      path: '/home',
      name: 'home',
      component: HomeView,
      meta: { requiresAuth: true }
    },
    {
      path: '/new',
      name: 'newNote',
      component: NewNoteView,
      meta: { requiresAuth: true }
    },
    {
      path: '/notes/:id/edit',
      name: 'edit',
      component: EditNoteView,
      meta: { requiresAuth: true }
    },
    {
      path: '/notes/:id/edit',
      name: 'delete',
      component: DeleteNoteView,
      meta: { requiresAuth: true }
    }

  ],
})
router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('token')
  const isAuthenticated = !!token

  if (to.meta.requiresAuth && !isAuthenticated) {
    return next('/login')
  }

  if (to.meta.guestOnly && isAuthenticated) {
    return next('/home')
  }

  next()
})


export default router
