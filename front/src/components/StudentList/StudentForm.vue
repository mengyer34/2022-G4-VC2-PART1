<template>
    <div tabindex="-1" class=" bg-[#0000005e] fixed  flex items-center z-50 md:inset-0 h-modal md:h-full ">
        <div class="modal bg-white h-auto shadow-md rounded  mt-6 mb-10 m-auto w-[40%] z-10">
            <form >
                <div class="flex justify-between items-center p-2 rounded-t bg-primary text-white">
                    <p></p>
                    <h1 class="text-[20px] font-semibold ">Add New Student</h1>
                    <svg aria-hidden="true" @click="$emit('closePopup')" class="w-5 h-5 cursor-pointer"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>

                <div class="p-4">
                    <div class="mb-1 flex">
                    <div class="w-[49%] m-1">
                        <label class="block text-gray-700 text-[15px] mb-1">
                            First Name
                        </label>
                        <input
                            class="shadow appearance-none border  rounded w-full py-2.5 px-2 text-l text-gray-700 mb-1 leading-tight focus:outline-primary focus:shadow-outline"
                            type="text" placeholder="First name..."
                            :class="{'border-red-500 bg-red-100': is_first_name }" v-model="first_name"
                            @change="is_first_name = false">
                    </div>
                    <div class="w-[49%] m-1">
                        <label class="block text-gray-700 text-[15px] mb-1">
                            Last Name
                        </label>
                        <input
                            class="shadow appearance-none border  rounded w-full py-2.5 px-2 text-l text-gray-700 mb-1 leading-tight focus:outline-primary focus:shadow-outline"
                            type="text" placeholder="Last name..."
                            :class="{ 'border-red-500 bg-red-100': is_last_name }" v-model="last_name"
                            @change="is_last_name = false">
                    </div>
                </div>
                <div class="mb-1 relative">
                    <label class="block text-gray-700 text-[15px]  mb-1" for="email">
                        Email *
                    </label>
                    <input
                        class="shadow appearance-none border  rounded w-full px-2 py-2.5 text-l text-gray-700 mb-1 leading-tight focus:outline-primary focus:shadow-outline"
                        id="email" type="email" placeholder="Email..." required
                        :class="{ 'border-red-500 bg-red-100': is_email }" v-model="emailUser" @change="is_email = false" >
                </div>
                <div class="text-red-500 text-sm mb-2">{{sms_error_email}}</div>
                <div class="mb-1 relative">
                    <label class="block text-gray-700 text-[15px]  mb-1" for="number">
                        Phone
                    </label>
                    <input
                        class="shadow appearance-none border  rounded w-full px-2 py-2.5 text-l text-gray-700 mb-1 leading-tight focus:outline-primary focus:shadow-outline"
                        id="phone" type="text" maxlength="10" placeholder="Tel..."
                        :class="{ 'border-red-500 bg-red-100': is_phone }" v-model="phone" @change="is_phone = false">
                </div>
                <div class="text-red-500 text-sm mb-2">{{sms_error_phone_number}}</div>

                <div class=" flex">
                    <div class="w-[50%] m-1 relative">
                        <label class="block text-gray-700 text-[15px] mb-1">Batch</label>
                        <input type="text" placeholder="e.g: 2022" 
                            class="shadow appearance-none border rounded w-full py-2.5 px-2 text-l text-gray-700 mb-1 leading-tight focus:outline-primary focus:shadow-outline"
                            :class="{ 'border-red-500 bg-red-100': is_generation }" v-model="batch"
                            @change="is_generation = false">
                        
                    </div>
                    <div class="w-[50%] m-1 relative">
                        <label class="block text-gray-700 text-[15px] mb-1">Class</label>
                        <input class="shadow appearance-none border  rounded w-full py-2.5 px-2 text-l text-gray-700 mb-1 leading-tight focus:outline-primary focus:shadow-outline" type="text" placeholder="e.g: WEB A "
                            :class="{ 'border-red-500 bg-red-100': is_choose_class }" v-model="choose_class"
                            @change="is_choose_class = false">
                    </div>
                    <div class="w-[50%] m-1">
                        <label class="block text-gray-700 text-[15px] mb-1">Personal ID:
                        </label>
                        <input
                            class="shadow appearance-none border  rounded w-full py-2.5 px-2 text-l text-gray-700 mb-1 leading-tight focus:outline-primary focus:shadow-outline"
                            id="number" type="text" placeholder="ID..."
                            :class="{ 'border-red-500 bg-red-100': is_personal_id }" v-model="personal_id"
                            @change="is_personal_id = false">
                    </div>
                </div>
                <div class="text-red-500 text-sm mb-2 flex justify-end">{{sms_error}}</div>

                <div class="w-[50%] m-1">
                    <label  class="block text-gray-700 text-[15px] mb-1">Gender</label>
                    <div class="flex">
                        <div class="flex items-center mb-4 ">
                            <input  type="radio" value="M"
                                class="w-4 h-4 bg-gray-100 border-gray-300   dark:ring-offset-gray-800 focus:ring-2" id="m"
                                v-model="gender">
                            <label 
                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="m"
                                >Male</label>
                        </div>
                        <div class="flex items-center mb-4 ml-2">
                            <input  type="radio" id="f" value="F"
                                class="w-4 h-4 bg-gray-100 border-gray-300   dark:ring-offset-gray-800 focus:ring-2"
                                v-model="gender">
                            <label
                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="f">Female</label>
                        </div>
                    </div>
                </div>
                
                <div class="flex ">
                    <div class="flex justify-end w-full ">
                        <button
                            class="bg-red-500 hover:bg-red-600  text-white p-2 px-3  rounded focus:outline-none focus:shadow-outline"
                            type="button" @click="$emit('close-popup')">
                            Cancel
                        </button>
                        <button
                            class="bg-primary hover:bg-blue-600 mx-2 text-white p-2 px-3 rounded focus:outline-none focus:shadow-outline"
                            type="button" @click="addStudent">
                            Add Student
                        </button>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from "../../axios-http"
