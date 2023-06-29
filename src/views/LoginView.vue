<template>
<div class="pt-16">
  <h1 class="text-3xl font-semibold mb-4">Enter your phone number</h1>
  <form action="#">
    <div class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left">
      <div class="bg-white px-4 py-5 sm:p-6">
<!--Validation here-->
        <div>
          <input type="text" v-maska data-maska="+###########" name="phone" id="phone" placeholder="1 (234) 567-8910" class="mt-1 block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm">
        </div>
      </div>
      <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
        <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-black pl-5 pr-5 pt-3 pb-3 text-white" >
          Continue
        </button>
      </div>
    </div>
  </form>
</div>

</template>

<script setup>
//Functionality
import {vMaska} from 'maska'
</script>

<style>

</style>