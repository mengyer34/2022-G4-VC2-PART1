<template>
    <div class="w-full sm:px-6 mt-24">
        <div>
            <div class="w-full flex bg-white shadow items-center justify-around py-3 rounded bg-opacity-70">
                <img class="w-[20%] scale-x-[-1]" src="../../../assets/banner-img.png" alt="">
                <div class="w-[80% text-center">
                    <h1 class="font-bold text-3xl">Welcome to Students Leave Management System!!</h1>
                    <p class="mt-2 text-lg">Manage your student by using this application</p>
                </div>
                <img class="w-[20%]" src="../../../assets/banner_img.png" alt="">
            </div>
            <div>
                <div class="mt-3">
                    <h1 class="font-bold text-lg uppercase mt-6">DATA INFORMATION</h1>
                    <div  class="flex justify-between mt-2">
                        <div @click="viewStudent" class="flex bg-white shadow w-[24%] rounded cursor-pointer bg-opacity-70">
                            <div class="p-3 w-[80%]">
                                <p v-if="!isCounting" class="text-3xl font-semibold">{{users.length}}</p>
                                <counting-data v-else class="mt-1">Calculating...</counting-data>
                                <p class="font-bold">Total Students</p>
                            </div>
                            <div class=" w-[20%] flex items-center justify-center rounded-r pr-1">
                                <img class="w-[90%]" src="../../../assets/students_icon.svg">
                            </div>
                        </div>
                        <div @click="viewLeaves('Pending')" class="flex bg-white shadow w-[24%] bg-opacity-70 rounded cursor-pointer">
                            <div class="p-3 w-[80%]  ">
                                <p v-if="!isCounting" class="text-3xl text-yellow-500 font-semibold">{{getPendingLeave.length}}</p>
                                <counting-data v-else class="mt-1">Calculating...</counting-data>
                                <p class="font-bold">Pending Leaves</p>
                            </div>
                            <div class=" w-[20%] flex items-center justify-center rounded-r">
                                <img class="w-[70%]" src="../../../assets/pending_icon.svg">
                            </div>
                        </div>
                        <div @click="viewLeaves('Approved')" class="flex bg-white shadow w-[24%] rounded cursor-pointer bg-opacity-70">
                            <div class="p-3 w-[80%]">
                                <p v-if="!isCounting" class="text-3xl text-[#62B565] font-semibold">{{getApprovedLeave.length}}</p>
                                <counting-data v-else class="mt-1">Calculating...</counting-data>
                                <p class="font-bold">Approved Leaves</p>
                            </div>
                            <div class="bg-b w-[20%] flex items-center justify-center rounded-r">
                                <img class="w-[70%]" src="../../../assets/approve_icon.svg">
                            </div>
                        </div>
                        <div @click="viewLeaves('Rejected')" class="flex bg-white shadow w-[24%] rounded cursor-pointer bg-opacity-70">
                            <div class="p-3 w-[80%] ">
                                <p v-if="!isCounting" class="text-3xl text-red-500 font-semibold">{{getRejectedLeave.length}}</p>
                                <counting-data v-else class="mt-1">Calculating...</counting-data>
                                <p class="font-bold">Rejected Leaves</p>
                            </div>
                            <div class=" w-[20%] rounded-r flex items-center justify-center">
                                <img class="w-[70%]" src="../../../assets/reject_icon.svg">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <h1 class="font-bold text-lg uppercase mt-6 ">All student's leave History </h1>
                    <div class="bg-white shadow md:px-5 pt-2 md:pt-7 pb-5 overflow-y-auto rounded mt-2 bg-opacity-70">
                        <student-leave :isGettingResources="isGettingResources" :leaves="leaveUserHistory" />
                        <div v-if="leaveUserHistory.length <= 0 && !isGettingResources">
                            <img class="w-32 m-auto mt-3" src="./../../../assets/request_empty.png" alt="Image not found">
                            <p class="text-center">No any histories for now!</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
import axios from '../../../axios-http'
import StudentLeaveList from '../../../components/user/leaves/StudentLeaveList.vue';
import CountingData from './../../../components/animations/CountingData.vue';
export default {

    components: {
        'student-leave': StudentLeaveList,
        'counting-data': CountingData,
    },
    data() {
        return {
            leaveUsers: [],
            users: [],
            leaveUserHistory: [],
            isGettingResources: true,
            isCounting: true,
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
            axios.get("leaves_user").then(res => {
                this.leaveUsers = res.data.data.reverse();
                this.leaveUserHistory = this.leaveUsers.filter((leave)=>leave.status != "Pending")
                this.isGettingResources = false;
                setTimeout(() => {
                    this.isCounting = false;
                }, 650)
            })
        }, 
        getUser() {
            axios.get("users").then(res => {
                this.users = res.data.data;
            })
        }, 

        viewStudent(){
            if (!this.isGettingResources) {
                this.$router.push({name: "students"})
            }
        },
        
        viewLeaves(status){
            if (!this.isGettingResources) {
                this.$router.push("leaves?filter="+status);
            }
        },
    },
    mounted() {
        this.getLeaveUser();
        this.getUser();
    },
}
</script>