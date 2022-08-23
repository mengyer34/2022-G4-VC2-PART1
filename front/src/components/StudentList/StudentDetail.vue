<template>
    <div tabindex="-1" class="overflow-y-auto bg-[#0000005e] overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
        <div class="relative p-4 m-auto mt-40">
            <div class="relative w-[60%] m-auto bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex justify-between items-center bg-primary p-3 text-white">
                    <p></p>
                    <h1 class="text-2xl text-center">Student Detail</h1>
                        <svg aria-hidden="true" class="w-5 h-5 cursor-pointer" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </div>
                <form class="p-3">
                    <!-- <div class="w-24 h-24 flex items-center justify-center">
                        <img  :src="user.profile_image" alt="" class="rounded-full w-20 h-20 object-fill">
                    </div> -->
                    <div class="flex justify-between text-center">
                        <div class="rounded w-6/12 bg-[#474746] h-auto p-3">
                            <div class="inline-block p-2 rounded shadow-2xl w-60 font-bold">Personal Detail</div>
                            <div class="fext-left">
                                <div class="flex">First name
                                    <div>Sauth</div>
                                </div>
                                <div class="flex">Last name
                                    <div>Phouek</div>
                                </div>
                                <div class="flex">Gender
                                    <div>Male</div>
                                </div>
                                <div class="">Gmail
                                    <div>sauth.phouek@passerellesnumeriques.org</div>
                                </div>
                            </div>
                        </div>
                        <div class="rounded w-6/12 shadow-black">
                            <div>Class Detail</div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</template>