<template>
    <div class="fixed z-50 top-0 flex justify-center items-center w-full h-full bg-[rgba(105,105,105,0.57)]">
        <img src="./../../assets/loading_circle.png" class="animate-spin h-5 w-5 mr-3" viewBox="0 0 30 30">
        <p class="font-bold text-white p-0 m-0">
            <slot></slot>
        </p>
    </div>
</template>
