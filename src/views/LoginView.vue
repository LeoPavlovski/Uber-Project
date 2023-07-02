<template>
<div class="pt-16">
  <h1 class="text-3xl font-semibold mb-4">Enter your phone number/loginCode</h1>
<!--  function-->
<!--  Preventing any default manners by the -->
  <form v-if="!waitingOnVerification" action="#" @submit.prevent="handleLogin">
    <div class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left">
      <div class="bg-white px-4 py-5 sm:p-6">
 <!--Validation here-->
        <div>
          <input type="text" v-maska data-maska="+389########" name="phone" v-model="credentials.phone" id="phone" placeholder="1 (234) 567-8910" class="mt-1 block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm">
        </div>
      </div>
      <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
        <button type="submit" @submit.prevent="handleLogin" class="inline-flex justify-center rounded-md border border-transparent bg-black pl-5 pr-5 pt-3 pb-3 text-white" >
          Continue
        </button>
      </div>
    </div>
  </form>
    <form action="#" @submit.prevent="handleVerification" v-else>
        <div class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left">
            <div class="bg-white px-4 py-5 sm:p-6">
                <!--Validation here-->
                <div>
                    <input type="text" v-maska data-maska="######" name="login_code" v-model="credentials.login_code" id="login_code" placeholder="134512" class="mt-1 block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm">
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                <button type="submit" @submit.prevent="handleVerification" class="inline-flex justify-center rounded-md border border-transparent bg-black pl-5 pr-5 pt-3 pb-3 text-white" >
                   Verify
                </button>
            </div>
        </div>
    </form>
        </div>

</template>

<script setup>
//Functionality
import {vMaska} from 'maska'
import {computed, onMounted, reactive, ref} from "vue"
import axios from 'axios'
//router to navigate the user to various routes

const router = useRouter();

import router from "@/router";
// difference is that we are going to access only the phone
const phone = ref(null);
const waitingOnVerification = ref(false);

// Life cycle
onMounted(()=>{
    //if the user has been logged in.
    if(localStorage.getItem('token')){
        router.push({
            name:'landingView'
        })
    }
});

//Computed : generate reactive properties based on the values on different values

//storing the phone
//better approach
const credentials = reactive({
  phone:null,
  login_code:null
})
const formatedCredentials = computed(()=>{
    return {
        phone:credentials.phone.replaceAll(' ', '').replace('(','').replace(')','').replace('-',''),
        login_code : credentials.login_code
    }
})

const handleLogin =()=>{
  //instead of the console.log
  //do axios.post (route to the api)
  axios.post('http://localhost:8000/api/login',{
    formatedCredentials
})
      .then((response)=>{
        console.log(response.data)
          waitingOnVerification.value=true;
      }).catch((error)=>{
        console.log(error)
        alert(error.response.data.message)
      });
  // console.log(data.phone)
}
const handleVerification = ()=>{
    axios.post('http://localhost:8000/api/login/verify', {
        formatedCredentials
    })
        .then((response)=>{
            console.log(response.data); //auth token
            localStorage.setItem('token',response.data) // Token from the console.
            //Determine if they want to be a driver or a passenger
            // TODO determine if the user has been already been logged in to the page
            router.push({
                name:'landingView'
            })
        })
        .catch((error)=>{
            alert(error.response.data.message)
        });
}
</script>

<style>

</style>
