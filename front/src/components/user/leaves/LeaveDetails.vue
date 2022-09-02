<template>
        <div class="bg-[#000000b9] fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex ">
            <div class="relative my-6 mx-auto max-w-3xl w-[50%] rounded bg-white">
                <!--content-->
                <div
                class="relative flex flex-col w-full outline-none focus:outline-none ">
                <!--header-->
                <div class="p-2 flex items-center justify-between bg-primary text-white rounded-t">
                    <p></p>
                    <h3 class="text-2xl font-semibold uppercase ">
                    Request Information
                    </h3>
                    <svg xmlns="http://www.w3.org/2000/svg" @click="$emit('closeStudentDetail')" class="h-6 w-6 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <!--body-->
                <div class="m-auto w-[90%] mt-2 mb-2">
                    <table class="border-collapse border w-full">
                    <tbody>
                        <tr class="hover:bg-[#F5F5F5]">
                            <td class="border p-3 text-center text-[13px] text-[#6E6E6E]">From</td>
                            <td class="border  p-3 text-center w-[96%] text-[13px] uppercase font-bold">{{leave.user.first_name}} {{leave.user.last_name}}</td>
                        </tr>
                        <tr class="hover:bg-[#F5F5F5]">
                                <td class="border p-3 text-center text-[13px] text-[#6E6E6E]">Class</td>
                                <td class="border  p-3 text-center w-[96%] text-[13px] uppercase">{{leave.user.class}} {{leave.user.generation}}</td>
                        </tr>
                        <tr class="hover:bg-[#F5F5F5]">
                                <td class="border p-3 text-center text-[13px] text-[#6E6E6E]">Student Id</td>
                                <td class="border  p-3 text-center w-[96%] text-[13px] uppercase">{{leave.user.personal_id}} </td>
                        </tr>
                        <tr class="hover:bg-[#F5F5F5]">
                                <td class="border p-3 text-center text-[13px] text-[#6E6E6E]">Reason</td>
                                <td class="border  p-3 text-center w-[96%] text-[13px] font-bold">{{leave.reason}}</td>
                        </tr>
                        <tr class="hover:bg-[#F5F5F5]">
                                <td class="border text-center p-3 text-[13px] text-[#6E6E6E]">Leave Type</td>
                                <td class="border text-center p-3 w-[96%]  text-[13px] text-[#FF6B00]">{{leave.leave_type}} </td>
                        </tr>
                        <tr class="hover:bg-[#F5F5F5]">
                                <td class="border text-center p-3 text-[13px] text-[#6E6E6E]">Start Date</td>
                                <td class="border text-center p-3 w-[96%]  text-[13px] text-[#6E6E6E]">{{leave.end_date}} ({{leave.start_time}})</td>
                        </tr>
                        <tr class="hover:bg-[#F5F5F5]">
                            <td class="border text-center p-3 text-[13px] text-[#6E6E6E]">End Date</td>
                            <td class="border text-center p-3 w-[96%]  text-[13px] text-[#6E6E6E]">{{leave.end_date}} ({{leave.end_time}})</td>
                        </tr>
                        <tr class="hover:bg-[#F5F5F5]">
                            <td class="border text-center p-3 text-[13px] text-[#6E6E6E]">Status</td>
                            <td class="border text-center p-3 w-[96%]  text-[13px]   " :class="leave.status === 'Approved' ? 'text-[#0081CA]' : 'text-[#FF0000]'">{{leave.status}}</td>
                        </tr>
                        <tr class="hover:bg-[#F5F5F5]">
                            <td class="border text-center p-3 text-[13px] text-[#6E6E6E]">Duration</td>
                            <td class="border text-center p-3 w-[96%]  text-[13px]  text-[#FF6B00]">{{leave.duration}} <span v-if="leave.duration > 1">days</span><span v-else>day</span></td>
                        </tr>
                        <tr class="hover:bg-[#F5F5F5]">
                            <td class="border text-center p-3 text-[13px] text-[#6E6E6E]">Requestion</td>
                            <td class="border text-center p-3 w-[96%]  text-[13px] text-[#6E6E6E]">{{leave.created_at}}</td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                <!--footer-->
                    <div class="p-4 flex justify-end" v-if="leave.status == 'Pending'">
                        <button @click="isAlert" class="p-2  px-3 bg-red-500 text-white rounded">Reject</button>
                        <button @click="isApprove" class="p-2 ml-2 px-3 bg-primary text-white rounded">Approve</button>
                    </div>
                </div>

                <reject-dialog v-if="alert" @closePopup="alert=false" @reject="reject" />
            </div>
        </div>
</template>

<script>
import axios from '../../../axios-http.js'
import RejectAlert from '../../Respone/RejectAlert.vue'

export default ({
    emits: ['close', 'getLeaves'],
    props: {
        leave: Object
    },

    components: {
        'reject-dialog': RejectAlert,
    },

    data() {
        return {
            alert: false,
        }
    },
    methods: {
        isAlert() {
            this.alert = true;
        },
        isApprove() {
            let status = {status: "Approved"};
            this.$emit('update-status');
            this.$emit('hide');
            axios.put("leaves/status/" + this.leave.id, status).then(() => {
                this.$emit('close');
                this.$emit('get-leaves');
            });
        },

        reject() {
            let status = {status: "Rejected"};
            this.$emit('update-status', 'rejected');
            this.$emit('hide');
            axios.put("leaves/status/" + this.leave.id, status).then(() => {
                this.$emit('close');
                this.$emit('get-leaves');

            });
            this.alert = false;
        }
    }
    
})

</script>
