<template>
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
      <div class="bg-blue-600 h-24 flex items-center rounded">
        <img class="mx-auto h-12 w-auto" src="http://static.lightspeedvt.com/themer2-vt/1246/images/vt__skillshop-logo-header2x-C52EFFC3-A262-0A17-5720EEB3A0DC2628.png" alt="Workflow">

      </div>
        <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
            Enter Your System's Information Below<br>
            
        </h2>
      <form class="mt-8" @submit.prevent="submit">
        <input type="hidden" name="remember" value="true">
        <div class="rounded-md shadow-sm">
          <div>
            <input 
            v-model="form.sysid" 
            aria-label="sysid" 
            id="sysid" 
            name="sysid" 
            type="text" 
            required 
            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5" placeholder="System ID">
          </div>
          <div class="-mt-px">
            <input 
            v-model="form.apikey" 
            aria-label="apikey" 
            id="apikey" 
            name="apikey" 
            type="password" 
            required 
            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5" placeholder="API Key">
          </div>
        </div>
  
        <div class="mt-6">
          <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-600 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
              <svg class="h-5 w-5 text-white-500 group-hover:text-white-400 transition ease-in-out duration-150" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
              </svg>
            </span>
            Continue
          </button>
        </div>
        
        <div v-if="res" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative my-4" role="alert">
          <strong class="font-bold">Error: {{ res.code }}</strong>
          <br>
          <span class="block sm:inline" v-if="res.message">{{ res.message }}</span>
        </div>
        
        <div v-if="Object.keys(errors).length > 0" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative my-4" role="alert">
          <strong class="font-bold">Error:</strong>
          <br>
          <span class="block sm:inline" v-if="errors.sysid">The system id is required</span>
          <br>
          <span class="block sm:inline" v-if="errors.apikey">The api key is required</span>
        </div>

      </form>
    </div>
  </div>
</template>

<script>

import CryptoJS from 'crypto-js';
const key = 'mooapznTlQ7Ut84z5DMaR3WxwRzxuRX7iptx8EXf0fY=';
const iv = 'toPet898818'

    export default {
      props:{
        res: null,
        errors: null
      },
        data(){
          return{
          
            form:{
              sysid: null,
              apikey: null,
            }
              
          }
        },
        methods: {
          aesEncrypt(txt) {
            const cipher = CryptoJS.AES.encrypt(txt, CryptoJS.enc.Utf8.parse(key), {
              iv: CryptoJS.enc.Utf8.parse(iv),
              mode: CryptoJS.mode.CBC
            })

            return cipher.toString()
          },
          submit(event){
            const subForm = {};
            subForm['encSysid'] = this.aesEncrypt(this.form.sysid);
            subForm['encApikey'] = this.aesEncrypt(this.form.apikey);

            this.$inertia.get('/skillshop/form', subForm);
            //this.$inertia.get('/skillshop/form', [this.form.sysid,this.form.apikey]);
          },
            
        }
    };
</script>