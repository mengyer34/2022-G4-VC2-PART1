<template>
    <div class="w-full sm:px-6 mt-24">
        <h1 class="text-2xl font-semibold my-9">STUDENT LEAVES</h1>
        
        <div class="mt-6">
            <div class="bg-white shadow md:px-5 pt-2 md:pt-7 pb-5 overflow-y-auto rounded bg-opacity-40">
                <h1 class="font-bold text-lg mb-5">REQUEST LIST</h1>
                <div class="flex justify-between mb-2">
                    <!-- search bar -->
                    <search-bar @update-keyword="updateKeyword" />
                    
                    <!-- filter options -->
                    <div class="flex">
                        <div class="flex justify-between">
                            <label for="filter-status" class="mx-3 font-medium"><span class="text-red-600">*</span>Filter by status:</label>
                            <select v-model="filterStatusKey" id="filter-status" class=" w-44 rounded border border-gray-400 p-[0.4rem] focus:border-2 focus:outline-none focus:border-primary">
                                <option value="All">All</option>
                                <option value="Rejected">Rejected</option>
                                <option value="Approved">Approved</option>
                                <option value="Pending">Pending</option>
                            </select>
                        </div>
                        <div class="flex justify-between">
                            <label for="filter-type" class="mx-3 font-medium"><span class="text-red-600">*</span>Filter by leave type:</label>
                            <select v-model="filterLeaveTypeKey" id="filter-type" class=" w-44 rounded border border-gray-400 p-[0.4rem] focus:border-2 focus:outline-none focus:border-primary">
                                <option value="All">All</option>
                                <option value="Sick">Sick</option>
                                <option value="Family's event">Family's Event</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- list all leaves -->
                <student-leave :isUpdating="isUpdating" @start-updating="isUpdating = true" :isGettingResources="isGettingResources" :leaves="filterLeaves" @get-leaves="getLeaves" @update-nav="$emit('update-nav')" />

                <div v-if="leaves.length <= 0 && !isGettingResources" class="flex flex-col items-center mt-8 mb-3">
                    <img class="w-32" src="./../../../assets/request_empty.png" alt="Image not found">
                    <h1 class="text-stone-500">No any requests for now!</h1>
                </div>
                <div v-else-if="filterLeaves.length <= 0 && !isGettingResources" class="flex flex-col items-center mt-8 mb-3">
                    <img class="w-32" src="./../../../assets/no_requests_found.png" alt="Image not found">
                    <h1 class="text-stone-500">No requests found!</h1>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from '../../../axios-http.js'
import StudentLeaveList from '../../../components/user/leaves/StudentLeaveList.vue';
import SearchBar from './../../../components/search/SearchBar.vue';

export default {
    components: {
        'student-leave': StudentLeaveList,
        'search-bar': SearchBar,
    },

    data() {
        return {
            leaves: [],
            filterStatusKey: "All",
            filterLeaveTypeKey: "All",
            keyword: "",
            isGettingResources: true,
            isUpdating: false,
        }
    },

    computed: {
        filterLeaves() {
            let leavesToDisplay = this.leaves;
            if (this.keyword) {
                leavesToDisplay = this.leaves.filter((leave) => (leave.user.first_name+" "+leave.user.last_name).toLowerCase().includes(this.keyword.toLowerCase()));
            }
            if (this.filterStatusKey != "All" && this.filterLeaveTypeKey != "All") {
                leavesToDisplay = leavesToDisplay.filter((leave) => leave.status == this.filterStatusKey && leave.leave_type == this.filterLeaveTypeKey);
            } else if (this.filterStatusKey != "All") {
                leavesToDisplay = leavesToDisplay.filter((leave) => leave.status == this.filterStatusKey);
            } else if (this.filterLeaveTypeKey != "All") {
                leavesToDisplay = leavesToDisplay.filter((leave) => leave.leave_type == this.filterLeaveTypeKey);
            }

            return leavesToDisplay;
        }
    },

    methods: {
        getLeaves() {
            axios.get("/leaves_user").then(res => {
                this.leaves = res.data.data.reverse();
                this.isGettingResources = false;
                this.isUpdating = false;
                this.timer();
            })
        },

        updateKeyword(keyword) {
            this.keyword = keyword;
        },

        timer() {
            let refreshDuration = setTimeout(() => {
                this.getLeaves();
                clearTimeout(refreshDuration);
            }, 10000);
        }
    },

    created() {
        this.getLeaves();
        if (this.$route.query.filter != undefined) {
            this.filterStatusKey = this.$route.query.filter;
        };
    },
}

</script>