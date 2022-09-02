<template>
    <section class="z-[100] fixed left-0 top-0 w-full h-full bg-white">
        <div class="flex h-full items-center bg-slate-400">
            <img src="../../assets/undraw_mobile_login_re_9ntv.svg" alt="logo" class="w-[30%] m-auto ">
            <div class="rounded mb-4 w-[40%] m-auto mt-[30px]">
                <form class="p-5 bg-[#dddddd98] rounded" @submit.prevent="login"  @keyup.enter="login">
                    <img src="../../assets/pnc_logo.png" alt="logo" class="w-[100px] m-auto">
                    <h1 class="text-2xl font-semibold text-center p-1">LOGIN SLMS</h1>
    
                    <div class="mb-6 relative">
                        <label class="block text-gray-700 text-lg  mb-1" for="password">
                            Email *
                        </label>
                        <input
                            class="appearance-none border border-gray-400  rounded w-full py-2 px-3 text-gray-700 mb-1 leading-tight focus:outline-primary focus:shadow-outline"
                            v-model="email"
                            id="email" type="email" placeholder="Email...">
                        <div class="mb-1 relative">
                            <label class="block  text-gray-700 text-lg  mb-1" for="username">
                                Password *
                            </label>
                            <input
                                class="appearance-none border border-gray-400  rounded w-full py-2 px-3 text-gray-700 mb-1 leading-tight focus:outline-primary focus:shadow-outline"
                                v-model="password"
                                id="password" type="password" placeholder="Password...">
                        </div>
                        <div v-if="isInValid" class="text-sm text-red-500 mb-2">
                            Invalid login       
                        </div>
                            <router-link class="inline-block cursor-pointer align-baseline text-sm text-blue-500 hover:text-blue-800" to="forgot">
                                Forgot Password?
                            </router-link>
                    </div>
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white py-2 w-full px-4 rounded focus:outline-primary focus:shadow-outline"
                        type="submit" >
                        Login
                    </button>
                </form>
            </div>

            <loading-show v-if="isLoggingIn">
                Logging in...
            </loading-show>
        </div>
    </section>
</template>

<script>
import axios from '../../axios-http'

import LoadingShow from './../animations/LoadingShow.vue';
export default {
    components: {
        'loading-show': LoadingShow,
    },
    data(){
        return {
            email: null,
            password: null,
            isLoggingIn: false,
            isInValid: false,
        }
    },
    methods: {
        async login(){
            this.isLoggingIn = true;
            this.isInValid = false
            try {
                await axios.post('/account/login', {email: this.email, password: this.password})
                .then(res=>{
                    window.location.reload();
                    this.isLoggingIn = false;
                    this.$cookies.set('slms',res.data.token);
                })
            } catch(err){
                this.isLoggingIn = false;
                this.isInValid = true;
            }
        }
    },
    created(){
        if(this.$cookies.get('slms')){
            this.isLoggingIn = true;
            
            setTimeout(() => {
                this.isLoggingIn = false;
                if(this.$cookies.get('role') == 'admin'){
                    this.$router.push('/dashboard')
                }else{
                    this.$router.push('/')
                }
            }, 1000);
        }
    },
}
</script>

<style>
</style>