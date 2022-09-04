<template>
    <table class="w-full whitespace-nowrap bg-white mt-4 bg-opacity-50">
        <thead>
            <tr tabindex="0" class="focus:outline-none h-16 w-full text-sm leading-none text-gray-800 border-b-2 border-primary">
                <th class="font-bold text-center ">STUDENT</th>
                <th class="font-bold text-center ">GENDER</th>
                <th class="font-bold text-center ">EMAIL</th>
                <th class="font-bold text-center ">BATCH</th>
                <th class="font-bold text-center ">ACTION</th>
            </tr>
        </thead>
        
        <tr v-if="isUpdating" class="w-full bg-orange-300">
            <td colspan="7">
                <updating-data>Updating data...</updating-data>
            </td>
        </tr>

        <tbody v-if="students.length > 0" class="w-full">
            <tr v-for="student of students" :key="student" tabindex="0" class="focus:outline-none h-12 text-sm leading-none text-gray-800 border-b border-t border-gray-300 bg-opacity-50   ">
                <td class="text-center pl-4">
                    <div class="flex items-center space-x-2 p-2">
                        <img v-if="student.profile_image" class="rounded-full w-14 h-14 border-2 border-primary" :src="getImage(student.profile_image)" alt="">
                        <img v-else class="rounded-full w-14 h-14 border-2 border-primary" src="./../../assets/avatar.png" alt="">
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
                    {{student.batch}}
                </td>
                <td class="text-center relative">
                    <button class="view-detail bg-blue-500 rounded px-5 py-2 hover:bg-primary shadow" @click="$emit('viewDetail',student.id)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                        </svg>
                    </button>
                    <p class="show-text1 opacity-0 right-0 inline-block bg-[#ddd] p-2 px-4 absolute rounded -top-4">View student detail</p>
                    <button @click="$emit('popUp',student.id)"  class= " bg-red-500 hover:bg-red-600 shadow  rounded px-5 py-2 ml-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>

                </td>
            </tr>
        </tbody>

        <tbody v-else-if="allStudents.length <= 0 && !isGettingResources">
            <tr>
                <td colspan="7" class="p-2 text-center">
                    <img class="w-32 m-auto mt-3" src="./../../assets/request_empty.png" alt="Image not found">
                    <p class="mb-5">No students found!</p>
                </td>
            </tr>
        </tbody>

        <tbody v-else-if="students.length <= 0 && !isGettingResources">
            <tr>
                <td colspan="7" class="p-2 text-center">
                    <img class="w-32 m-auto mt-3" src="./../../assets/no_requests_found.png" alt="Image not found">
                    <p class="mb-5">No students found!</p>
                </td>
            </tr>
        </tbody>

        <tbody v-if="isGettingResources">
            <tr>
                <td colspan="7" class="p-2 text-center">
                    <getting-resources>Loading students...</getting-resources>
                </td>
            </tr>
        </tbody>
    </table>     
</template>

<script>
import GettingResources from './../animations/GettingResources.vue';
import UpdatingData from './../animations/UpdatingData.vue';
import axios from "../../axios-http"

export default {
    components: {
        'getting-resources': GettingResources,
        "updating-data": UpdatingData,
    },
    props:{
        students: Array,
        isGettingResources: Boolean,
        allStudents: Array,
        isUpdating: Boolean,
    },
    methods: {
        getImage(imageName) {
            return axios.defaults.baseURL + "/storage/image/" + imageName;
        }
    }
}
</script>

<style scoped>
    .show-text1:before{
        position: absolute;
        content: "";
        height: 12px;
        width: 12px;
        background: #ddd;
        left: 14px;
        top: 22px;
        transform: translateX(-50%) rotate(45deg);
    }
    .view-detail:hover + .show-text1{
        opacity: 100;
        transition: all .3s ease-in-out;
    }
</style>