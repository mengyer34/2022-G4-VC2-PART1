<template>
    <form-requestion :user_id="user_id" :user_email="user_email" />
</template>
<script>
import requestForm from "../../../components/user/request/RequestForm.vue"
    export default{
        components: {
            "form-requestion": requestForm
        },
        props: {
            user_id: Number,
            user_email: String,
        }
}
</script>