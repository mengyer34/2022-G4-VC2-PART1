<template>
    <user-profile @resetPassword="toggleFormReset = true" :user="user" :amountOfLeaves="amountOfLeaves"/>
    <form-resetPD v-if="toggleFormReset" @hideForm="toggleFormReset = false" :oldPassword="password" @save-change="saveChange"/>
</template>
<script>
import userProfile from "../../../components/user/profile/UserProfileComponent.vue"
import resetPassword from "../../../components/user/profile/ResetPassword.vue"
import axios from "../../../axios-http"
export default {
    inject: ["user_id"],
    components: {
        "user-profile": userProfile,
        'form-resetPD': resetPassword
    },
    data() {
        return {
            toggleFormReset: false,
            user:{},
            amountOfLeaves: 0,
            password: null
        }
    },
        methods:{
            getProfileInfo(){
                axios.get('users_leaves/'+this.user_id).then((res) => {
                    this.user = res.data.data;
                    this.password = this.user.password
                    this.amountOfLeaves = this.user.leaves.length;
                })
            },
            saveChange(newPwd){
                axios.put(url + 'users/reset_password/'  +  this.user_id,newPwd)
                alert("Reset password success")
                this.toggleFormReset = false;
            },
        },
        mounted() {
            this.getProfileInfo();
        },
}

</script>




