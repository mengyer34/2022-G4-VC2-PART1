<template>
    <div class="w-full flex justify-between">
        <input type="text" placeholder="Student name..." v-model="search_keyword" class="w-[85%] rounded-md px-5 py-2 shadow focus:outline-[#0081CA]">
        <button @click="$emit('search_keyword', search_keyword)" class="w-[14%] bg-[#0081CA] rounded-md text-lime-50 font-semibold tracking-widest shadow hover:bg-[#007ac0]">SEARCH</button>
    </div>
</template>

