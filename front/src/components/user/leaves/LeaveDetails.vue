<template>
        <div class="bg-[#00000080]  overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex ">
            <div class="relative my-6 mx-auto max-w-3xl w-[40%] rounded bg-white">
                <!--content-->
                <div
                class="relative flex flex-col w-full outline-none focus:outline-none ">
                <!--header-->
                <div class="p-2">
                    <h3 class="text-2xl font-semibold text-center text-[#0081CA]">
                    Request Information
                    </h3>
                </div>
                <!--body-->
                <div class="m-auto w-[90%] mt-2">
                    <table class="border-collapse border w-full">
                    <tbody>
                        <tr class="hover:bg-[#F5F5F5]">
                            <td class="border p-3 text-center text-[13px] text-[#6E6E6E]">From</td>
                            <td class="border  p-3 text-center w-[96%] text-[13px] uppercase">{{leave_detail.user.first_name}} {{leave_detail.user.last_name}}</td>
                        </tr>
                        <tr class="hover:bg-[#F5F5F5]">
                                <td class="border p-3 text-center text-[13px] text-[#6E6E6E]">Class</td>
                                <td class="border  p-3 text-center w-[96%] text-[13px] uppercase">{{leave_detail.user.class}} {{leave_detail.user.generation}}</td>
                        </tr>
                        <tr class="hover:bg-[#F5F5F5]">
                                <td class="border p-3 text-center text-[13px] text-[#6E6E6E]">Student Id</td>
                                <td class="border  p-3 text-center w-[96%] text-[13px] uppercase">{{leave_detail.user.personal_id}} </td>
                        </tr>
                        <tr class="hover:bg-[#F5F5F5]">
                                <td class="border p-3 text-center text-[13px] text-[#6E6E6E]">Reason</td>
                                <td class="border  p-3 text-center w-[96%] text-[13px] font-bold">{{leave_detail.reason}}</td>
                        </tr>
                        <tr class="hover:bg-[#F5F5F5]">
                                <td class="border text-center p-3 text-[13px] text-[#6E6E6E]">Leave Type</td>
                                <td class="border text-center p-3 w-[96%]  text-[13px] text-[#FF6B00]">{{leave_detail.leave_type}} </td>
                        </tr>
                        <tr class="hover:bg-[#F5F5F5]">
                                <td class="border text-center p-3 text-[13px] text-[#6E6E6E]">Start Date</td>
                                <td class="border text-center p-3 w-[96%]  text-[13px] text-[#6E6E6E]">{{leave_detail.end_date}} ({{leave_detail.start_time}})</td>
                        </tr>
                        <tr class="hover:bg-[#F5F5F5]">
                            <td class="border text-center p-3 text-[13px] text-[#6E6E6E]">End Date</td>
                            <td class="border text-center p-3 w-[96%]  text-[13px] text-[#6E6E6E]">{{leave_detail.end_date}} ({{leave_detail.end_time}})</td>
                        </tr>
                        <tr class="hover:bg-[#F5F5F5]">
                            <td class="border text-center p-3 text-[13px] text-[#6E6E6E]">Status</td>
                            <td class="border text-center p-3 w-[96%]  text-[13px]   " :class="leave_detail.status === 'Approved' ? 'text-[#0081CA]' : 'text-[#FF0000]'">{{leave_detail.status}}</td>
                        </tr>
                        <tr class="hover:bg-[#F5F5F5]">
                            <td class="border text-center p-3 text-[13px] text-[#6E6E6E]">Duration</td>
                            <td class="border text-center p-3 w-[96%]  text-[13px]  text-[#FF6B00]">{{leave_detail.duration}} <span v-if="leave_detail.duration > 1">days</span><span v-else>day</span></td>
                        </tr>
                        <tr class="hover:bg-[#F5F5F5]">
                            <td class="border text-center p-3 text-[13px] text-[#6E6E6E]">Requestion</td>
                            <td class="border text-center p-3 w-[96%]  text-[13px] text-[#6E6E6E]">{{leave_detail.created_at}}</td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                <!--footer-->
                </div>
                <div class="flex items-center justify-end p-6 border-0 relative  w-full outline-none focus:outline-none">
                    <button
                    class="p-2 px-6 hover:bg-gray-500 bg-gray-300 rounded font-bold "
                        type="button" @click="$emit('closeStudentDetail')">
                        Close
                    </button>
                </div>
            </div>
        </div>
</template>

<script>
export default ({
    props: {
        leave_detail: Object
    }
})

</script>
