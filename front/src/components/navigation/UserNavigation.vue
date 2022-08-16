<template>
    <nav class="flex w-full p-2 bg-[#0081CA] text-white justify-between items-center px-4 sticky top-0">
        <ul @click="show=false">
            <li class="flex items-center space-x-2">
                <img src="../../assets/pnc_logo.png" alt="logo" class="w-[60px]">
                <span class="text-3xl font-semibold">SLMS</span>
            </li>
        </ul>
        <ul @click="show=false" class="flex">
            <li>
                <router-link class="p-2 px-6 flex" to="/">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-[1.35rem] w-6 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    Home
                </router-link>
            </li>
            <li>
                <router-link class="p-2 px-6 flex" to="/newRequest">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm0 2h10v7h-2l-1 2H8l-1-2H5V5z" clip-rule="evenodd" />
                    </svg>
                    New Request
                </router-link>
            </li>
            <li>
                <router-link class="flex p-2 px-6" to="/histories">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                    </svg>
                    History
                </router-link>
            </li>
        </ul>
        <ul class="flex space-x-5 relative">
            <li>
                <router-link class="relative" to="notifications">
                    <span class="bg-red-700 text-xs rounded-full px-1 absolute">1</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                    </svg>
                </router-link>
            </li>
            <li @click="show=!show" class="flex space-x-2 cursor-pointer">
                <img src="../../assets/avatar.png" alt="logo" class="w-[30px]">
                <span>Sauth Phouek</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
                <div v-if="show" class="py-1 rounded-md shadow-xs absolute bg-gray-200 mt-10 right-0">
                    <router-link class="flex px-4 py-2 text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-warning hover:text-white focus:outline-none focus:bg-gray-100" to="/profile">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Your Profile
                    </router-link>
                    <router-link class="flex px-4 py-2 text-sm leading-5 text-gray-700 transition duration-150 ease-in-out focus:outline-none hover:bg-warning hover:text-white" to="/logout">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Sign out
                    </router-link>
                </div>
            </li>
        </ul>
    </nav>
</template>
<script>
export default {
    data() {
      return {
        show: false,
      };
    },
}
</script>