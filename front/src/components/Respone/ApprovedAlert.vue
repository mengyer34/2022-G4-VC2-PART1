<template>
    <div tabindex="-1" class="overflow-y-auto bg-[#0000005e] overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full m-auto mt-40 max-w-md h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="p-6 text-center">
                    <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-green-500 dark:text-gray-200" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24"  stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mb-4 text-lg font-normal text-gray-600 dark:text-gray-400">Request is <slot></slot>!</h3>
                </div>
            </div>
        </div>
    </div>
</template>