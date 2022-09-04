<template>
    <div>
        <table class="w-full whitespace-nowrap bg-white bg-opacity-50">
            <thead>
                <tr tabindex="0" class="focus:outline-none h-16 w-full text-sm leading-none text-gray-800 border-b-2 border-primary">
                    <th class="font-bold text-center ">STUDENT NAME</th>
                    <th class="font-bold text-center ">LEAVE TYPE</th>
                    <th class="font-bold text-center ">REQUEST DATE</th>
                    <th class="font-bold text-center ">STATUS</th>
                    <th class="font-bold text-center ">ACTION</th>
                </tr>
            </thead>
            <tbody class="w-full">
                <tr v-if="isUpdating" class="w-full bg-orange-300">
                    <td colspan="7">
                        <updating-data>Updating requests...</updating-data>
                    </td>
                </tr>
                <tr v-for="leave of leaves" :key="leave" tabindex="0" class="focus:outline-none h-12 text-sm leading-none text-gray-800 border-b border-t border-gray-100 bg-opacity-50" :class="{'bg-white text-stone-600 bg-opacity-50': leave.is_admin_seen, 'bg-slate-300 font-medium bg-opacity-50': !leave.is_admin_seen}">
                    <td class="text-center">
                        {{leave.user.last_name}} {{leave.user.first_name}}
                    </td>
                    <td class="text-center">
                        {{leave.leave_type}}
                    </td>
                    <td class="text-center">
                        {{leave.created_at}}
                    </td>
                    <td class="text-center">
                        <div class="flex justify-center items-center">
                            <span v-if="leave.is_admin_seen" class="px-2 py-[5px] rounded-full text-white" :class="iscolor(leave)">{{leave.status}}</span>
                            <span v-else class="px-2 py-[5px] rounded-full text-white bg-orange-400" >New</span>
                        </div>
                    </td>
                    <td class="text-center">
                        <button class="bg-blue-500 hover:bg-blue-600 p-2.5 px-4 rounded text-white" @click="viewLeaveDetail(leave.id)" type="button" data-modal-toggle="defaultModal">
                            View Detail
                        </button>
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
        </table>
        <leave-detail :class="{'hidden': hide}" v-if="isViewDetail" @update-status="$emit('start-updating')" @closeStudentDetail="isViewDetail=false" @hide="hide = true" @close="hide = false; isViewDetail = false; $emit('data-updated')" @get-leaves="$emit('get-leaves')" :leave="leave_detail"/>
    </div>
</template>

<script>
import axios from '../../../axios-http.js'
import leaveDetail from "./LeaveDetails.vue"
import GettingResources from './../../animations/GettingResources.vue';
import UpdatingData from "./../../animations/UpdatingData.vue";

export default {
    props: ['leaves', 'isGettingResources', 'isUpdating'],
    emits: ['getLeaves'],
    components: {
        'leave-detail': leaveDetail,
        'getting-resources': GettingResources,
        'updating-data': UpdatingData,
    },
    data() {
        return {
            isViewDetail: false,
            leave_detail: {},
            hide: false,
        }
    },
    methods: {
        iscolor(leaveuser) {
            if (leaveuser.status == "Approved") {
                return "bg-green-500";
            }else if (leaveuser.status == "Pending") {
                return "bg-yellow-400";
            }else if (leaveuser.status == "Rejected") {
                return "bg-red-500";
            }
        },

        viewLeaveDetail(id){
            this.leave_detail = this.leaves.find((leave)=>leave.id == id);
            this.leaves.forEach((eachLeave, index) => {
                if (eachLeave.id == id) {
                    this.leaves[index].is_admin_seen = true;
                }
            });
            this.isViewDetail = true;
            axios.put("leaves/admin_seen/" + id).then(() => {
                this.$emit('update-nav');
            });
        },

        getLeaves() {
            this.$emit('get-leaves');
        }
    },
}
</script>