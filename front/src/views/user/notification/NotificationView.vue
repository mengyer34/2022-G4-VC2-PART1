<template>

    <div class="home bg-[#ddd] w-full h-[90vh] pt-[100px]">
        <div class="card w-8/12 m-auto rounded-l p-5 shadow- bg-[white]">
            <div class="m-5">
                <imformation-requestion>
                    <template #allow>
                        <div class="bg-[#F5F5F5] rounded-l  flex justify-between">
                            <div class="p-2">
                                <p class="text-[22px]">You are allowed to <span class="text-[#7BE77B]">go to
                                        homework!</span>
                                </p>
                                <p class="text-[12px] text-[#AAAAAA] flex justify-start">February 20, 2018 7:30AM</p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-10 w-10 m-3 bg-[#7BE77B]  rounded-full px-1 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </template>
                </imformation-requestion>
                <p class="text-[12px] text-[#AAAAAA] flex justify-end">From: Socail Affair</p>
            </div>

            <div class="m-5">
                <imformation-requestion>
                    <template #allow>
                        <div class="bg-[#F5F5F5] rounded-l flex justify-between">
                            <div class="p-2">
                                <p class="text-[22px]">You are allowed to <span class="text-[#FF0000]">go to homework!</span>
                                </p>
                                <p class="text-[12px] text-[#AAAAAA] flex justify-start">From: Socail Affair</p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-10 w-10 bg-[#FF0000]  rounded-full m-3 p-1 text-white" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
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
    
    import requestImformation from "../../../components/user/RequestImfortmation.vue"
    export default{
        components: {
            "imformation-requestion": requestImformation
        }
    }                                                                           
</script>
