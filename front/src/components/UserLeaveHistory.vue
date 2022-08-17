<template>
    <div class="w-9/12 m-auto bg-slate-300 rounded-md mt-3 p-8 shadow-sm shadow-gray-600">
        <p>Total: {{leaves.length}}</p>
        <leave-card v-for="leave of leavesstatus" :key="leave" :leave="leave"/>
    </div>
</template>

<script>
import UserLeaveCard from './UserLeaveCard.vue'

export default {
    components: {
      'leave-card': UserLeaveCard,
    },
    props: ['leaves', 'status'],
    data() {
      return {
      };
    },
    computed: {
        leavesstatus() {
            if (this.status == "Approve") {
                return this.leaves.filter(leave => leave.status == "Approve");
            }else if (this.status == "Panding") {
                return this.leaves.filter(leave => leave.status == "Panding");
            }else if (this.status == "Reject") {
                return this.leaves.filter(leave => leave.status == "Reject");
            }else {
                return this.leaves;
            }
        }
    }
}
</script>