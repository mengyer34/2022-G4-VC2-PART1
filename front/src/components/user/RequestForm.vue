<template>
<div class="pop_up p-5 top-0 bg-[#00000080] w-full h-full fixed z-10">
    <div class="modal bg-white h-auto shadow-md rounded px-8 pt-6 pb-8 mt-6 mb-10 m-auto w-[50%] z-10">
        <form class="form" >
            <p class="text-center text-primary text-2xl uppercase">Request Leave Form</p>
            <div class="mb-2 mt-6">
                <label class="block text-gray-700 text-[16px]    mb-1">
                    Leave Types
                </label>
                <div class="inline-block relative w-full">
                    <select class="block appearance-none w-full bg-white border border-gray-400 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:border-primary" :class="{'border-red-500 bg-red-100':isSelectedType }" v-model="leaveType">
                        <option  value="Family's event">Family's Event</option>
                        <option value="Sick">Sick</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>

            </div>
            <div class="mb-2 flex">
                <div class="w-[50%] m-1">
                    <label class="block text-gray-700 text-[16px] mb-1">
                        Start Date
                    </label>
                    <input class="shadow appearance-none border border-gray-400 rounded w-full py-2 px-3 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline focus:border-primary" :class="{'border-red-500 bg-red-100':isStartDate }" v-model="startDate" type="date">

                </div>
                <div class="w-[50%] m-1">
                    <label class="block text-gray-700 text-[16px] mb-1">
                        Time of the day
                    </label>
                    <div class="inline-block relative w-full">
                        <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:border-primary" :class="{'border-red-500 bg-red-100':isStartTime }" v-model="startTime">
                            <option selected value="Morning">Morning</option>
                            <option value="Afternoon">Afternoon</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>

                </div>
            </div>
            <div class="mb-2 flex">
                <div class="w-[50%] m-1">
                    <label class="block text-gray-700 text-[16px] mb-1">
                        End Date
                    </label>
                    <input class="shadow appearance-none border border-gray-400 rounded w-full py-2 px-3 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline focus:border-primary" :class="{'border-red-500 bg-red-100':isEndDate }" v-model="endDate" type="date">

                </div>

                <div class="w-[50%] m-1">
                    <label class="block text-gray-700 text-[16px] mb-1">
                        Time of the day
                    </label>
                    <div class="inline-block relative w-full">
                        <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:border-primary" :class="{'border-red-500 bg-red-100':isEndTime }" v-model="endTime">
                            <option selected value="Morning">Morning</option>
                            <option value="Afternoon">Afternoon</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>

                    </div>
                </div>
            </div>
                <div v-if="inValid" class="alert text-red-600 w-full bg-red-200 p-2 rounded">Invalid Date</div>
            <div class="mb-2 px-1">
                <h1 class="text-lg">Duration: {{calculateDay}}</h1>
            </div>
            <div class="mb-2 w-full m-1">
                <label class="block text-gray-700 text-[16px] mb-1">
                    Drop an reasonable
                </label>
                <textarea placeholder="Give your reason here" :class="{'border-red-500 bg-red-100':isReasonInputted }" class="block resize-none h-16 required:border-red-500 border shadow appearance-none border-gray-400 rounded w-full py-2 px-3 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline focus:border-primary"  v-model="reason" cols="30" rows="10"></textarea>
            </div>
            <div class="flex  w-full mt-6">
                <button class="bg-red-500  text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button" @click="closePopup">
                    Cancel
                </button>
                <button class="bg-primary mx-2 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button" @click="requestLeave">
                    Send Request
                </button>
            </div>
        </form>
    </div>
</div>
</template>

<script>
    // import axios from "../../axios-http"
    import axios from "axios"
    let url = "http://127.0.0.1:8000/api/leaves"
    export default({
        emits:['close-popup'],
        data(){
            return {
                leaveType: "",
                startDate: null,
                endDate: null,
                startTime: null,
                endTime: null,
                reason: "",
                isSelectedType: false,
                isStartDate: false,
                isStartTime: false,
                isEndDate: false,
                isEndTime: false,
                isReasonInputted: false,
                duration: 0,
                inValid: false,

            }
        },
        methods: {
            requestLeave(){
                if (this.checkFormRequest()){
                    let newRequest = {user_id: 1, leave_type: this.leaveType, start_date: this.startDate, end_date: this.endDate, start_time: this.startTime, end_time: this.endTime, reason: this.reason, duration: this.duration}
                    axios.post(url,newRequest);
                    this.closePopup();
                    this.$router.push({name: "histories"})
                }
            },
            checkFormRequest(){
                this.isSelectedType = false;
                if (this.leaveType == ""){
                    this.isSelectedType =  true;
                }

                this.isStartDate = false
                if (this.startDate == null){
                    this.isStartDate = true
                }
                
                this.isStartTime = false
                if (this.startTime == null){
                    this.isStartTime = true
                }
                this.isEndDate = false
                if (this.endDate == null){
                    this.isEndDate = true
                }
                this.isEndTime = false
                if (this.endTime == null){
                    this.isEndTime = true
                }
                this.isReasonInputted = false
                if (this.reason == ""){
                    this.isReasonInputted = true
                }

                if (this.isSelectedType || this.isStartDate || this.isEndDate || this.isStartTime || this.isEndTime || this.isReasonInputted || this.inValid){
                    return false;
                }else{
                    return true;
                }
            },
            closePopup(){
                return this.$emit('close-popup',false);
            }
        },
        computed:{
            calculateDay() {

                
                if ((this.startDate != null && this.endDate != null) &&(this.startTime != null && this.endTime != null)){
                    var start = new Date(this.startDate);
                    var end = new Date(this.endDate);
                    if (end - start > -1){
                        this.inValid = false
                        var diffDays = parseInt((end - start) / (1000 * 60 * 60 * 24), 10); 
                        if (this.startDate == this.endDate){
                            if ((this.startTime == "Morning" && this.endTime == "Morning") || (this.startTime == "Afternoon" && this.endTime == "Afternoon")){
                                this.duration = 0.5
                            } else{
                                this.duration = 1
                            }
                        } else {
                            if (this.startTime == "Morning" && this.endTime == "Afternoon"){
                                this.duration = diffDays + 1
                            } else if (this.startTime == this.endTime && this.startTime == "Morning" || this.endTime == "Afternoon"){
                                this.duration = diffDays + 0.5
                            }
                        }
                        var day = this.duration
                        if (this.duration > 1){
                            day += " days"
                        }else{
                            day += " day"
                        }
                        return day
                    }else{
                        this.inValid = true
                    }
                }
            }
        }
    })
</script>
