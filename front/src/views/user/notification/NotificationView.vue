<template>
    <div class="w-full pt-[90px]">
        <div v-if="!isLoadingNotifications && dataOfImformation.length > 0" class="card w-7/12 m-auto rounded shadow bg-white">
            <div class="card-header rounded-tl rounded-tr bg-[#0081CA] p-1 mb-4 text-center text-[25px] text-white">
                <h1>Notifications</h1>
            </div>
            <div class="overflow-auto h-[70vh] scroll-bar">
                <div class="w-[98%] m-auto" v-for="data of dataOfImformation" :key="data">
                    <imformation-requestion :datas="data" :isViewNotifDetail="isViewNotifDetail" @isViewNotifDetail="isViewNotifDetail = !isViewNotifDetail">
                        <template #allow>
                            <div @click="seenNotification(data.id)" :class="{'bg-slate-100 font-semibold': !data.is_user_seen}" class="flex justify-between hover:bg-slate-100 p-2">
                                <div class="flex items-center relative">
                                    <span :class="{'w-[10px] h-[10px] rounded-full bg-[#23C552] absolute right-0 mb-4': !data.is_user_seen}"></span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-[30px] h-[30px]">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                    </svg>
                                </div>
                                <div class="p-2 w-[85%]">
                                    <p class="text-[18px] text-start">
                                        Your request <span class="text-orange-400">{{ data.reason.substring(0, 35) }}{{ data.reason.length > 35 ? '...' : '' }}</span> has been <span :class="{'text-red-500': data.status == 'Rejected', 'text-green-500': data.status == 'Approved'}">{{ data.status }}</span>
                                    </p>
                                    <p class="text-[11px] text-[#7d7d7d] flex justify-start">{{ data.updated_at }}</p>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-[30px] w-[30px] m-3 bg-[#7BE77B]  rounded-full px-1 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                    v-if="data.status === 'Approved'">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-[30px] w-[30px] bg-[#FF0000]  rounded-full m-3 p-1 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                    v-if="data.status === 'Rejected'">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                        </template>
                    </imformation-requestion>
                    <hr>
                </div>
            </div>
        </div>

        <div v-if="!isLoadingNotifications && dataOfImformation.length <= 0" class="text-center mt-10 text-2xl m-auto">
            <img src="../../../assets/notification.png" class="m-auto w-20 h-20">
            No any notifications here!
        </div>

        <getting-resources class="mt-9" v-if="isLoadingNotifications">Loading notifications...</getting-resources>
    </div>
</template>

<script>
import axios from "../../../axios-http"
import requestImformation from "../../../components/user/request/RequestInformation.vue"
import GettingResources from "./../../../components/animations/GettingResources.vue";
export default {
    components: {
        "imformation-requestion": requestImformation,
        "getting-resources": GettingResources,
    },

    props: ['user_id'],

    data() {
        return {
            datas: [],
            isLoadingNotifications: true,
            isViewNotifDetail: false,
        }
    },
    
    methods: {
        getData() {
            axios.get('users_leaves/' + this.user_id).then((res) => {
                this.datas = res.data.data.leaves.reverse();
                this.isLoadingNotifications = false;
                this.timer();
            })
        },

        seenNotification(leaveId) {
            axios.put('/leaves/user_seen/' + leaveId).then(res => {
                if (res.data.success) {
                    this.datas.forEach((eachData, index) => {
                        if (eachData.id == leaveId) {
                            this.datas[index].is_user_seen = true;
                        }
                    });
                    
                    this.$emit('update-nav');
                }
            });
        },

        timer() {
            let refreshDuration = setTimeout(() => {
                this.getData();
                clearTimeout(refreshDuration);
            }, 10000);
        }
    },

    computed: {
        dataOfImformation() {
            let leaves = this.datas.filter(data => data.status != "Pending");
            let numberOfLoop = leaves.length;
            let orderedLeaves = [];

            for (let i = 0; i < numberOfLoop; i++) {
                let latestLeaveIndex = 0;
                let LatestUpdate = leaves[0].updated_at;
                leaves.forEach((eachLeave, index) => {
                    if (eachLeave.updated_at > LatestUpdate) {
                        LatestUpdate = eachLeave.updated_at;
                        latestLeaveIndex = index;
                    }
                })

                orderedLeaves.push(leaves[latestLeaveIndex]);
                leaves.splice(latestLeaveIndex, 1);
            }

            return orderedLeaves;
        },
    },

    watch: {
        user_id() {
            this.getData();
        }
    },

    created() {
        if (this.user_id) {
            this.getData();
        }
    }
}                                                                           
</script>
