<template>
    <div>
        <user-profile @update-nav="getProfileInfo(); $emit('update-nav')" @resetPassword="toggleFormReset = true" :user_id="user_id" :user="user" :amountOfLeaves="amountOfLeaves"/>
        <form-resetPD v-if="toggleFormReset" @hideForm="toggleFormReset = false" :user_id="user_id" :oldPassword="password" @save-change="saveChange"/>
    </div>
</template>
<script>
import userProfile from "../../../components/user/profile/UserProfileComponent.vue"
import resetPassword from "../../../components/user/profile/ResetPassword.vue"
import axios from "../../../axios-http"
export default {
    components: {
        "user-profile": userProfile,
        'form-resetPD': resetPassword
    },

    props: ['user_id'],

    data() {
        return {
            toggleFormReset: false,
            amountOfLeaves: 0,
            password: null,
            user: {},
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
            axios.put('users/reset_password/'  +  this.user_id,newPwd)
            alert("Reset password success")
            this.toggleFormReset = false;
        },
    },

    watch: {
        user_id() {
            this.getProfileInfo();
        }
    },

    created() {
        if (this.user_id) {
            this.getProfileInfo();
        }
    }
}

</script>




