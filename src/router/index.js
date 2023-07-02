import { createRouter, createWebHistory } from 'vue-router'
import LoginView from "@/views/LoginView.vue";
import LandingView from "@/views/LandingView.vue";
import LocationView from "@/views/LocationView.vue";
import axios from "axios";


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: LoginView
    },
      {
          path:'/landing',
          name:'index',
          component: LandingView
      },
      {
          path:'/destination',
          name:'location',
          component:LocationView
      }
  ]
})
//Before every nagivation

// Make sure that the token that we are using it goes to the serve and lets us know of the validation of the token
router.beforeEach((to,from)=> {
    if (to.name === 'home') {
        return true;
    }
    if(!localStorage.getItem('token')){
        return{
            name:"home"
        }
    }
});
//     checkTokenAuthenticity()
// })
// const checkTokenAuthenticity = ()=>{
//     axios.get('http://localhost:8000/api/user',{
//         headers :{
//             Authorization:`Bearer ${localStorage.getItem('token')}`
//         }
//     })
//         .then((response)=>{
//
//         })
//         .catch((error)=>{
//             localStorage.removeItem('token')
//             router.push({
//                 name:'home',
//             })
//         })
// }
export default router