export default {
    emits: ['add-student'],
    data() {
        return {
            password: '',
            email: '',
            phone: '',
            first_name: '',
            last_name: '',
            batch: '',
            choose_class: '',
            gender: '',
            personal_id: '',
            is_email: false,
            is_phone: false,
            is_first_name: false,
            is_last_name: false,
            is_generation: false,
            is_choose_class: false,
            is_gender: false,
            is_personal_id: false,
            sms_error_email: "",
            sms_error: "",
            list_users: [],
            sms_error_phone_number: ""
        }
    },
    computed: {
        emailUser() {
            if (this.first_name != '' && this.last_name != '') {
                this.email = this.first_name.toLowerCase() + '.' + this.last_name.toLowerCase() + '@student.passerellesnumeriques.org';
                return this.email;

            }
        }
    },
    methods: {
        generatePassword() {
            let chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
            let string_length = 8;
            let random_string = ""
            for (let i = 0; i < string_length; i++) {
                let rnum = Math.floor(Math.random() * chars.length)
                random_string += chars.substring(rnum, rnum + 1);
            }
            this.password = random_string;
        },
        toCapitalize(string) {
            return string[0].toUpperCase() + string.slice(1).toLowerCase();
        },
        async addStudent() {
            this.sms_error = ""
            let availableId = this.checkBatchAndPersonalId(this.batch,this.personal_id);
            if (this.checkFormValidation()) {
                this.generatePassword();
                if (this.phone[1] != '0' && this.phone[0] == '0' && this.phone.length >=9){
                    if(this.filterPhoneNumber() ){
                        if (availableId){
                            const linkToNotification = new URL(location.href).origin
                            var newStudent = {
                                first_name: this.toCapitalize(this.first_name),
                                last_name: this.toCapitalize(this.last_name),
                                personal_id: this.personal_id,
                                gender: this.gender,
                                email: this.email,
                                password: this.password,
                                batch: this.batch,
                                class: this.choose_class,
                                phone: this.phone,
                                linkTo: linkToNotification
                            };
                            try{
                                axios.post('/account/register', newStudent);
                                this.$emit('add-student');
                            } catch(err){
                                let error = err.response.data
                                let sms = "The email has already been taken." 
                                if (error.message == sms || error.message == sms + ' (and 1 more error)' || error == "Your email has existed"){
                                    this.is_email = true;
                                    this.sms_error_email = sms
                                }
                            }
                        }else{
                            this.sms_error = "Personal id has already been token";
                            this.is_personal_id = true;
                        }
                    }else{
                        this.is_phone = true;
                        this.sms_error_phone_number = "The phone has already been taken.";
                    }
                }else{
                        this.is_phone = true;
                        this.sms_error_phone_number = "Invalid phone number";
                    }
            }
        },
        checkFormValidation() {
                this.is_first_name = false
            if (this.first_name.trim() == '') {
                this.is_first_name = true
            }
                this.is_last_name = false
            if (this.last_name.trim() == '') {
                this.is_last_name = true
            }
                this.is_personal_id = false
            if (this.personal_id.trim() == '') {
                this.is_personal_id = true
            }
                this.is_gender = false
            if (this.gender == '') {
                this.is_gender = true
            }
                this.is_generation = false
            if (this.batch.trim() == '') {
                this.is_generation = true
            }
                this.is_choose_class = false
            if (this.choose_class.trim() == '') {
                this.is_choose_class = true
            }
                this.is_phone = false
            if (this.phone.trim() == ''  ) {
                this.is_phone = true
            }
                this.is_email = false
                this.sms_error_email = ""
            if (this.email.trim() == '' ) {
                this.is_email = true
            } else if (!(/@student.passerellesnumeriques.org\s*$/.test(this.email))){
                this.is_email = true
                this.sms_error_email = "Email must be passerellesnumeriques"
            }
            var message = true
            if (this.is_email || this.is_first_name || this.is_last_name || this.is_generation || this.is_gender  || this.is_choose_class || this.is_phone || this.is_personal_id) {
                message = false
            }
            return message
        },
        checkBatchAndPersonalId(batch,id){
            let newStudent = this.list_users.find(student=>student.batch == batch && student.personal_id == id);
            let sms = false;
            if (newStudent == undefined){
                sms = true;
            }
            return sms;
        },
        filterPhoneNumber(){
            let phoneNumber = this.list_users.find(student=>student.phone == this.phone);
            let sms = false;
            if (phoneNumber == undefined){
                sms = true;
            }
            return sms;
        }
    },
    created(){
        axios.get('users').then((res)=>{
            this.list_users = res.data.data;
        })
    }

}
</script>
