<template>
    <div class="bg-white h-auto shadow-md rounded px-8 pt-6 pb-8 mt-28 mb-10 m-auto w-[50%]">
            <form class="form" >
                <p class="text-center text-primary text-2xl uppercase   ">Request Leave Form</p>
                <div class="mb-2 mt-6">
                    <label class="block text-gray-700 text-lg mb-1">
                        Leave Types
                    </label>
                    <div class="inline-block relative w-full">
                    <select class="block appearance-none w-full bg-white border border-gray-400 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:border-primary" v-model="leaveType">
                        <option  value="Family's Event">Family's Event</option>
                        <option value="Got Sick">Got Sick</option>
                        <option value="Brother or sister wedding">Brother or sister wedding</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                    </div>
                </div>
                <div class="mb-2 flex">
                    <div class="w-[50%] m-1">
                        <label class="block text-gray-700 text-lg mb-1">
                            Start Date
                        </label>
                        <input class="shadow appearance-none border border-gray-400 rounded w-full py-2 px-3 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline focus:border-primary" v-model="startDate" type="date">
                    </div>
                    <div class="w-[50%] m-1">
                        <label class="block text-gray-700 text-lg mb-1">
                            Time of the day
                        </label>
                        <div class="inline-block relative w-full">
                        <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:border-primary" v-model="startTime">
                            <option selected >Morning</option>
                            <option>Afternoon</option>
                            <option>Evening</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="mb-2 flex">
                    <div class="w-[50%] m-1">
                        <label class="block text-gray-700 text-lg mb-1">
                            End Date
                        </label>
                        <input class="shadow appearance-none border border-gray-400 rounded w-full py-2 px-3 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline focus:border-primary" v-model="endDate" type="date">
                    </div>
                    <div class="w-[50%] m-1">
                        <label class="block text-gray-700 text-lg mb-1">
                            Time of the day
                        </label>
                        <div class="inline-block relative w-full">
                        <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:border-primary" v-model="endTime">
                            <option selected>Morning</option>
                            <option>Afternoon</option>
                            <option>Evening</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    <h1>Duration: {{calculateDay}} days</h1>
                </div>
                <div class="mb-2 w-full m-1">
                    <label class="block text-gray-700 text-lg mb-1">
                        Cause (Reason)
                    </label>
                    <textarea placeholder="Give your reason here" class="block resize-none h-28 required:border-red-500 border shadow appearance-none border-gray-400 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline focus:border-primary"  v-model="reason" cols="30" rows="10"></textarea>
                </div>
                <div class="flex  w-full">
                    <button class="bg-primary  text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button" @click="requestLeave">
                        Send Request
                    </button>
                </div>
            </form>
    </div>
</template>

<script>

export default({
    data(){
        return {
            leaveType: "",
            startDate: null,
            endDate: null,
            startTime: "",
            endTime: "",
            reason: ""

        }
    },
    methods: {
        requestLeave(){
            let newRequest = {leaveType: this.leaveType, startDate: this.startDate, endDate: this.endDate, startTime: this.startTime, endTime: this.endTime, reason: this.reason}
            console.log(newRequest);
        }
    },
    computed: {
        calculateDay(){
            return this.endDate - this.startDate;
        }
    }
})
</script>
