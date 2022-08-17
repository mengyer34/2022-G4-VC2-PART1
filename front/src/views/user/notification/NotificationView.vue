<template>
    <div class="home bg-[#ddd] w-full h-[90vh] pt-[100px]">
        <div class="card w-8/12 m-auto rounded-l p-5 shadow- bg-[white]">
            <div class="m-5">
                <div class="bg-[#F5F5F5] rounded-l  flex justify-between">
                    <div class="p-5">
                        <p class="text-[22px]">You are allowed to <span class="text-[#7BE77B]">go to homework!</span></p>
                        <p class="text-[12px] text-[#AAAAAA]">February 20, 2018 7:30AM</p>
                    </div>
                    <div class="polygon bg-[#7BE77B]"></div>
                </div>
                <p class="text-[12px] text-[#AAAAAA] flex justify-end">From: Socail Affair</p>
            </div>

            <div class="m-5">
                <div class="bg-[#F5F5F5] rounded-l flex justify-between">
                    <div class="p-5">
                        <p class="text-[22px]">You are allowed to <span class="text-[#FF0000]">go to homework!</span></p>
                        <p class="text-[12px] text-[#AAAAAA]">From: Socail Affair</p>
                    </div>
                    <div class="polygon bg-[#FF0000]"></div>
                </div>
                <p class="text-[12px] text-[#AAAAAA] flex justify-end">From: Socail Affair</p>
            </div>
            
        </div>
    </div>
</template>
// @ is an alias to /src
<style>
 .polygon{
    clip-path: polygon(100% 0, 27% 0, 100% 86%);
    width: 20%;
    height: 120px;
 }
</style>