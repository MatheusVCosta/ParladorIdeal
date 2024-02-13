import { createRouter, createWebHistory } from 'vue-router'
import LoginView from '../views/LoginView.vue'
import RegisterView from '../views/RegisterView.vue'
import HomeView from '../views/HomeView.vue'
import { request } from '@/http/request'


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: '',
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterView
    },
    {
      path: '/home',
      name: 'home',
      component: HomeView,
    },
  ]
})

router.beforeEach((to, from, next) => {
  const req = request()
  if ((to.path === '/' || to.path === '/home') && !req.isAuthenticated()) {
    next({ name: 'login'})
  }
  else if ((to.path === '/login' || to.path === '/register') && req.isAuthenticated()) {
    next({ name: 'home'})
  }
  else {
    next()
  }
  
})

export default router
