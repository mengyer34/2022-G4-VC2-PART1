<template>
    <div>
            <div class="w-full sm:px-6 mt-24">
                <div class="px-4 md:px-10 py-4 md:py-7 bg-gray-200 rounded-tl-lg rounded-tr-lg">
                    <div class="sm:flex items-center justify-between">
                        <p tabindex="0" class="flex mb-6 items-center focus:outline-none text-base sm:text-lg md:text-xl lg:text-2xl font-bold leading-normal text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                            </svg>
                            <span class="ml-1">
                                List all Leaves
                            </span>
                        </p>
                        <div>
                            <button class=" focus:shadow-outline focus:outline-[#0081CA] inline-flex bsm:ml-3 mt-4 sm:mt-0 items-start justify-start px-4 py-2 bg-primary rounded" onclick="window.print()">
                            <p class="text-sm font-medium leading-none text-white flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                                </svg>
                                <span>
                                    Print All
                                </span>
                            </p>
                            </button>
                        </div>
                    </div>
                    <div class="flex items-end ">
                        <div class="w-3/12">
                            <label for="filter-status text-sm leading-none text-gray-800"><span class="text-red-600">*</span>Filter by status:</label><br>
                            <select v-model="status" name="" id="filter-status" class="w-9/12 rounded border p-2 focus:outline-none focus:border-primary">
                                <option value="All">All</option>
                                <option value="Rejected">Rejected</option>
                                <option value="Approved">Approved</option>
                                <option value="Pending">Pending</option>
                            </select>
                        </div>
                        <div class="w-3/12">
                            <label for="filter-leave-type font-normal "><span class="text-red-600">*</span>Filter by leaves type:</label><br>
                            <select v-model="type" name="" id="filter-leave-type" class="w-9/12 p-2 border  rounded focus:outline-none focus:border-primary">
                                <option value="All">All</option>
                                <option value="Sick">Sick</option>
                                <option value="Family's event">Family's Event</option>
                            </select>
                        </div>
                        <div class="w-6/12 text-right">
                            <button class="bg-warning px-4 py-2 rounded text-white hover:bg-orange-400 " @click="showFormRequest">Create New Request</button>
                        </div>
                    </div>

                </div>
                <leave-history :isUpdating="isUpdating" :isGettingResources="isGettingResources" :leaves="leaves" :status="status" :type="type" class="print-container" />
            </div>
            <form-request  v-if="isShow" :user_id="user_id" :user_email="user_email" @close-popup="closePopup" @add-leave="saveChange"/>
            <request-sent v-if="isSentRequest"  @addNewRequest="addNewRequest"/>
    </div>
</template>


<script>
import axios from '../../../axios-http'
import UserLeaveHistory from '../../../components/user/leaves/UserLeaveHistory.vue'
import requestForm from "../newRequest/RequestFormView.vue"
import requestSent from "../../../components/user/request/RequestSentSuccess.vue"
export default {
    props: {
        user_id: Number,
        user_email: String
    },

    components: {
        'leave-history': UserLeaveHistory,
        "form-request": requestForm,
        "request-sent":requestSent,
    },
    data() {
        return {
            status: "All",
            type: "All",
            leaves: [],
            isShow: false,
            isSentRequest: false,
            isGettingResources: true,
            isUpdating: false,
        }
    },
    methods: {
        async getLeave() { 
            await axios.get('users_leaves/' + this.user_id).then(res => {
                this.leaves = res.data.data.leaves.reverse();
                this.isGettingResources = false;
                this.isUpdating = false;
            })
        },
        showFormRequest(){
            this.isShow = true;
        },
        closePopup(){
            this.isShow = false;
        },
        saveChange(newRequest){
            this.isShow = false;
            this.isSentRequest = true;
            this.isUpdating = true;
            axios.post('leaves',newRequest).then((res)=>{
                this.getLeave();
            })
        },
        addNewRequest(){
            this.isSentRequest = false;
        },
        
    },

    watch: {
        user_id() {
            this.getLeave();
        }
    },
    
    mounted() {
        if (this.user_id) {
            this.getLeave();
        }
    },
}
</script>

<style>
    @media print {
        body{
            visibility: hidden;
        }
        .print-container, .print-container * {
            visibility: visible;
        }
        .print-container{
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
        }
    }
</style>