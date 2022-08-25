<template>
    <div class=" w-full h-full pt-[100px]">
        <div v-if="dataOfImformation.length > 0" class="card w-9/12 m-auto rounded shadow bg-white">
            <div class="card-header rounded-tl rounded-tr bg-[#0081CA] p-1 mb-4 text-center text-[25px] text-white">
                <h1>Notifications</h1>
            </div>
            <div class="w-[90%] m-auto" v-for="data of dataOfImformation" :key="data">
                <imformation-requestion :datas="data">
                    <template #allow>
                        <div @click="seenNotification(data.id)" :class="{'bg-slate-300 font-semibold': !data.is_user_seen}" class="rounded flex justify-between hover:bg-slate-200">
                            <div class="p-2 w-[85%]">
                                <p class="text-[22px] text-start">
                                    Your request <span class="text-orange-400">{{ data.reason.substring(0, 35) }}{{ data.reason.length > 35 ? '...' : '' }}</span> has been <span :class="{'text-red-500': data.status == 'Rejected', 'text-green-500': data.status == 'Approved'}">{{ data.status }}</span>
                                </p>
                                <p class="text-[12px] text-[#AAAAAA] flex justify-start">{{ data.updated_at }}</p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-[40px] w-[40px] m-3 bg-[#7BE77B]  rounded-full px-1 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                v-if="data.status === 'Approved'">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-[40px] w-[40px] bg-[#FF0000]  rounded-full m-3 p-1 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                v-if="data.status === 'Rejected'">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                    </template>
                </imformation-requestion>
                <p class="text-[12px] text-[#AAAAAA] flex justify-end pb-2">From: Socail Affair</p>
            </div>
        </div>
        <div v-else class="text-center mt-10 text-2xl m-auto">
            <img src="../../../assets/notification.png" class="m-auto w-20 h-20">
            No Notification Here
        </div>
    </div>
</template>

<script>
import Axios from "axios"
import requestImformation from "../../../components/user/request/RequestInformation.vue"
const url = 'http://localhost:8000/api/users_leaves/'
export default {
    components: {
        "imformation-requestion": requestImformation
    },
    inject: ['user_id'],
    data() {

        return {
            datas: [],
        }
    },
    methods: {
        getData() {
            Axios.get(url + this.user_id).then((res) => {
                this.datas = res.data.data.leaves.reverse();
            })
        },

        seenNotification(leaveId) {
            Axios.put('http://127.0.0.1:8000/api/leaves/user_seen/' + leaveId).then(res => {
                if (res.data.success) {
                    this.datas.forEach((eachData, index) => {
                        if (eachData.id == leaveId) {
                            this.datas[index].is_user_seen = true;
                        }
                    });
                    
                    this.$emit('notifUpdated');
                }
            });
        }
    },
    computed: {
        dataOfImformation() {
            return this.datas.filter(data => data.status != "Pending");
        },
    },
    mounted() {
        this.getData();
    }
}                                                                           
</script>
