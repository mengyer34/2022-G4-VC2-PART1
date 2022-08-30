<template>
    <div>
        <profile-view :user="user" @getUser="getUser" @update-nav="$emit('update-nav')" @resetPassword="toggleFormReset = true" />
    </div>
</template>

<script>
    import axios from '../../../axios-http'
    import AdminProfile from "../../../components/profileAdmin/AdminProfileView.vue"
    export default {
        components: {
            'profile-view': AdminProfile,
        },

        data(){
            return {
                user: {},
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
        },
        mounted() {
            this.getUser()
        }
    }
</script>