<template>
    <div class="mt-4">
        <div  class="bg-slate-200 p-6 rounded-md">
            <p>Leave type: <span class="font-bold">{{leave.leave_type}}</span></p>
            <div class="flex justify-between">
                <div class="">
                    <p class="truncate w-64">Reason: <span class="text-orange-500">{{leave.reason}}</span></p>
                    <p>From: <span>{{leave.start_date}} - {{leave.end_date}}</span></p>
                </div>
                <div class="mr-5">
                    <p>Duration: <span class="font-bold text-red-600">{{leave.duration}}</span></p>
                    <p>Status: <span :class="iscolor">{{leave.status}}</span></p>
                </div>

            </div>
        </div>
        <p class="text-end">Requested: <span class="text-gray-500">{{format_date(leave.created_at) }}</span></p>
    </div>

</template>

<script>


export default {
    props: ['leave'],
    data() {
      return {
      };
    },
    computed: {
        iscolor() {
            if (this.leave.status == "Approve") {
                return "text-green-500";
            }else if (this.leave.status == "Panding") {
                return "text-orange-500";
            }else if (this.leave.status == "Reject") {
                return "text-red-500";
            }
        },
    },
    methods: {
      format_date(value){
         if (value) {
           return moment(String(value)).format('MM/DD/YYYY hh:mm')
          }
      },
    }
}
</script>