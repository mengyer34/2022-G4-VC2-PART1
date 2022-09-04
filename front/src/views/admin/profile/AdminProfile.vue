<template>
    <div>
        <success-alert v-if="sms_success" :content="'Reset password successfully'" />
        <profile-view :isReloadingProfile="isReloadingProfile" @reload-profile="isReloadingProfile = true" :user="user" @getUser="getUser" @update-nav="$emit('update-nav')" @resetPassword="toggleFormReset = true" />
        <form-resetPD v-if="toggleFormReset" @hideForm="toggleFormReset = false" :user_id="user.id" @save-change="saveChange"/>
    </div>
</template>

<script>
    import axios from '../../../axios-http'
    import AdminProfile from "../../../components/profileAdmin/AdminProfileView.vue"
    import resetPassword from "../../../components/user/profile/ResetPassword.vue"
    import successAlert from "../../../components/user/profile/alerts/SuccessAlert.vue"
    export default {
        components: {
            'profile-view': AdminProfile,
            'form-resetPD': resetPassword,
            'success-alert': successAlert,
        },

        data(){
            return {
                user: {},
                toggleFormReset: false,
                sms_success: false,
                isReloadingProfile: false,
            }
        },

        computed: {
            getImage() {
                if (this.user.profile_image != undefined) {
                    return this.$axios.defaults.baseURL +'storage/image/' + this.user.profile_image;
                } else {
                    return "";
                }
            },
        },

        methods: {
            getUser() {
                axios.get('account/find').then(res=> {
                    this.isReloadingProfile = false;
                    this.user = res.data.data;
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
        mounted() {
            this.getUser()
        }
    }
</script>