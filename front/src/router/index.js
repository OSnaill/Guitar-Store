import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/LoginView.vue'
import AdminView from '../views/AdminView.vue'
import EditView from '../views/EditView.vue'
import SearchView from '../views/SearchView.vue'
import jwt_decode from "jwt-decode";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView,
    },
    {
      path: '/back-office',
      name: 'back-office',
      component: AdminView
    },
    {
      path: '/edit/:id',
      name: 'edit',
      component: EditView
    },
    {
      path: '/search',
      name: 'search',
      component: SearchView
    }
  ]
});
router.beforeEach((to, from)=> {


  // Check si le token est expiré, dans ce cas on l'enlève du local storage
  if(localStorage.getItem('token'))
  {
    const currentDate= new Date()
    const dateToCompare = currentDate.getTime()
    // console.log(jwt_decode(localStorage.getItem('token')).exp * 1000 < dateToCompare)
    // console.log(currentDate.getDate(dateToCompare))
    if(jwt_decode(localStorage.getItem('token')).exp * 1000 < dateToCompare)
    {
      localStorage.removeItem('token')
    }
  }
  if (to.name == 'back-office' && !localStorage.getItem('token')) 
  {
    return { name: 'login' }
  }
})

export default router
