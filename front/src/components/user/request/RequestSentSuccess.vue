<template>
    <div class="modal w-full h-full top-0 bg-[#00000080] fixed items-center flex">
        <div class="box bg-white rounded-md w-[400px] h-60 m-auto relative">
            <div class="circle rounded-full  w-20 h-20 bg-green-500 absolute -top-10 left-40">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div class="w-full p-5 mt-14 text-center "     >
                <h1 class="text-4xl font-bold mb-2">Success!</h1>
                <p>Your request has been sent</p>
            </div>
            <div class="w-full p-5">
                <button class="btn p-2 w-full  bg-green-500 text-white rounded font-bold" @click="$emit('addNewRequest')">
                    OK
                </button>
            </div>
        </div>
    </div>
</template>

