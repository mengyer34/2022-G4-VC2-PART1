<template>
    <div class="bg-white shadow md:px-5 pt-4 md:pt-7 pb-5 overflow-y-auto">
        <table class="w-full whitespace-nowrap">
            <thead>
                <tr tabindex="0" class="focus:outline-none h-16 w-full text-sm leading-none text-gray-800 border-b-2 border-primary">
                    <th class="font-normal text-left pl-4">Reason</th>
                    <th class="font-normal text-left pl-12">Leave type</th>
                    <th class="font-normal text-left pl-12">Start Date</th>
                    <th class="font-normal text-left pl-20">End Date</th>
                    <th class="font-normal text-left pl-20">Duration</th>
                    <th class="font-normal text-left pl-16">Status</th>
                    <th class="font-normal text-left pl-16">Request Date</th>
                </tr>
            </thead>
            <tbody v-if="leavesstatus.length > 0" class="w-full">
                <tr  v-for="leave of leavesstatus" :key="leave" tabindex="0" class="focus:outline-none h-20 text-sm leading-none text-gray-800 bg-white hover:bg-gray-200 border-b border-t border-gray-100">
                    <td class="pl-4 cursor-pointer">
                        <div class="flex items-center">
                            <p class="font-medium truncate w-16 hover:whitespace-pre-wrap  hover:absolute hover:font-normal hover:bg-gray-200 hover:p-3 hover:rounded hover:w-2/12">{{leave.reason}}</p>
                        </div>
                    </td>
                    <td class="pl-12">
                        {{leave.leave_type}}
                    </td>
                    <td class="pl-12">
                        {{date_format(leave.start_date)}} ({{leave.start_time}})
                    </td>
                    <td class="pl-20">
                        {{date_format(leave.end_date)}} ({{leave.end_time}})
                    </td>
                    <td class="pl-20">
                        <p class="font-medium">{{leave.duration}}</p>
                    </td>
                    <td class="pl-16">
                        <div class="flex items-center">
                            <span class="px-4 py-2 rounded-full text-white" :class="iscolor(leave)">{{leave.status}}</span>
                        </div>
                    </td>
                    <td class="pl-16">
                        <div class="flex items-center">
                            <span>{{format_date(leave.created_at)}}</span>
                        </div>
                    </td>
                </tr>
            </tbody>
            <tbody v-else>
                <tr>
                    <td colspan="7" class="p-2 text-center">No leaves Found!!</td>
                </tr>
            </tbody>
        </table>
    </div>
    <requestForm />
</template>

<script>
    import moment from 'moment'
    import requestForm from "./RequestForm.vue"
    export default {
        props: ['leaves', 'status', 'type'],
        data() {
            return {
            }
        },
        computed: {
            leavesstatus() {
                if (this.status != "All" && this.type == "All") {
                    return this.leaves.filter(leave => leave.status == this.status);
                }else if (this.status == "All" && this.type != "All") {
                    return this.leaves.filter(leave => leave.leave_type == this.type);
                }else if (this.status != "All" && this.type != "All") {
                    return this.leaves.filter(leave => leave.status == this.status && leave.leave_type == this.type);
                }else {
                    return this.leaves;
                }
            },

        },
        methods: {
            iscolor(leave) {
                if (leave.status == "Approved") {
                    return "bg-green-500";
                }else if (leave.status == "Pending") {
                    return "bg-yellow-400";
                }else if (leave.status == "Rejected") {
                    return "bg-red-500";
                }
            },
            format_date(value){
                if (value) {
                    return moment(String(value)).format('MMMM DD, YYYY hh:mm A')
                }
            },
            date_format(value){
                if (value) {
                    return moment(String(value)).format('MMMM DD, YYYY')
                }
            },
        },
    }
</script>