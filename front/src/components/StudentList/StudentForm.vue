<template>
    <div tabindex="-1" class=" bg-[#0000005e] fixed  flex items-center z-50 md:inset-0 h-modal md:h-full ">
        <div class="modal bg-white h-[95%] shadow-md rounded px-8 pt-6  mt-6 mb-10 m-auto w-[50%] z-10">

            <form class=" rounded-b-md">
                <div class="flex justify-between items-center">
                    <p></p>
                    <h1 class="text-[20px] font-semibold text-[#0081CA] text-cente">Add New Student</h1>
                    <svg aria-hidden="true" @click="$emit('closePopup')" class="w-5 h-5 cursor-pointer"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>

                <div class="mb-1 relative">
                    <label class="block text-gray-700 text-[15px]  mb-1" for="email">
                        Email *
                    </label>
                    <input
                        class="shadow appearance-none border border-gray-400  rounded w-full py-2 px-2 text-l text-gray-700 mb-1 leading-tight focus:outline-primary focus:shadow-outline"
                        id="email" type="email" placeholder="Email..."
                        :class="{ 'border-red-500 bg-red-100': is_email }" v-model="email" @change="is_email = false">
                </div>
                <div class="mb-1 relative">
                    <label class="block text-gray-700 text-[15px]  mb-1" for="number">
                        Phone
                    </label>
                    <input
                        class="shadow appearance-none border border-gray-400  rounded w-full py-2 px-2 text-l text-gray-700 mb-1 leading-tight focus:outline-primary focus:shadow-outline"
                        id="phone" type="text" placeholder="number..."
                        :class="{ 'border-red-500 bg-red-100': is_phone }" v-model="phone" @change="is_phone = false">
                </div>
                <div>

                </div>
                <div class="mb-1 relative">
                    <label class="block text-gray-700 text-[15px]  mb-1" for="password">
                        Password
                    </label>
                    <div>

                        <input
                            class="shadow appearance-none border border-gray-400 rounded w-[80%] py-2 px-2 text-l text-gray-700 leading-tight focus:outline-primary focus:shadow-outline"
                            id="username" :type="password" v-model="random_string" placeholder=" password.."
                            :class="{ 'border-red-500 bg-red-100': is_random_string }">
                        <svg v-if="password == 'password'" xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 absolute top-[40px] ml-[400px] text-gray-400 hover:cursor-pointer"
                            @click="showPassword" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z"
                                clip-rule="evenodd" />
                            <path
                                d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                        </svg>
                        <svg v-else xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 absolute top-[40px] ml-[400px] text-gray-400 hover:cursor-pointer"
                            @click="showPassword" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd"
                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <button
                            class="bg-orange-500 hover:bg-red-400  text-white ml-6 py-2 px-3 text-[15px] rounded focus:outline-primary focus:shadow-outline"
                            type="button" @click="generatePW">
                            Generate
                        </button>
                    </div>
                </div>

                <div class="mb-1 flex">
                    <div class="w-[50%] m-1">
                        <label class="block text-gray-700 text-[15px] mb-1">
                            First Name
                        </label>
                        <input
                            class="shadow appearance-none border border-gray-400  rounded w-full py-2 px-2 text-l text-gray-700 mb-1 leading-tight focus:outline-primary focus:shadow-outline"
                            type="text" placeholder="first name..."
                            :class="{ 'border-red-500 bg-red-100': is_first_name }" v-model="first_name"
                            @change="is_first_name = false">
                    </div>
                    <div class="w-[50%] m-1">
                        <label class="block text-gray-700 text-[15px] mb-1">
                            Last Name
                        </label>
                        <input
                            class="shadow appearance-none border border-gray-400  rounded w-full py-2 px-2 text-l text-gray-700 mb-1 leading-tight focus:outline-primary focus:shadow-outline"
                            type="text" placeholder="last name..."
                            :class="{ 'border-red-500 bg-red-100': is_last_name }" v-model="last_name"
                            @change="is_last_name = false">
                    </div>
                </div>
                <div class="mb-2 flex">
                    <div class="w-[50%] m-1">
                        <label for="countries" class="block text-gray-700 text-[15px] mb-1">Batch</label>
                        <select id="countries"
                            class="shadow appearance-none border border-gray-400  rounded w-full py-2 px-2 text-l text-gray-700 mb-1 leading-tight focus:outline-primary focus:shadow-outline"
                            :class="{ 'border-red-500 bg-red-100': is_generation }" v-model="generation"
                            @change="is_generation = false">
                            <option selected disabled>Batch</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                        </select>
                    </div>
                    <div class="w-[50%] m-1">
                        <label for="countries" class="block text-gray-700 text-[15px] mb-1">Class</label>
                        <select id="countries"
                            class="shadow appearance-none border border-gray-400  rounded w-full py-2 px-2 text-l text-gray-700 mb-1 leading-tight focus:outline-primary focus:shadow-outline"
                            :class="{ 'border-red-500 bg-red-100': is_choose_class }" v-model="choose_class"
                            @change="is_choose_class = false">
                            <option selected disabled>Choose Class</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="WebA">WEB A</option>
                            <option value="WebB">WEB B</option>
                            <option value="SNA">WEB C</option>
                        </select>
                    </div>
                    <div class="w-[50%] m-1">
                        <label for="countries" class="block text-gray-700 text-[15px] mb-1">Personal ID:
                        </label>
                        <input
                            class="shadow appearance-none border border-gray-400  rounded w-full py-2 px-2 text-l text-gray-700 mb-1 leading-tight focus:outline-primary focus:shadow-outline"
                            id="number" type="text" placeholder="ID..."
                            :class="{ 'border-red-500 bg-red-100': is_personal_id }" v-model="id"
                            @change="is_personal_id = false">
                    </div>
                </div>
                <div class="w-[50%] m-1">
                    <label for="countries" class="block text-gray-700 text-[15px] mb-1">Gender</label>
                    <div class="flex">
                        <div class="flex items-center mb-4 ">
                            <input id="default-radio-1" type="radio" value="M" name="default-radio"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                v-model="gender">
                            <label for="default-radio-1"
                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                >Male</label>
                        </div>
                        <div class="flex items-center mb-4 ml-2">
                            <input id="default-radio-2" type="radio" value="F" name="default-radio"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                v-model="gender">
                            <label for="default-radio-2"
                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Female</label>
                        </div>
                    </div>
                </div>

                <div class="flex ">
                    <div class="flex justify-end w-full ">
                        <button
                            class="bg-red-500 hover:bg-red-400  text-white py-1 px-2 text-l rounded focus:outline-none focus:shadow-outline"
                            type="button" @click="$emit('close-popup')">
                            Cancel
                        </button>
                        <button
                            class="bg-primary hover:bg-blue-500 mx-2 text-white py-1 px-2 text-l rounded focus:outline-none focus:shadow-outline"
                            type="button" @click="addStudent">
                            Add Student
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    emits: ['add-student'],
    data() {
        return {
            random_string: '',
            password: 'password',
            email: '',
            phone: '',
            first_name: '',
            last_name: '',
            generation: '',
            choose_class: '',
            gender: '',
            id: '',
            is_random_string: false,
            is_password: false,
            is_email: false,
            is_phone: false,
            is_first_name: false,
            is_last_name: false,
            is_generation: false,
            is_choose_class: false,
            is_gender: false,
            is_personal_id: false,
            student: []
        }
    },
    computed: {
        generatePW() {
            let chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
            let string_length = 8;
            for (let i = 0; i < string_length; i++) {
                let rnum = Math.floor(Math.random() * chars.length)
                this.random_string += chars.substring(rnum, rnum + 1);
            }
            console.log(this.random_string);
            this.is_random_string = false
        },
    },
    methods: {
        showPassword() {
            if (this.password == "password") {
                this.password = "text";
            } else {
                this.password = "password"
            }
        },
        addStudent() {
            if (this.checkFormValidation()) {
                var newStudent = {
                    first_name: this.first_name,
                    last_name: this.last_name,
                    personal_id: this.id,
                    gender: this.gender,
                    email: this.email,
                    password: this.random_string,
                    generation: this.generation,
                    class: this.choose_class,
                    phone: this.phone
                }
                this.$emit('add-student', newStudent);
            } else {
                alert("Not enough requirement")
            }
        },
        checkFormValidation() {
            if (this.random_string == '') {
                this.is_random_string = true
            }
            if (this.first_name == '') {
                this.is_first_name = true
            }
            if (this.last_name == '') {
                this.is_last_name = true
            }
            if (this.id == '') {
                this.is_personal_id = true
            }
            if (this.gender == '') {
                this.is_gender = true
            }
            if (this.generation == '') {
                this.is_generation = true
            }
            if (this.choose_class == '') {
                this.is_choose_class = true
            }
            if (this.phone == '') {
                this.is_phone = true
            }
            if (this.email == '') {
                this.is_email = true
            }
            var message = true
            if (this.is_email || this.is_first_name || this.is_last_name || this.is_generation || this.is_gender || this.is_random_string || this.is_choose_class || this.is_phone) {
                message = false
            }
            return message
        }
    }
}
</script>

<style>
</style>