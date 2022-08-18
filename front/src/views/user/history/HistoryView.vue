<template>
    <div class="w-full sm:px-6 mt-24">
        <div class="px-4 md:px-10 py-4 md:py-7 bg-gray-200 rounded-tl-lg rounded-tr-lg">
            <div class="sm:flex items-center justify-between">
                <p tabindex="0" class="flex items-center focus:outline-none text-base sm:text-lg md:text-xl lg:text-2xl font-bold leading-normal text-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                    </svg>
                    <span class="ml-1">
                        List all Leaves
                    </span>
                </p>
                <div>
                    <button class="focus:ring-2 focus:ring-offset-2 focus:ring-primary inline-flex sm:ml-3 mt-4 sm:mt-0 items-start justify-start px-3 bg-primary focus:outline-none rounded">
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
            <div class="flex">
                <div class="w-2/12">
                    <label for="filter-status text-sm leading-none text-gray-800"><span class="text-red-600">*</span>Filter by status:</label><br>
                    <select v-model="status" name="" id="filter-status" class="w-9/12 rounded p-1">
                        <option value="All">All</option>
                        <option value="Rejected">Rejected</option>
                        <option value="Approved">Approved</option>
                        <option value="Pending">Pending</option>
                    </select>
                </div>
                <div class="w-2/12">
                    <label for="filter-leave-type font-normal "><span class="text-red-600">*</span>Filter by leaves type:</label><br>
                    <select v-model="type" name="" id="filter-leave-type" class="w-9/12 p-1 rounded">
                        <option value="All">All</option>
                        <option value="Sick">Sick</option>
                        <option value="Family's events">Family's Event</option>
                    </select>
                </div>
            </div>

        </div>
        <leave-history :leaves="leaves" :status="status" :type="type" />
    </div>
</template>


<script>
import axios from '../../../axios-http.js'
import UserLeaveHistory from '../../../components/user/UserLeaveHistory.vue'

export default {
  components: {
    'leave-history': UserLeaveHistory,
  },
  data() {
    return {
        status: "All",
        type: "All",
        leaves: [],
    }
  },
  methods: {
    getLeave() {
        axios.get('http://localhost:8000/api/leaves').then(res => {
            console.log(res);
            this.leaves = res.data.data;
        })
    }
  },
  mounted() {
    this.getLeave();
  }

}
</script>
