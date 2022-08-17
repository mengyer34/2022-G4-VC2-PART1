<template>
    <div class="mt-6 bg-slate-300 w-9/12 p-6 m-auto rounded-md flex shadow-gray-600 shadow-sm">
        <div class="w-4/12">
            <label for="filter-status"><span class="text-red-600">*</span>Filter by status:</label><br>
            <select v-model="status" name="" id="filter-status" class="w-9/12 rounded p-2">
                <option value="All">All</option>
                <option value="Reject">Reject</option>
                <option value="Approve">Approve</option>
                <option value="Panding">Panding</option>
            </select>
        </div>
        <div class="w-4/12">
            <label for="filter-leave-type"><span class="text-red-600">*</span>Filter by leaves type:</label><br>
            <select v-model="type" name="" id="filter-leave-type" class="w-9/12 p-2 rounded">
                <option value="All">All</option>
                <option value="Family">Family's Event</option>
                <option value="Sick">Sick</option>
                <option value="Homesick">Home Sick</option>
            </select>
        </div>
    </div>
    <div class="w-9/12 m-auto bg-slate-300 rounded-md mt-3 p-8 shadow-sm shadow-gray-600">
        <p>Total: 3</p>
        <div class="mt-4" v-for="leave of leaves" :key="leave">
            <div  class="bg-slate-200 p-6 rounded-md">
                <p>Reason: <span class="font-bold">{{leave.reason}}</span></p>
                <div class="flex justify-between">
                    <div class="">
                        <p>Leave type: <span class="text-orange-500">{{leave.leaveType}}</span></p>
                        <p>From: <span>{{leave.startDate}} - {{leave.endDate}}</span></p>
                    </div>
                    <div class="mr-5">
                        <p>Duration: <span class="font-bold text-red-600">{{leave.duration}}</span></p>
                        <p>Status: <span class="text-orange-500">{{leave.status}}</span></p>
                    </div>

                </div>
            </div>
            <p class="text-end">Requested: <span class="text-gray-500">{{leave.requestedDate}}</span></p>
        </div>
    </div>
    <h1></h1>

</template>

<script>
// @ is an alias to /src
// import BaseCard from '@/components/BaseCard.vue'

export default {
  components: {
  },
  data() {
    return {
        status: "All",
        type: "All",
        leaves: [
            {
                id: 1,
                userId: 1,
                startDate: "February 21, 2022",
                endDate: "February 22, 2022",
                duration: 1,
                requestedDate: "February 20, 2022 7:30 AM",
                leaveType: "Family's Event",
                reason: "Go to hometown",
                status: "Panding",
                isViewed: false
            },
            {
                id: 1,
                userId: 1,
                startDate: "February 21, 2022",
                endDate: "February 22, 2022",
                duration: 1,
                requestedDate: "February 20, 2022 7:30 AM",
                leaveType: "Family's Event",
                reason: "Go to hometown",
                status: "Approve",
                isViewed: false
            },
            {
                id: 1,
                userId: 1,
                startDate: "February 21, 2022",
                endDate: "February 22, 2022",
                duration: 1,
                requestedDate: "February 20, 2022 7:30 AM",
                leaveType: "Family's Event",
                reason: "Go to hometown",
                status: "Reject",
                isViewed: false
            },



         ]
    }
  },
  methods: {

  },

}
</script>
