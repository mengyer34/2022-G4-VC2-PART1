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
                            :class="{'bg-red-100 border-red-400':is_not_fill_email}"
                            @change="is_not_fill_email=false"
                            v-model="email"
                            id="email" type="email" placeholder="Email...">
                            <svg v-if="isInValid" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute top-[40px] right-3 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        <div class="mb-1 relative">
                            <label class="block  text-gray-700 text-lg  mb-1" for="username">
                                Password *
                            </label>
                            <input
                                class="appearance-none border border-gray-400  rounded w-full py-2 px-3 text-gray-700 mb-1 leading-tight focus:outline-primary focus:shadow-outline"
                                @change="is_not_fill_password=false"
                                :class="{'bg-red-100 border-red-400':is_not_fill_password}"
                                v-model="password"
                                id="password" type="password" placeholder="Password...">
                            <svg v-if="isInValid" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute top-[40px] right-3 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div v-if="isInValid" class="text-sm text-red-500 mb-2 bg-red-300 p-2 rounded">
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
import encryptData from '../../helper/encryptData';
export default {
    components: {
        'loading-show': LoadingShow,
    },
    data(){
        return {
            email: '',
            password: '',
            isLoggingIn: false,
            isInValid: false,
            is_not_fill_email: false,
            is_not_fill_password: false,
        }
    },
    methods: {
        async login(){
            if (this.checkFormValidation()){
                // this.isLoggingIn = true;
                this.isInValid = false
                try {
                    await axios.post('/account/login', {email: this.email, password: this.password})
                    .then(res=>{
                        // this.isLoggingIn = false;
                        const token_encrypt = encryptData(res.data.token, 'my_token')
                        const role_encrypt = encryptData(res.data.role, 'my_role')
                        this.$cookies.set('slms',token_encrypt);
                        this.$cookies.set('role',role_encrypt);
                        window.location.reload();
                    })
                } catch(err){
                    this.isLoggingIn = false;
                    this.isInValid = true;
                    this.is_not_fill_email = true;
                    this.is_not_fill_password = true;
                }
            }
        },
        checkFormValidation(){
            this.is_not_fill_email = false;
            if (this.email.trim() == ''){
                this.is_not_fill_email = true;
            }
            this.is_not_fill_password = false;
            if (this.password.trim() == ''){
                this.is_not_fill_password = true;
            }

            let sms = true;
            if (this.is_not_fill_email || this.is_not_fill_password){
                sms = false;
            }
            return sms;
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