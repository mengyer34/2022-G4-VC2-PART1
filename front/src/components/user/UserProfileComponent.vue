<template>
    <div class="home bg-[#ddd] w-full h-[110vh] pt-[100px]">
        <div class="card w-8/12 m-auto rounded-xl shadow- bg-[white]">
            <div class="card-header bg-[#0081CA] p-2 text-center text-[30px] text-white">
                <h1>My Profile</h1>
            </div>
            <div class="card-body p-5">
                <div class="user-profile flex ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 ml-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 bg-[#ddd]  rounded-full px-1 absolute ml-[50px] mt-[50px]" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                    <div class="p-5">
                        <div>
                            <h1 class="font-bold text-[25px]">{{user.first_name}} {{user.last_name}}</h1>
                        </div>
                        <div><span class="font-bold">ID :</span> {{user.personal_id}}</div>
                    </div>
                </div>
                <div class="user-detail grid grid-cols-2">
                    <div class=" personal-detail p-3 border-solid border-2 border-black-600">
                        <h1 class="text-[20px]">Personal details</h1>
                        <div>
                            <p class="font-bold">First Name</p>
                            <p>{{user.first_name}}</p>
                        </div>
                        <div>
                            <p class="font-bold">Last Name</p>
                            <p>{{user.last_name}}</p>
                        </div>
                        <div>
                            <p class="font-bold">Gender:</p>
                            <p>{{user.gender}}</p>
                        </div>
                        <div>
                            <p class="font-bold">Email:</p>
                            <p>{{user.email}}</p>
                        </div>
                        <div class="reset-password pt-10">
                            <button class="bg-[#FF0000] p-1.5 rounded-md text-white flex">
                                <router-link class="p-2 px-6 flex" to="/newRequest">
                                    Reset Password
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 " viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M18 8a6 6 0 01-7.743 5.743L10 14l-1 1-1 1H6v2H2v-4l4.257-4.257A6 6 0 1118 8zm-6-4a1 1 0 100 2 2 2 0 012 2 1 1 0 102 0 4 4 0 00-4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </router-link>
                            </button>
                        </div>
                    </div>

                    <div class=" class-detail p-5 border-solid border-2 border-black-600 ml-2">
                        <h1 class="text-[20px]">Class deltails</h1>
                        <div>
                            <p class="font-bold">Student_ID:</p>
                            <p>{{user.personal_id}}</p>
                        </div>
                        <div>
                            <p class="font-bold">Generation</p>
                            <p>{{user.generation}}</p>
                        </div>
                        <div>
                            <p class="font-bold">Class:</p>
                            <p>{{user.class}}</p>
                        </div>
                        <div>
                            <p class="font-bold">Leaves</p>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios"
export default {
    data(){
        return{
            user:{},
            id : 1
        }
    },
    methods:{
        getProfileInfo(){
            axios.get('http://127.0.0.1:8000/api/users_leaves/'+this.id).then((res) => {
                this.user = res.data.data;
                console.log(this.user)
            })
        },
    },
    mounted() {
        this.getProfileInfo();
    },
}
</script>