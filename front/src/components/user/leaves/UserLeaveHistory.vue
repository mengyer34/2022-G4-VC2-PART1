<template>
    <div>
        <div class="bg-white shadow md:px-5 pt-4 md:pt-7 pb-5 overflow-y-auto">
            <table class="w-full whitespace-nowrap">
                <thead>
                    <tr tabindex="0" class="focus:outline-none h-16 w-full text-sm leading-none text-gray-800 border-b-2 border-primary">
                        <th class="font-bold text-center pl-4">Reason</th>
                        <th class="font-bold text-center pl-12">Leave type</th>
                        <th class="font-bold text-center pl-10">Start Date</th>
                        <th class="font-bold text-center pl-10">End Date</th>
                        <th class="font-bold text-center pl-10">Duration</th>
                        <th class="font-bold text-center pl-10">Status</th>
                        <th class="font-bold text-center pl-10">Request Date</th>
                    </tr>
                </thead>
                <tbody v-if="leavesstatus.length > 0" class="w-full">
                    <tr  v-for="leave of leavesstatus" :key="leave" tabindex="0" class="focus:outline-none h-20 text-sm leading-none text-gray-800 bg-white border-b border-t border-gray-100">
                        <td class="pl-4 text-center">
                            <div class="flex items-center justify">
                                <p :class="{'font-medium truncate w-16 hover:whitespace-pre-wrap  hover:absolute hover:font-normal hover:bg-gray-200 hover:p-3 hover:rounded hover:w-2/12':leave.reason.length > 8}">{{leave.reason}}</p>
                            </div>
                        </td>
                        <td class="pl-12 text-center">
                            {{leave.leave_type}}
                        </td>
                        <td class="pl-10">
                            {{leave.start_date}} ({{leave.start_time}})
                        </td>
                        <td class="pl-10">
                            {{leave.end_date}} ({{leave.end_time}})
                        </td>
                        <td class="pl-10 text-center">
                            <p class="font-medium">{{leave.duration}}</p>
                        </td>
                        <td class="pl-10">
                            <div class="flex items-center">
                                <span class="px-4 py-2 rounded-full text-white" :class="iscolor(leave)">{{leave.status}}</span>
                            </div>
                        </td>
                        <td class="pl-10">
                            <div class="flex items-center">
                                <span>{{leave.created_at}}</span>
                            </div>
                        </td>
                    </tr>
                </tbody>

                <tbody v-if="isGettingResources">
                    <tr>
                        <td colspan="7" class="p-2 text-center">
                            <getting-resources>Loading leaves...</getting-resources>
                        </td>
                    </tr>
                </tbody>

                <tbody v-if="!isGettingResources && leavesstatus.length <= 0 && leaves.length > 0">
                    <tr>
                        <td colspan="7" class="p-2 text-center">
                            <img class="w-32 m-auto" src="./../../../assets/no_requests_found.png" alt="Image not found">
                            <p>No leaves Found!</p>
                        </td>
                    </tr>
                </tbody>

                <tbody v-if="!isGettingResources && leaves.length <= 0">
                    <tr>
                        <td colspan="7" class="p-2 text-center">
                            <img class="w-32 m-auto" src="./../../../assets/request_empty.png" alt="Image not found">
                            <h1 class="text-stone-500">No any leaves for now!</h1>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <requestForm />
    </div>
</template>

<script>

    import requestForm from "../request/RequestForm.vue"
    import GettingResources from './../../animations/GettingResources.vue';
    export default {
        components: {
            'getting-resources': GettingResources,
        },

        props: ['leaves', 'status', 'type', 'isGettingResources'],
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
        },
    }
</script>