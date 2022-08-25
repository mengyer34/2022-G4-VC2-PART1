<template>
    <div tabindex="-1" class=" bg-[#0000005e] fixed  flex items-center z-50 md:inset-0 h-modal md:h-full ">
        <div class="relative w-[60%] m-auto bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex justify-between items-center bg-primary p-3 text-white rounded-t">
                <p></p>
                <h1 class="text-2xl text-center">Student Detail</h1>
                    <svg aria-hidden="true" @click="$emit('notViewDetail')" class="w-5 h-5 cursor-pointer" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </div>
            <div class="p-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img  :src="getImage(student_detail.profile_image)" alt="" class="rounded-full w-16 h-16 object-fill">
                        <p class="ml-2 font-bold text-lg">{{student_detail.first_name}} {{student_detail.last_name}}</p>
                    </div>
                    <div>
                        <button class="shadow rounded p-2 hover:bg-primary hover:text-white">                            
                            <svg xmlns="http://www.w3.org/2000/svg" @click="editStudent()" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="flex justify-between text-center">
                    <div class="rounded w-[49%] shadow h-auto p-3 mt-2">
                        <div class="inline-block p-2 rounded shadow w-60 font-bold">Personal Detail</div>
                        <div class="text-left mt-4">
                            <div class="flex items-center mt-1">
                                <div class="inline-block p-2 rounded shadow w-28">First name</div>
                                <input v-if="isClickEdit" type="text" class="ml-6 inline-block p-2 rounded shadow w-[60%] outline-none border border-gray-400 focus:shadow-outline focus:border-primary" v-model="student_detail.first_name" >
                                <div v-else class="ml-6 inline-block p-2 rounded shadow w-[60%] break-words">{{student_detail.first_name}}</div>
                            </div>
                            <div class="flex items-center mt-1">
                                <div class="inlin-block p-2 rounded shadow w-28">Last name</div>
                                <input v-if="isClickEdit" type="text" class="ml-6 focus:shadow-outline focus:border-primary  inline-block p-2 rounded shadow w-[60%] outline-none border border-gray-400 " v-model="student_detail.last_name" >
                                <div v-else class="ml-6 inline-block p-2 rounded shadow w-[60%] break-words">{{student_detail.last_name}}</div>
                            </div>
                            <div class="flex items-center mt-1">
                                <div class="inlin-block p-2 rounded shadow w-28">Gender</div>
                                <input v-if="isClickEdit"  type="text" class="ml-6 focus:shadow-outline focus:border-primary inline-block p-2 rounded shadow w-[60%] outline-none border border-gray-400 " v-model="student_detail.gender" >
                                <div v-else class="ml-6 inline-block p-2 rounded shadow w-[60%]">{{student_detail.gender}}</div>
                            </div>
                            <div class="flex items-center mt-1">
                                <div class="inlin-block p-2 rounded shadow w-28">Tel</div>
                                <input v-if="isClickEdit"  type="text" class="ml-6 focus:shadow-outline focus:border-primary inline-block p-2 rounded shadow w-[60%] outline-none border border-gray-400 " v-model="student_detail.phone" >
                                <div v-else class="ml-6 inline-block p-2 rounded shadow w-[60%]">{{student_detail.phone}}</div>
                            </div>
                            <p v-if="isInvalidPhoneNumber" class="text-red-500 text-center mb-2 ml-14 text-sm">Invalid phone number</p>
                            <div class="mt-1 " :class="{'flex items-center':!isClickEdit}">
                                <div class="inlin-block p-2 rounded shadow w-28">Gmail</div>
                                <input  v-if="isClickEdit"  class="mt-2  focus:shadow-outline focus:border-primary inline-block p-2 rounded shadow w-full outline-none border border-gray-400 " v-model="student_detail.email" type="email">
                                <div v-else class="ml-6 inline-block p-2 rounded shadow w-[60%]break-words">{{student_detail.email}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="rounded w-[49%] shadow h-auto p-3 mt-2 ">
                        <div class="inline-block p-2 rounded shadow w-60 font-bold">Class Detail</div>
                        <div class="text-left mt-4">
                            <div class="flex items-center mt-1">
                                <div class="inlin-block p-2 rounded shadow w-28">Student Id</div>
                                <input v-if="isClickEdit" type="text"  class="ml-6 focus:shadow-outline focus:border-primary inline-block p-2 rounded shadow w-[60%] outline-none border border-gray-400 " v-model="student_detail.personal_id" >
                                <div v-else class="ml-6 inline-block p-2 rounded shadow w-[60%]">{{student_detail.personal_id}}</div>
                                
                            </div>
                            <div class="flex items-center mt-1">
                                <div class="inline-block p-2 rounded shadow w-28">Generation</div>
                                <input v-if="isClickEdit" type="text" class="focus:shadow-outline focus:border-primary ml-6 inline-block p-2 rounded shadow w-[60%] outline-none border border-gray-400 " v-model="student_detail.generation" >
                                <div v-else class="ml-6 inline-block p-2 rounded shadow w-[60%]">{{student_detail.generation}}</div>
                            </div>
                            <div class="flex items-center mt-1">
                                <div class="inlin-block p-2 rounded shadow w-28">Class</div>
                                <input v-if="isClickEdit" type="text"  class="ml-6 focus:shadow-outline focus:border-primary inline-block p-2 rounded shadow w-[60%] outline-none border border-gray-400 " v-model="student_detail.class" >
                                <div v-else class="ml-6 inline-block p-2 rounded shadow w-[60%] upppercase">{{student_detail.class}}</div>
                            </div>
                            <div class="mt-1 flex items-center">
                                <div class="inline-block p-2 rounded shadow w-28">Leaves</div>
                                <div class="ml-6 inlin-block p-2 rounded shadow w-[60%] ">{{student_detail.leaves.length}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="isClickEdit" class="flex justify-end p-2">
                <button class="p-2 px-4 bg-red-500 rounded shadow text-white" @click="isClickEdit=false">Cancel</button>
                <button class="p-2 px-4 bg-primary rounded shadow text-white ml-2" @click="saveEditStudent(student_detail.id)">Save Change</button>
            </div>
        </div>
    </div>
</template>

<script>
const url = 'http://127.0.0.1:8000/api/'
export default ({
    props: {
        student_detail: Object
    },
    emits: ['save-edit'],
    data() {
        return {
            isClickEdit: false,
            // first_name: ''
            isInvalidPhoneNumber: false
        }
    },
    methods: {
        editStudent(){
            this.isClickEdit = true;
        },
        saveEditStudent(id){
            let studentEdit = this.student_detail;
            console.log(studentEdit.phone);
            if (studentEdit.phone[1] != '0' && studentEdit.phone[0] == '0' && studentEdit.phone.length < 11){
                console.log(studentEdit.phone[1]);
                let newObject = {first_name: studentEdit.first_name,last_name:studentEdit.last_name,gender:studentEdit.gender, email: studentEdit.email, personal_id: studentEdit.personal_id, generation: studentEdit.generation, class: studentEdit.class, phone: studentEdit.phone}
                this.isClickEdit = false
                this.isInvalidPhoneNumber = false;
                alert("Edit successful")
                return this.$emit('save-edit',newObject,id);
            }else{
                this.isInvalidPhoneNumber = true;
            }
        },

        getImage(imageName) {
            console.log('StuDetails');
            return url +'storage/image/' + imageName;
        }
    }
})
</script>
