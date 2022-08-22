<template>
    <div class="w-full sm:px-6 mt-24">
        <div>
            <div class="flex bg-slate-300 items-start p-3 rounded">
                <img class="w-56" src="https://www.lakservices.com/LakAdminPanal/dist/img/banner-img.png" alt="">
                <div>
                    <h1 class="font-bold text-3xl">Welcome to Students Leave Management System!!</h1>
                    <p class="mt-2 text-lg">Manage your student by using this application</p>
                </div>
            </div>
            <div>
                <div class="mt-3">
                    <h1 class="font-bold text-lg">DATA INFORMATION</h1>
                    <div  class="flex justify-between mt-2">
                        <div @click="viewStudent" class="flex bg-slate-300 w-[24%] rounded">
                            <div class="p-3 w-[80%]">
                                <p class="text-3xl font-semibold">{{users.length}}</p>
                                <p>Total Students</p>
                            </div>
                            <div class="bg-blue-500 w-[20%] flex items-center justify-center rounded-r">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-[1.35rem] w-6" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 2a1 1 0 00-1 1v1a1 1 0 002 0V3a1 1 0 00-1-1zM4 4h3a3 3 0 006 0h3a2 2 0 012 2v9a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2zm2.5 7a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm2.45 4a2.5 2.5 0 10-4.9 0h4.9zM12 9a1 1 0 100 2h3a1 1 0 100-2h-3zm-1 4a1 1 0 011-1h2a1 1 0 110 2h-2a1 1 0 01-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex bg-slate-300 w-[24%] rounded">
                            <div class="p-3 w-[80%]">
                                <p class="text-3xl text-green-700 font-semibold">{{getApprovedLeave.length}}</p>
                                <p>Approved Leaves</p>
                            </div>
                            <div class="bg-blue-500 w-[20%] flex items-center justify-center rounded-r">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex bg-slate-300 w-[24%] rounded">
                            <div class="p-3 w-[80%]  ">
                                <p class="text-3xl text-yellow-500 font-semibold">{{getPendingLeave.length}}</p>
                                <p>Pending Leaves</p>
                            </div>
                            <div class="bg-blue-500 w-[20%] flex items-center justify-center rounded-r">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex bg-slate-300 w-[24%] rounded">
                            <div class="p-3 w-[80%] ">
                                <p class="text-3xl text-red-600 font-semibold">{{getRejectedLeave.length}}</p>
                                <p>Rejected Leaves</p>
                            </div>
                            <div class="bg-blue-500 w-[20%] rounded-r flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="bg-slate-300 shadow md:px-5 pt-2 md:pt-7 pb-5 overflow-y-auto rounded">
                        <h1 class="font-bold text-lg">LATEST LEAVE APPLICATION</h1>
                        <table class="w-full whitespace-nowrap">
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
                                <tr v-for="leaveUser of leaveUsers" :key="leaveUser" tabindex="0" class="focus:outline-none h-12 text-sm leading-none text-gray-800 hover:bg-gray-200 border-b border-t border-gray-100">
                                    <td class="text-center">
                                        {{leaveUser.user.last_name}} {{leaveUser.user.first_name}}
                                    </td>
                                    <td class="text-center">
                                        {{leaveUser.leave_type}}
                                    </td>
                                    <td class="text-center">
                                        {{leaveUser.created_at}}
                                    </td>
                                    <td class="text-center">
                                        <div class="flex justify-center items-center">
                                            <span class="px-2 py-[5px] rounded-full text-white" :class="iscolor(leaveUser)">{{leaveUser.status}}</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <button class="bg-blue-500 py-2 px-4 rounded text-white">Details</button>
                                    </td>
                                </tr>
                            </tbody>
                            <!-- <tbody v-else>
                                <tr>
                                    <td colspan="7" class="p-2 text-center">No leaves Found!!</td>
                                </tr>
                            </tbody> -->
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
import axios from '../../../axios-http.js'
// import UserLeaveHistory from '../../../components/user/leaves/UserLeaveHistory.vue'
const url = 'http://localhost:8000/api/'
export default {

    components: {

    },
    data() {
        return {
            leaveUsers: [],
            users: [],
        }
    },
    computed: {
        getApprovedLeave() {
            return this.leaveUsers.filter(leaveUser => leaveUser.status === "Approved");
        },
        getPendingLeave() {
            return this.leaveUsers.filter(leaveUser => leaveUser.status === "Pending");
        },
        getRejectedLeave() {
            return this.leaveUsers.filter(leaveUser => leaveUser.status === "Rejected");
        },
    },
    methods: {
        getLeaveUser() {
            axios.get(url + "leaves_user").then(res => {
                this.leaveUsers = res.data.data.reverse();
            })
        }, 
        getUser() {
            axios.get(url + "users").then(res => {
                this.users = res.data.data;
            })
        }, 
        iscolor(leaveuser) {
            if (leaveuser.status == "Approved") {
                return "bg-green-500";
            }else if (leaveuser.status == "Pending") {
                return "bg-yellow-400";
            }else if (leaveuser.status == "Rejected") {
                return "bg-red-500";
            }
        },   
        viewStudent(){
            this.$router.push({name: "students"})
        },  
    },
    mounted() {
        this.getLeaveUser();
        this.getUser();
    },
}
</script>