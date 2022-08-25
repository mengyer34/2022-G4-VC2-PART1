<template>
    <div>
        <user-profile @user-updated="$emit('user-updated')" @resetPassword="toggleFormReset = true" :user="user" :amountOfLeaves="amountOfLeaves"/>
        <form-resetPD v-if="toggleFormReset" @hideForm="toggleFormReset = false" :oldPassword="password" @save-change="saveChange"/>
    </div>
</template>
<script>
import userProfile from "../../../components/user/profile/UserProfileComponent.vue"
import resetPassword from "../../../components/user/profile/ResetPassword.vue"
import axios from "axios"
const url = "http://127.0.0.1:8000/api/"
export default {
    inject: ["user_id"],
    props: ['user'],
    components: {
        "user-profile": userProfile,
        'form-resetPD': resetPassword
    },
    data() {
        return {
            toggleFormReset: false,
            amountOfLeaves: 0,
            password: null
        }
    },
        methods:{
            getProfileInfo(){
                axios.get(url + 'users_leaves/'+this.user_id).then((res) => {
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




