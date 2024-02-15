import { createRouter, createWebHistory } from 'vue-router'
import LoginView from '../views/LoginView.vue'
import RegisterView from '../views/RegisterView.vue'
import HomeView from '../views/HomeView.vue'
import PostView from '../views/PostView.vue'
import { request } from '@/http/request'


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'index',
      component: LoginView
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
    {
      path: '/my_post',
      name: 'mypost',
      component: HomeView,
    },
    {
      path: '/post',
      name: 'post',
      component: PostView,
    },
    
  ]
})

// router.beforeEach((to, from, next) => {
//   const req = request()
//   console.log(to.name)
//   if ((to.name === 'index' || to.path === '/home') ) {
//     console.log(to.name)
//     next({ name: 'login'})
//     return
//   }
//   else if ((to.path === '/login' || to.path === '/register') && req.isAuthenticated()) {
//     next({ name: 'home'})
//   }
//   else {
//     next()
//   }
  
// })

export default router
