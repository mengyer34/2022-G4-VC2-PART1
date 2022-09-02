<template>
    <div class="bg-[#000000b9] fixed top-0 w-full h-screen">
        <div class="rounded mb-4 w-5/12 m-auto mt-28">
            <div class="text-center rounded-t-md bg-primary p-2 px-4 text-white ">
                <p class="text-2xl ">Verify Code</p>
            </div>
            <form class="p-5 bg-white rounded-b-md">
                <p>Verify code has been sent to your email</p>
                <p>Please check your email to get it</p>
                <div class="mb-2 mt-2 relative">
                    <label class="block text-gray-700 text-sm font-bold  mb-1" for="username">
                        Type code
                    </label>
                    <input class="shadow appearance-none border border-gray-400 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-primary focus:shadow-outline" :class="{'border-red-500 bg-red-100':is_fill_code }" maxlength="6" id="username" type= "text" v-model="verify_code" placeholder="Verify code.." @change="is_fill_new_password=false">
                </div>
                <div v-if="isMatch" class= "text-red-500 mb-4">{{sms_alert}}</div>
                <div class="flex text-right justify-end">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded focus:outline-primary focus:shadow-outline" type="button" @click="confirmVerifyEmail">
                        Submit
                    </button>
                </div>
            </form>
        </div>
        <loading-show v-if="isVerifying">
                Verifying...
        </loading-show>
    </div>
</template>
<script>
import axios from "../../axios-http"
import LoadingShow from './../animations/LoadingShow.vue';
export default({
    components: {
        'loading-show': LoadingShow,
    },
    emits: ['confirm-code'],
    data() {
        return {
            isMatch: '',
            is_fill_code: false,
            verify_code: '',
            sms_alert: '',
            isVerifying: false,
        }
    },
    methods: {
        async confirmVerifyEmail(){
            this.isVerifying = true;
            if (this.verify_code != ""){
                await axios.post('verifyCode',{verify_code:this.verify_code} ).then((res)=>{
                    this.isMatch = false
                    this.isVerifying = false
                    if (res.data.status){
                        this.$emit('confirm-code');
                    }else{
                        
                        this.isMatch = true;
                        this.sms_alert = res.data.message;
                    }
                })
            }else{
                this.is_fill_code = true;
            }
        },
    }
})
</script>
