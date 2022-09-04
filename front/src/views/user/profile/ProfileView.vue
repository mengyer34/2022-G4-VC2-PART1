<template>
    <div>
        <success-alert v-if="sms_success" :content="'Reset password successfully'" />
        <user-profile :isReloadingProfile="isReloadingProfile" @reload-profile="isReloadingProfile = true"  @update-nav="getProfileInfo(); $emit('update-nav')" @resetPassword="toggleFormReset = true" :user_id="user_id" :user="user" :amountOfLeaves="amountOfLeaves"/>
        <form-resetPD v-if="toggleFormReset" :role="role" @hideForm="toggleFormReset = false" :user_id="user_id" @save-change="saveChange"/>
    </div>
</template>
<script>
import userProfile from "../../../components/user/profile/UserProfileComponent.vue"
import resetPassword from "../../../components/user/profile/ResetPassword.vue"
import successAlert from "../../../components/user/profile/alerts/SuccessAlert.vue"
import axios from "../../../axios-http"
export default {
    components: {
        "user-profile": userProfile,
        'form-resetPD': resetPassword,
        'success-alert': successAlert
    },

    props: ['user_id','role'],

    data() {
        return {
            toggleFormReset: false,
            amountOfLeaves: 0,
            user: {},
            sms_success: false,
            isReloadingProfile: false,
        }
    },

    methods:{
        getProfileInfo(){
            axios.get('users_leaves/'+this.user_id).then((res) => {
                this.user = res.data.data;
                this.password = this.user.password
                this.amountOfLeaves = this.user.leaves.length;
                this.isReloadingProfile = false;
            })
        },
        saveChange(){
            this.toggleFormReset = false;
            this.successAlert()
        },
        successAlert() {
            this.sms_success = true
            setTimeout(() => {
                this.sms_success = false;
            }, 2000);
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




