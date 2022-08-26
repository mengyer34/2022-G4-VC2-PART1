<template>
    <div class="w-[20rem] flex justify-start">
        <input v-model="keyword" @input="$emit('update-keyword', keyword)" type="text" placeholder="Student name..." class="w-full border border-stone-400 rounded px-5 py-2 pr-11 shadow focus:outline-[#0081CA]">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-7 relative right-9 top-2 text-stone-400 rounded" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </div>
</template>

<script>
export default {
    data() {
        return {
            keyword: "",
        }
    }
}
</script>