<template>
    <div class="w-full sm:px-6 mt-24">
        <h1 class="text-3xl font-semibold my-9">STUDENT LEAVES</h1>
        <search-bar />
        <div class="mt-6">
            <div class="bg-white shadow md:px-5 pt-2 md:pt-7 pb-5 overflow-y-auto rounded">
                <div class="flex justify-between mb-2">
                    <h1 class="font-bold text-lg">REQUEST LIST</h1>
                    <div class="flex">
                        <label for="filter" class="mx-3 font-medium"><span class="text-red-600">*</span>Filter by:</label>
                        <select v-model="status" name="" id="filter" class="shadow-md w-52 rounded border border-stone-400 p-[0.4rem] focus:outline-none focus:border-primary">
                            <option value="All">All</option>
                            <option value="Rejected">Rejected</option>
                            <option value="Approved">Approved</option>
                            <option value="Pending">Pending</option>
                            <option value="Sick">Sick</option>
                            <option value="Family's events">Family's Event</option>
                        </select>
                    </div>
                </div>
                <student-leave :leaves="leaves" />
            </div>
        </div>
    </div>
</template>

<script>
import axios from '../../../axios-http.js'
import StudentLeaveList from '../../../components/StudentLeaveList.vue'
import SearchBar from './../../../components/search/SearchBar.vue';
const url = 'http://localhost:8000/api/'

export default {
    components: {
        'student-leave': StudentLeaveList,
        'search-bar': SearchBar,
    },

    data() {
        return {
            leaves: [],
        }
    },

    methods: {
        getLeaves() {
            axios.get(url + "leaves_user").then(res => {
                this.leaves = res.data.data.reverse();
            })
        },
    },

    created() {
        this.getLeaves();
    },
}
</script>