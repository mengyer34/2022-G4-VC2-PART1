<template>
    <nav class="w-52 h-screen bg-[#0081CA] text-white fixed top-16 z-0 pt-4">
        <ul @click="show=false" id="animation" class="flex flex-col">
            <li>
                <router-link class="p-3 px-8 flex hover:bg-[#1793db]" to="/dashboard">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-[1.35rem] w-6 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm9 4a1 1 0 10-2 0v6a1 1 0 102 0V7zm-3 2a1 1 0 10-2 0v4a1 1 0 102 0V9zm-3 3a1 1 0 10-2 0v1a1 1 0 102 0v-1z" clip-rule="evenodd" />
                    </svg>
                    Dashboard
                </router-link>
            </li>
            <li>
                <router-link class="p-3 px-8 flex hover:bg-[#1793db]" to="/students">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-[1.35rem] w-6 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 2a1 1 0 00-1 1v1a1 1 0 002 0V3a1 1 0 00-1-1zM4 4h3a3 3 0 006 0h3a2 2 0 012 2v9a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2zm2.5 7a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm2.45 4a2.5 2.5 0 10-4.9 0h4.9zM12 9a1 1 0 100 2h3a1 1 0 100-2h-3zm-1 4a1 1 0 011-1h2a1 1 0 110 2h-2a1 1 0 01-1-1z" clip-rule="evenodd" />
                    </svg>
                    Students
                </router-link>
            </li>
            <li>
                <router-link class="flex p-3 px-8 hover:bg-[#1793db]" to="/leaves">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                    </svg>
                    Leaves

                    <div class="ml-5 flex justify-center items-center">
                        <small class="bg-red-400 text-white rounded-lg px-[0.30rem] border">{{ countUnseenNotification }}</small>
                    </div>
                </router-link>
            </li>
        </ul>
    </nav>
</template>

<script>
import axios from "../../axios-http"
export default {
    data() {
      return {
        show: false,
        leaves: [],
      };
    },

    computed: {
        countUnseenNotification() {
            let countUnseen = 0;
            this.leaves.forEach(eachLeave => {
                if (!eachLeave.is_admin_seen) {
                    countUnseen += 1
                }
            });
            return countUnseen;
        },
    },

    methods: {
        getData() {
            axios.get('leaves/').then(res=> {
                this.leaves = res.data.data;
            })
        },
    },

    created() {
        this.getData();
    },
}
</script>

<style scoped>
    nav a.router-link-exact-active {
        background: white;
        color: #0081CA;
    }
</style>