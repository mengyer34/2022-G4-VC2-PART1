<template>
    <section class="z-[100] fixed left-0 top-0 w-full h-full bg-white">
        <div class="flex h-full items-center bg-[rgba(0,0,0,0.4)]">
            <img src="../../assets/undraw_mobile_login_re_9ntv.svg" alt="logo" class="w-[30%] m-auto ">
            <div class="rounded mb-4 w-[40%] m-auto mt-[30px]">
                <form class="p-5 bg-white rounded-b-md">
                    <img src="../../assets/pnc_logo.png" alt="logo" class="w-[60px] m-auto">
                    <h1 class="text-1xl font-semibold text-center p-1">LOGIN SLMS</h1>
    
                    <div class="mb-6 relative">
                        <label class="block text-gray-700 text-lg  mb-1" for="password">
                            Email *
                        </label>
                        <input
                            class="shadow appearance-none border border-gray-400  rounded w-full py-2 px-3 text-gray-700 mb-1 leading-tight focus:outline-primary focus:shadow-outline"
                            v-model="email"
                            id="email" type="email" placeholder="Email...">
                        <div class="mb-1 relative">
                            <label class="block  text-gray-700 text-lg  mb-1" for="username">
                                Password *
                            </label>
                            <input
                                class="shadow appearance-none border border-gray-400  rounded w-full py-2 px-3 text-gray-700 mb-1 leading-tight focus:outline-primary focus:shadow-outline"
                                v-model="password"
                                id="password" type="password" placeholder="Password...">
                        </div>
                        <a class="inline-block cursor-pointer align-baseline text-sm text-blue-500 hover:text-blue-800" to="/forgot">
                            Forgot Password?
                        </a>
                    </div>
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white py-2 w-full px-4 rounded focus:outline-primary focus:shadow-outline"
                        @click="login"
                        type="button" >
                        Login
                    </button>
                </form>
            </div>
        </div>
    </section>
</template>

<script>
import axios from '../../axios-http'

import { useAuth } from '../../stores/useAuth';
import getCookie from '../../helper/getCookie';
export default {
    setup(){
        const authStore = useAuth()
        return { authStore }
    },
    data(){
        return {
            email: null,
            password: null,
        }
    },
    methods: {
        login(){
            axios.post('/account/login', {email: this.email, password: this.password})
            .then(res=>{
                    this.$cookies.set('slms',res.data.token);
                    this.authStore.getUserInfo();
                    console.log(this.$cookies.get('slms'));
                    this.$router.push("/");
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
            })
        }
    },
    created(){
        if(this.$cookies.get('slms')){
            this.$router.push('/')
        }
    },
}
</script>

<style>
</style>