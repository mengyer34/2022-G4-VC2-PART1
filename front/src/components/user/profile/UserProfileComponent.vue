<template>
    <div class="home w-full h-[110vh] pt-[100px]" v-cloak>
        <div class="card w-8/12 m-auto rounded-xl shadow- bg-[white]">
            <div class="card-header bg-[#0081CA] p-2 text-center text-[30px] text-white rounded-t-md">
                <h1>My Profile</h1>
            </div>
            <div class="card-body p-5">
                <div class="user-profile flex relative">
                    <form >
                        <div class="w-24 h-24 flex items-center justify-center">
                            <img  :src="getImage(user.profile_image)" alt="" class="rounded-full w-20 h-20 object-fill">
                        </div>
                        <label for="file_input">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 absolute top-16 hover:scale-110 cursor-pointer left-16 bg-slate-300 p-1 text-3xl rounded-full" viewBox="0 0 20 20" fill="currentColor" >
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </label>
                        <input class="hidden w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file" @change="onSelectFile">
                    </form>
                    <div class="p-5">
                        <div>
                            <h1 class="font-bold text-[25px]">{{user.first_name}} {{user.last_name}}</h1>
                        </div>
                        <div><span class="font-bold">ID :</span> {{user.personal_id}}</div>
                    </div>
                </div>
                <div class=" grid grid-cols-2 mt-3">
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
                            <button class="bg-[#FF0000] p-2 items-center rounded-md text-white flex hover:bg-red-500 shadow transition-all px-4" @click="$emit('resetPassword')">
                                    Reset Password 
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M18 8a6 6 0 01-7.743 5.743L10 14l-1 1-1 1H6v2H2v-4l4.257-4.257A6 6 0 1118 8zm-6-4a1 1 0 100 2 2 2 0 012 2 1 1 0 102 0 4 4 0 00-4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                            </button>
                        </div>
                    </div>

                    <div class="p-5 border-solid border-2 border-black-600 ml-2">
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
                            <p>{{amountOfLeaves}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="fixed flex items-center justify-center bg-[#23242986] w-full h-full top-0 z-50 " v-if="isUploaded">
            <form @submit.prevent="saveUpload" enctype="multipart/form-data" class="w-[32%] bg-[#ddd] h-auto rounded p-5  m-auto text-center">
                <div class="flex items-center justify-between mb-4 text-lg">
                    <p>Crop your new profile picture</p>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" viewBox="0 0 20 20" fill="currentColor" @click="isUploaded=false">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="max-h-72 overflow-auto">
                    <img :src="selectedImage" alt="" class="w-full max-h-[52vh] overflow-auto">
                </div>
                <div class="w-full mt-5">
                    <button type="submit" class="btn bg-warning rounded p-2 text-white w-full">
                        Set new profile picture
                    </button>
                </div>
            </form>

        </div>

        <!-- Alerts -->
        <success-alert v-if="isSuccessAlert" :content="'Update profile success!'" />
        <warning-alert v-if="isWarningAlert" :content="'File must be an image!'" />
    </div>
</template>
<script>
    import axios from 'axios';
    const url = 'http://127.0.0.1:8000/api/'
    import WarningAlert from "./alerts/WarningAlert.vue";
    import SuccessAlert from "./alerts/SuccessAlert.vue";
    export default {
        components: {
            'warning-alert': WarningAlert,
            'success-alert': SuccessAlert,
        },
        props: {
            user: Object,
            amountOfLeaves: Number
        },
        inject: ['user_id'],

        data(){
            return {
                selectedImage: null,
                image: null,
                isUploaded: false,
                allowImageExtension: ['jpg', 'png', 'jpeg'],
                isSuccessAlert: false,
                isWarningAlert: false,
            }
        },

        methods: {
            getImage(imageName) {
                return url +'storage/image/' + imageName;
            },

            onSelectFile(event){
                let fileExtension = event.target.files[0].name.split('.').pop();
                if (this.allowImageExtension.includes(fileExtension.toLowerCase())) {
                    this.image = event.target.files[0];

                    let reader = new FileReader();
                    reader.readAsDataURL(this.image);
                    reader.onload = e => {
                        this.selectedImage = e.target.result;
                    }

                    this.isUploaded = true;
                } else {
                    this.onClosePopup();
                    this.warningAlert();
                }
                event.target.value = "";
            },

            saveUpload(){
                let formData = new FormData();
                formData.append('profile_image', this.image);
                formData.append('_method', 'PUT');

                this.onClosePopup();
                axios.post(url + "users/reset_profile/" + this.user_id, formData).then((res)=>{
                    this.$emit('user-updated');
                    this.successAlert();
                })
            },

            onClosePopup() {
                this.isUploaded = false;
                this.image = null;
                this.selectedImage = null;
            },

            successAlert() {
                this.isSuccessAlert = true;
                setTimeout(() => {
                    this.isSuccessAlert = false;
                }, 1500);
            },

            warningAlert() {
                this.isWarningAlert = true;
                setTimeout(() => {
                    this.isWarningAlert = false;
                }, 2000);
            }
        }
    }
</script>
