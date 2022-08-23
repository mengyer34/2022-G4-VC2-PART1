<template>
    <div class="w-full sm:px-6 mt-24">
        <h1 class="text-lg font-semibold">STUDENT INFORMATION</h1>
        <div class="bg-white mt-4 p-3 rounded">
            <div>
                <label for="filter-status text-sm leading-none text-gray-800"><span class="text-red-600">*</span>Batch:</label><br>
                <div class="flex justify-between w-full">
                    <select name="" id="filter-status" class="w-[20%] rounded border p-2 focus:outline-none focus:border-primary">
                        <option value="All">All</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                    </select>
                    <div class="w-[60%] relative flex">
                        <input class="p-2 focus:border-primary outline-none rounded-l border border-gray-300 w-full" type="text" placeholder="Student name...">
                        <button class=" border border-gray-300  items-centeroutline-none p-2 w-12 bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                    <div class="w-32 flex justify-end">
                        <button class="text-white bg-orange-500 py-2 px-4 rounded border-none">Add Student</button>
                    </div>
                </div>
            </div>
            <div>
                <table class="w-full whitespace-nowrap">
                    <thead>
                        <tr tabindex="0" class="focus:outline-none h-16 w-full text-sm leading-none text-gray-800 border-b-2 border-primary">
                            <th class="font-bold text-center ">STUDENT</th>
                            <th class="font-bold text-center ">GENDER</th>
                            <th class="font-bold text-center ">EMAIL</th>
                            <th class="font-bold text-center ">BATCH</th>
                            <th class="font-bold text-center ">ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="w-full">
                        <tr v-for="student of students" :key="student" tabindex="0" class="focus:outline-none h-12 text-sm leading-none text-gray-800 border-b border-t border-gray-300">
                            <td class="text-center w-3/12 pl-2">
                                <div class="flex items-center space-x-2 p-2">
                                    <img class="rounded-full w-[19%]" :src="student.profile_image" alt="">
                                    <p class="pl-6">{{student.first_name}} {{student.last_name}}</p>
                                </div>
                            </td>
                            <td class="text-center">
                                {{student.gender}}
                            </td>
                            <td class="text-center">
                                {{student.email}}
                            </td>
                            <td class="text-center">
                                {{student.generation}}
                            </td>
                            <td class="text-center">
                                <button class="bg-blue-500 rounded px-5 py-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </button>
                                <button @click="popUp" class="bg-red-600 rounded px-5 py-2 ml-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </td>
                            <div v-if="isPop" tabindex="-1" class="overflow-y-auto bg-[#0000005e] overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
                                <div class="relative p-4 w-full m-auto mt-40 max-w-md h-full md:h-auto">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <button @click="popUp" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        </button>
                                        <div class="p-6 text-center">
                                            <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this student?</h3>
                                            <button @click="deleteStudent(student.id)" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                Yes, I'm sure
                                            </button>
                                            <button @click="popUp" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    </tbody>
                </table>               
            </div>
        </div>

    </div>
</template>

<script>
import axios from '../../../axios-http.js'
const url = 'http://localhost:8000/api/'
export default {
    data() {
        return {
            students: [],
            isPop: false,
        }
    },
    methods: {
        getStudent() {
            axios.get(url + 'users').then(res => {
                this.students = res.data.data;
            })
        },   
        deleteStudent(studentId) {
            axios.delete(url + 'users/' + studentId).then(res => {
                this.getStudent();
            })
            this.isPop = !this.isPop;
        },
        popUp() {
            this.isPop = !this.isPop;
        },
    },
    mounted() {
        this.getStudent();
    },
}
</script>