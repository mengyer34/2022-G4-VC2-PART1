<template>
    <div class="w-full flex items-center justify-center h-full fixed top-0">
        <div class="text-center bg-slate-300 w-3/12 rounded p-3 text-red-500">
            <h1>{{ content }}</h1>
            <img class="w-14 m-auto" src="./../../../../assets/image_allowed.png" alt="success image">
        </div>
    </div>
</template>

<script>
export default {
    props: ['content'],
}
</script>