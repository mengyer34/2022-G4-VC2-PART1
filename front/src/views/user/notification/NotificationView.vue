<template>
    <div class=" w-full h-full pt-[100px]">
        <div v-if="dataOfImformation.length > 0" class="card w-8/12 m-auto rounded bg-white">
            <div class="card-header bg-[#0081CA] p-1 mb-4 text-center text-[25px] text-white">
                <h1>Notifications</h1>
            </div>
            <div class="pr-3 pl-3 " v-for="data of dataOfImformation" :key="data">
                <imformation-requestion :datas="data">
                    <template #allow>
                        <div class="bg-[rgba(180,255,224,0.44)]  rounded-l  flex justify-between ">
                            <div class="p-2">
                                <p class="text-[22px]" v-if="data.status === 'Approved'">You are allowed to <span
                                        class="text-[#7BE77B]">go to
                                        homework!</span>
                                </p>
                                <p class="text-[22px]" v-if="data.status === 'Rejected'">You are not allowed to <span
                                        class=" text-[#FF0000]">go to
                                        homework!</span>
                                </p>
                                <p class="text-[12px] text-[#AAAAAA] flex justify-start">{{ data.updated_at }}</p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-10 w-10 m-3 bg-[#7BE77B]  rounded-full px-1 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                v-if="data.status === 'Approved'">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-10 w-10 bg-[#FF0000]  rounded-full m-3 p-1 text-white" fill="none"
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
    <h1></h1>
</template>

<script>
import Axios from "axios"
import requestImformation from "../../../components/user/request/RequestInfortmation.vue"
export default {
    components: {
        "imformation-requestion": requestImformation
    },
    data() {

        return {
            datas: [],
        }
    },
    methods: {
        getData() {
            Axios.get('http://127.0.0.1:8000/api/leaves').then((res) => {
                this.datas = res.data.data.reverse();
            })
        },

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
