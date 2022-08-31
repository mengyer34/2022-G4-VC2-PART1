<template>
    <div>
        <div class="home w-10/12 mt-32 bg-gray-100 m-auto rounded shadow p-3 relative " v-cloak>
            <div class=" p-3 ">
                <div class="flex mt-3">
                    <div class="rounded shadow bg-white shadow-gray-400 w-[26%] text-center relative p-2">
                        <form >
                            <label for="file_input" class="flex justify-end">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer rounded shadow">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </label>
                            <input class="hidden w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file" @change="onSelectFile">
                                <div class="w-32 h-32 flex items-center justify-center m-auto">
                                    <img v-if="user.profile_image != undefined" :src="getImage" alt="" class="rounded-full w-32 h-32 object-fill border-2 border-blue-400">
                                    <downloading-image v-else></downloading-image>
                                </div>
                                <div class="mt-2 w-full flex justify-center">
                                    <div v-if="user.first_name != undefined && user.last_name != undefined" class="font-bold text-2xl">{{user.first_name}} {{user.last_name}}</div>
                                    <loading-text class="mt-3" v-else />
                                </div>
                        </form>
                    </div>  
                    <div class="ml-4 bg-white shadow-gray-400 shadow rounded  w-[74%] p-2">
                        <div class="flex justify-between text-center ">
                            <div class=" w-[49%] h-auto">
                                <div class="flex items-center mt-1 p-2 rounded border border-b-gray-300">
                                    <div class="text-lg">First name</div>
                                    
                                    <div v-if="user.first_name != undefined" class="ml-10 inline-block text-gray-500">{{user.first_name}}</div>
                                    <loading-text class="ml-10" v-else />
                                </div>
                                <div class="flex items-center mt-1 p-2 rounded border border-b-gray-300">
                                    <div class="text-lg">Last name</div>
                                    
                                    <div v-if="user.last_name != undefined" class="ml-10 inline-block text-gray-500">{{user.last_name}}</div>
                                    <loading-text class="ml-10" v-else />
                                </div>
                                <div class="flex items-center mt-1 p-2 rounded border border-b-gray-300">
                                    <div class="text-lg">Gender</div>

                                    <div v-if="user.gender != undefined" class="ml-16 inline-block text-gray-500">{{user.gender}}</div>
                                    <loading-text class="ml-16" v-else />
                                </div>
                        
                                <div class="flex items-center mt-1 p-2 rounded border border-b-gray-300">
                                    <div class="text-lg">Tel</div>
                                    
                                    <div v-if="user.phone != undefined" class="ml-[100px] inline-block text-gray-500">{{user.phone}}</div>
                                    <loading-text class="ml-[100px]" v-else />
                                </div>

                            </div>
                            <div class=" w-[49%] h-auto">
                                <div class="flex items-center mt-1 p-2 rounded border border-b-gray-300">
                                    <div class="text-lg">Student Id</div>
                                    
                                    <div v-if="user.personal_id != undefined" class="ml-12 inline-block text-gray-500">{{user.personal_id}}</div>
                                    <loading-text class="ml-12" v-else />
                                </div>
                                <div class="flex items-center mt-1 p-2 rounded border border-b-gray-300">
                                    <div class="text-lg">Generation</div>
                                    
                                    <div v-if="user.batch != undefined" class="ml-11 inline-block text-gray-500">{{user.batch}}</div>
                                    <loading-text class="ml-11" v-else />
                                </div>
                                <div class="flex items-center mt-1 p-2 rounded border border-b-gray-300">
                                    <div class="text-lg">Class</div>
                                    
                                    <div v-if="user.class != undefined" class="ml-[5.8rem] inline-block text-gray-500">{{user.class}}</div>
                                    <loading-text class="ml-[5.8rem]" v-else />
                                </div>
                                <div class="flex items-center mt-1 p-2 rounded border border-b-gray-300">
                                    <div class="text-lg">Leaves</div>

                                    <div v-if="amountOfLeaves" class="ml-20 inline-block text-gray-500">{{amountOfLeaves}}</div>
                                    <loading-text class="ml-20" v-else />
                                </div>
                                
                            </div>
                        </div>
                        <div class="flex mt-1 items-cente p-2 rounded border border-b-gray-300 w-full m-auto">
                            <div class="text-lg">Gmail</div>

                            <div v-if="user.email != undefined" class="ml-[78px] inline-block text-gray-500">{{user.email}}</div>
                            <loading-text class="ml-[78px]" v-else />
                        </div>
                    </div>
                </div>
                <div class="reset-password pt-6 flex justify-end">
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
        </div>
        <div>
            <div class="fixed flex items-center justify-center bg-[#23242986] w-full h-full top-0 z-100" v-if="isUploaded">
                <form @submit.prevent="saveUpload" enctype="multipart/form-data" class="bg-[#ddd] h-auto rounded p-5  m-auto text-center">
                    <div class="flex items-center justify-between mb-4 text-lg">
                        <p>Crop your new profile picture</p>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" viewBox="0 0 20 20" fill="currentColor" @click="isUploaded=false">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="max-h-72 overflow-auto">
                        <img :src="selectedImage" alt="" class="max-h-[52vh] overflow-auto">
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
    </div>
</template>

<script>
    import axios from '../../../axios-http';
    import WarningAlert from "./alerts/WarningAlert.vue";
    import SuccessAlert from "./alerts/SuccessAlert.vue";
    import DownloadingImage from "./../../animations/DownloadingImage.vue";
    import LoadingText from "./../../animations/LoadingText.vue";
    export default {
        components: {
            'warning-alert': WarningAlert,
            'success-alert': SuccessAlert,
            'downloading-image': DownloadingImage,
            'loading-text': LoadingText,
        },
        props: {
            user_id: Number,
            user: {},
            amountOfLeaves: Number
        },

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

        computed: {
            getImage() {
                if (this.user.profile_image != undefined) {
                    return 'http://127.0.0.1:8000/api/' +'storage/image/' + this.user.profile_image;
                } else {
                    return "";
                }
            },
        },

        methods: {
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
                axios.post("users/reset_profile/" + this.user_id, formData).then((res)=>{
                    this.$emit('update-nav');
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