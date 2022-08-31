<template>
    <div id="animate-container" class="animate-pulse w-full h-full flex justify-center items-center">
        <div class="animate-bounce rounded-full w-8 h-8 shadow bg-white flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </div>
    </div>
</template>

<style scoped>
#animate-container {
    background-image: url("./../../assets/avatar.png");
    background-repeat: no-repeat;
    background-size: cover;
}
</style>