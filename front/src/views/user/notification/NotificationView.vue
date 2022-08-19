<template>

    <div class="home bg-[#ddd] w-full h-[90vh] pt-[100px]">
        <div v-for="data of dataOfImformation" :key="data" class="card w-8/12 m-auto  p-3  shadow- bg-[white]">
            <div class="pr-3 pl-3">
                <imformation-requestion :datas="data">
                    <template #allow>
                        <div class="bg-[#F5F5F5] rounded-l  flex justify-between ">
                            <div class="p-2">
                                <p class="text-[22px]">You are allowed to <span
                                        :class="data.status === 'Approved' ? 'text-[#7BE77B]' : 'text-[#FF0000]'">go to
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
                <p class="text-[12px] text-[#AAAAAA] flex justify-end">From: Socail Affair</p>
            </div>
        </div>
    </div>
    <h1></h1>
</template>
// @ is an alias to /src

<script>
import Axios from '../../../axios-http'
import requestImformation from "../../../components/user/RequestImfortmation.vue"
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
                this.datas = res.data.data;
                console.log(this.datas)
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
