<template>
    <user-profile @resetPassword="toggleFormReset = true" :user="user" :amountOfLeaves="amountOfLeaves"/>
    <form-resetPD v-if="toggleFormReset" @hideForm="toggleFormReset = false" :oldPassword="password" @save-change="saveChange"/>
</template>
<script>
import userProfile from "../../../components/user/profile/UserProfileComponent.vue"
import resetPassword from "../../../components/user/profile/ResetPassword.vue"
import axios from "axios"

export default {
    components: {
        "user-profile": userProfile,
        'form-resetPD': resetPassword
    },
    data() {
        return {
            toggleFormReset: false,
            user:{},
            id : 4,
            amountOfLeaves: 0,
            password: null
        }
    },
        methods:{
            getProfileInfo(){
                axios.get('http://127.0.0.1:8000/api/users_leaves/'+this.id).then((res) => {
                    this.user = res.data.data;
                    this.password = this.user.password
                    this.amountOfLeaves = this.user.leaves.length;
                })
            },
            saveChange(newPwd){
                axios.put('http://127.0.0.1:8000/api/users/reset_password/'+  this.id,newPwd)
                this.toggleFormReset = false;
            },
        },
        mounted() {
            this.getProfileInfo();
        },
}

</script>




