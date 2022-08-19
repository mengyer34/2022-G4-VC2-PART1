<template>
    <user-profile @resetPassword="toggleFormReset = true" />
    <form-resetPD v-if="toggleFormReset" @hideForm="toggleFormReset = false" />
</template>
<script>
import userProfile from "../../../components/user/profile/UserProfileComponent.vue"
import resetPassword from "../../../components/user/profile/ResetPassword.vue"
export default {
    components: {
        "user-profile": userProfile,
        'form-resetPD': resetPassword
    },
    data() {
        return {
            toggleFormReset: false
        }
    },
}
</script>




