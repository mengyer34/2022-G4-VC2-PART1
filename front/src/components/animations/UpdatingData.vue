<template>
    <div class="w-full flex justify-center items-center py-1">
        <img src="./../../assets/loading_circle.png" class="animate-spin h-5 w-5 mr-3" viewBox="0 0 20 20">
        <p class="font-bold text-gray-500 p-0 m-0">
            <slot></slot>
        </p>
    </div>
</template>