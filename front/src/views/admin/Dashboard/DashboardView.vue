<template>
    <div class="w-full sm:px-6 mt-24">
        <div>
            <div class="flex bg-white shadow items-start p-3 rounded">
                <img class="w-56" src="https://www.lakservices.com/LakAdminPanal/dist/img/banner-img.png" alt="">
                <div>
                    <h1 class="font-bold text-3xl">Welcome to Students Leave Management System!!</h1>
                    <p class="mt-2 text-lg">Manage your student by using this application</p>
                </div>
            </div>
            <div>
                <div class="mt-3">
                    <h1 class="font-bold text-lg uppercase mt-6 inline-block p-2 bg-white shadow rounded">DATA INFORMATION</h1>
                    <div  class="flex justify-between mt-2">
                        <div @click="viewStudent" class="flex bg-white shadow w-[24%] rounded cursor-pointer">
                            <div class="p-3 w-[80%]">
                                <p class="text-3xl font-semibold">{{users.length}}</p>
                                <p class="font-bold">Total Students</p>
                            </div>
                            <div class="bg-blue-500 w-[20%] flex items-center justify-center rounded-r">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5  text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex bg-white shadow w-[24%] rounded cursor-pointer">
                            <div class="p-3 w-[80%]  ">
                                <p class="text-3xl text-yellow-500 font-semibold">{{getPendingLeave.length}}</p>
                                <p class="font-bold">Pending Leaves</p>
                            </div>
                            <div class="bg-blue-500 w-[20%] flex items-center justify-center rounded-r">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex bg-white shadow w-[24%] rounded cursor-pointer">
                            <div class="p-3 w-[80%]">
                                <p class="text-3xl text-green-700 font-semibold">{{getApprovedLeave.length}}</p>
                                <p class="font-bold">Approved Leaves</p>
                            </div>
                            <div class="bg-blue-500 w-[20%] flex items-center justify-center rounded-r">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex bg-white shadow w-[24%] rounded cursor-pointer">
                            <div class="p-3 w-[80%] ">
                                <p class="text-3xl text-red-600 font-semibold">{{getRejectedLeave.length}}</p>
                                <p class="font-bold">Rejected Leaves</p>
                            </div>
                            <div class="bg-blue-500 w-[20%] rounded-r flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <h1 class="font-bold text-lg uppercase mt-6 inline-block p-2 bg-white shadow rounded">All student's leave History </h1>
                    <div class="bg-white shadow md:px-5 pt-2 md:pt-7 pb-5 overflow-y-auto rounded mt-2">
                        <student-leave :leaveUserHistory="leaveUserHistory" />
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
import axios from '../../../axios-http.js'
import StudentLeaveList from '../../../components/StudentLeaveList.vue'
const url = 'http://localhost:8000/api/'
export default {

    components: {
        'student-leave': StudentLeaveList,
    },
    data() {
        return {
            leaveUsers: [],
            users: [],
            leaveUserHistory: []

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
                this.leaveUserHistory = this.leaveUsers.filter((leave)=>leave.status != "Pending")
            })
        }, 
        getUser() {
            axios.get(url + "users").then(res => {
                this.users = res.data.data;
            })
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