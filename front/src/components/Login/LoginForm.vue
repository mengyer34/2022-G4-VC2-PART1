<template>
    <div class="flex">
        <img src="../../assets/login.svg" alt="logo" class="w-[35%] m-auto ">
        <div class="rounded mb-4 w-[40%] m-auto mt-[30px] ">
            <form class="p-5 bg-white rounded-b-md">
                <img src="../../assets/pnc_logo.png" alt="logo" class="w-[50px] m-auto">
                <h1 class="text-1xl font-semibold text-center p-1">LOGIN SLMS</h1>
                <div class="mb-1 relative">
                    <label class="block  text-gray-700 text-lg  mb-1" for="username">
                        Role
                    </label>
                    <select
                        class="block appearance-none w-full bg-white border border-gray-400 px-3 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:border-primary"
                        placeholder="Admind">
                        <option value="Admin">Admin</option>
                        <option value="Student">Student</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-5 w-5 mt-[20px]" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>

                <div class="mb-6 relative">
                    <label class="block text-gray-700 text-lg  mb-1" for="password">
                        Email *
                    </label>
                    <input
                        class="shadow appearance-none border border-gray-400  rounded w-full py-2 px-3 text-gray-700 mb-1 leading-tight focus:outline-primary focus:shadow-outline"
                        id="email" type="email" placeholder="Email...">
                    <div class="mb-1 relative">
                        <label class="block  text-gray-700 text-lg  mb-1" for="username">
                            Password
                        </label>
                        <input
                            class="shadow appearance-none border border-gray-400  rounded w-full py-2 px-3 text-gray-700 mb-1 leading-tight focus:outline-primary focus:shadow-outline"
                            id="password" type="password" placeholder="Password...">
                    </div>
                    <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
                        Forgot Password?
                    </a>
                </div>
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white py-2 w-full px-4 rounded focus:outline-primary focus:shadow-outline"
                    type="button" >
                    Login
                </button>
            </form>

        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style>
</style>