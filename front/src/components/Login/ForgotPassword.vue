<template>
    <section class="z-[100] fixed left-0 top-0 w-full h-full bg-white">
        <div class="flex h-full items-center bg-slate-400">
            <img src="../../assets/forgot-password.png" alt="logo" class="w-[30%] m-auto ">
            <div class="rounded mb-4 w-[40%] m-auto mt-[30px] ">
                <form class="p-5 bg-[#dddddd98] shadow rounded">
                    <img src="../../assets/pnc_logo.png" alt="logo" class="w-[100px] m-auto">
                    <h1 class="text-1xl font-semibold text-center p-1">Forgot Password</h1>
                    <div class="mb-1 relative">
                        <label class="block text-gray-700 text-lg  mb-1" for="password">
                            Email *
                        </label>
                        <input
                            class=" appearance-none rounded w-full py-2 px-3 text-gray-700 mb-1 focus:outline-primary focus:shadow-outline"
                            v-model="email"
                            id="email" type="email" placeholder="Email...">
                    </div>
                    <div v-if="is_not_found" class="mb-6 text-red-500 text-sm">Email not found</div>
                    <button
                        class="bg-blue-500 mt-6 hover:bg-blue-700 text-white py-2 w-full px-4 rounded focus:outline-primary focus:shadow-outline"
                        @click="handleSubmit"
                        type="button" >
                        Submit
                    </button>
                </form>
            </div>
        </div>
    <reset-password v-if="is_found_email" @submit-change="submitNewPassword" />
    </section>
</template>

<script>

import axios from "../../axios-http"
import resetPassword from './ResetForgotPassword.vue';
export default({
    components: {
        'reset-password': resetPassword
    },
    data(){
        return {
            email: '',
            is_not_found: false,
            is_found_email: false,
        }
    },
    methods: {
        handleSubmit(){
            axios.post('forgot',{email: this.email}).then((res)=>{
                let status = res.data;
                this.is_not_found = false
                if (!status.success){
                    this.is_not_found = true;
                }else{
                    this.is_found_email = true;
                }
            });
        },
        submitNewPassword(newPwd){
            this.is_found_email = false;
            let new_password = {email: this.email, new_password: newPwd}
            axios.post('resetForgot',new_password).then((res)=>{
                console.log(res);
                this.$router.push({name: 'login'})
            });
        }
    }
})
</script>
