<template>
    <div>
        <profile-view :user="user" @getUser="getUser" @update-nav="$emit('update-nav')" @resetPassword="toggleFormReset = true" />
        <form-resetPD v-if="toggleFormReset" @hideForm="toggleFormReset = false" :user_id="user.id" :oldPassword="password" @save-change="saveChange"/>
    </div>
</template>

<script>
    import axios from '../../../axios-http'
    import AdminProfile from "../../../components/profileAdmin/AdminProfileView.vue"
    import resetPassword from "../../../components/user/profile/ResetPassword.vue"
    export default {
        components: {
            'profile-view': AdminProfile,
            'form-resetPD': resetPassword,
        },

        data(){
            return {
                user: {},
                toggleFormReset: false,
                password: null,
            }
        },

        computed: {
            getImage() {
                if (this.user.profile_image != undefined) {
                    return 'http://127.0.0.1:8000/api/' +'storage/image/' + this.user.profile_image;
                } else {
                    return "";
                }
            },
        },

        methods: {
            getUser() {
                axios.get('account/find').then(res=> {
                    this.user = res.data.data;
                })
            },  
            saveChange(newPwd){
                // axios.put('users/reset_password/'  +  this.user_id,newPwd)
                alert("Reset password success")
                this.toggleFormReset = false;
            },   
        },
        mounted() {
            this.getUser()
        }
    }
</script>