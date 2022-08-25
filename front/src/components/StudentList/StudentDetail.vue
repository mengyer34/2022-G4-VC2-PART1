<template>
    <div class="p-3 transition-opacity" id="card-detail">
        <div class="relative w-full m-auto mt-16   h-auto rounded">
            <div class="flex justify-between items-center bg-primary p-3 text-white rounded-t">
                <svg xmlns="http://www.w3.org/2000/svg" @click="$emit('notViewDetail')" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                </svg>
                <h1 class="text-2xl text-center">Student Detail</h1>
                <p></p>
            </div>

            <div class="bg-[#ddd] p-3">
                <div v-if="isEditSuccess" class="alert-success p-2 rounded bg-green-400 border border-green-500 text-white flex items-center justify-between">Edited student successfull
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5  h-5 cursor-pointer " @click="isEditSuccess=false">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m-15 0l15 15" />
                    </svg>
                </div>
                <div class="flex mt-3">
                    <div class="rounded shadow bg-white shadow-gray-400 w-[26%] text-center relative p-2">
                        <div class="">
                            <img  :src="getImage(student_detail.profile_image)" alt="" class="rounded-full w-32 h-32 object-fill m-auto">
                            <p class="font-bold mt-2 text-2xl break-words">{{detail_student_list.first_name}} {{detail_student_list.last_name}}</p>
                        </div>
                        <div>
                            <button class="shadow rounded p-2 hover:bg-primary hover:text-white">                            
                                <svg xmlns="http://www.w3.org/2000/svg" @click="editStudent()" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                        </div>
                        <div v-if="isClickEdit" class="flex justify-center absolute p-2 bottom-1 m-auto w-full">
                            <button class="p-2 px-4 bg-red-500 rounded shadow text-white" @click="isClickEdit=false">Cancel</button>
                            <button class="p-2 px-4 bg-primary rounded shadow text-white ml-2" @click="saveEditStudent(student_detail.id)">Save Change</button>
                        </div>
                    </div>  
                    <div class="ml-4 bg-white shadow-gray-400 shadow rounded  w-[74%] p-2">
                        <div class="flex justify-between text-center ">
                            <div class=" w-[49%] h-auto">
                                <div class="flex items-center mt-1 p-2 rounded border border-b-gray-300">
                                    <div class="text-lg">First name</div>
                                    <input v-if="isClickEdit" type="text" class="ml-14 inline-block p-2 rounded shadow w-[60%] border border-gray-300 focus:shadow-outline focus:outline-[#0081CA]" v-model="student_edit.first_name" >
                                    <div v-else class="ml-12 inline-block text-gray-500">{{detail_student_list.first_name}}</div>
                                </div>
                                <div class="flex items-center mt-1 p-2 rounded border border-b-gray-300">
                                    <div class="text-lg">Last name</div>
                                    <input v-if="isClickEdit" type="text" class="ml-14 focus:shadow-outline focus:outline-[#0081CA]  inline-block p-2 rounded shadow w-[60%] border border-gray-300 " v-model="student_edit.last_name" >
                                    <div v-else class="ml-12 inline-block text-gray-500">{{detail_student_list.last_name}}</div>
                                </div>
                                <div class="flex items-center mt-1 p-2 rounded border border-b-gray-300">
                                    <div class="text-lg">Gender</div>
                                    <input v-if="isClickEdit" type="text" class="ml-20 focus:shadow-outline focus:outline-[#0081CA]  inline-block p-2 rounded shadow w-[60%] border border-gray-300 " v-model="student_edit.gender">
                                    <div v-else class="ml-16 inline-block text-gray-500">{{detail_student_list.gender}}</div>
                                </div>
                                <div class="flex items-center mt-1 p-2 rounded border border-b-gray-300">
                                    <div class="text-lg">Tel</div>
                                    <input v-if="isClickEdit" type="text" class="ml-28 focus:shadow-outline focus:outline-[#0081CA]  inline-block p-2 rounded shadow w-full border border-gray-300 " v-model="student_edit.phone">
                                    <div v-else class="ml-[100px] inline-block text-gray-500">{{detail_student_list.phone}}</div>
                                </div>
                                <p v-if="isInvalidPhoneNumber" class="text-red-500 text-center mb-2 ml-14 text-sm">Invalid phone number</p>
                            </div>
                            <div class=" w-[49%] h-auto">
                                <div class="flex items-center mt-1 p-2 rounded border border-b-gray-300">
                                    <div class="text-lg">Student Id</div>
                                    <input v-if="isClickEdit" type="text" class="ml-8 focus:shadow-outline focus:outline-[#0081CA]  inline-block p-2 rounded shadow w-[60%] border border-gray-300 " v-model="student_edit.personal_id" >
                                    <div v-else class="ml-12 inline-block text-gray-500">{{detail_student_list.personal_id}}</div>
                                </div>
                                <div class="flex items-center mt-1 p-2 rounded border border-b-gray-300">
                                    <div class="text-lg">Generation</div>
                                    <input v-if="isClickEdit" type="text" class="ml-8 focus:shadow-outline focus:outline-[#0081CA]  inline-block p-2 rounded shadow w-[70%] border border-gray-300 " v-model="student_edit.generation" >
                                    <div v-else class="ml-12 inline-block text-gray-500">{{detail_student_list.generation}}</div>
                                </div>
                                <div class="flex items-center mt-1 p-2 rounded border border-b-gray-300">
                                    <div class="text-lg">Class</div>
                                    <input v-if="isClickEdit" type="text" class="ml-20 focus:shadow-outline focus:outline-[#0081CA]  inline-block p-2 rounded shadow w-[70%] border border-gray-300 " v-model="student_edit.class">
                                    <div v-else class="ml-24 inline-block text-gray-500">{{detail_student_list.class}}</div>
                                </div>
                                <div class="flex items-center mt-1 p-2 rounded border border-b-gray-300">
                                    <div class="text-lg">Leaves</div>
                                    <div class="ml-20 inline-block text-gray-500">{{student_detail.leaves.length}}</div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="flex mt-1 items-cente p-2 rounded border border-b-gray-300 w-full m-auto">
                                <div class="text-lg">Gmail</div>
                                <input v-if="isClickEdit" type="email" class="ml-20 focus:shadow-outline focus:outline-[#0081CA]  inline-block p-2 rounded shadow w-full border border-gray-300 " v-model="student_edit.email">
                                <div v-else class="ml-[78px] inline-block text-gray-500">{{detail_student_list.email}}</div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="shadow-gray-400 mt-3 p-3 bg-white shadow rounded w-full" v-if="student_detail.leaves.length > 0">
                        <div class="text-1xl font-bold ml-4 uppercase">Student Leave Request</div>
                        <table class=" w-full m-auto">
                            <thead>
                                <tr tabindex="0" class="focus h-16 w-full text-sm leading-none text-primary border-b-2 border-primary">
                                    <th class="font-bold text-center">Reason</th>
                                    <th class="font-bold text-center">Leave type</th>
                                    <th class="font-bold text-center">Start Date</th>
                                    <th class="font-bold text-center">End Date</th>
                                    <th class="font-bold text-center">Duration</th>
                                    <th class="font-bold text-center">Status</th>
                                    <th class="font-bold text-center">Request Date</th>
                                </tr>
                            </thead>
                            <tbody class="w-full m-auto">
                                <tr  v-for="leave of student_detail.leaves" :key="leave" tabindex="0" class="focus h-20 text-sm leading-none text-gray-800 border-b border-t border-gray-300">
                                    <td class="text-center ">
                                        <div class="flex items-center">
                                            <p class="font-medium cursor-pointer truncate w-16 hover:whitespace-pre-wrap  hover:absolute hover:font-normal hover:bg-gray-200 hover:p-3 hover:rounded hover:w-2/12" v-if="leave.reason.length > 8">{{leave.reason}}</p>
                                            <p v-else>{{leave.reason}}</p>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        {{leave.leave_type}}
                                    </td>
                                    <td class="text-center">
                                        {{leave.start_date}} ({{leave.start_time}})
                                    </td>
                                    <td class="text-center">
                                        {{leave.end_date}} ({{leave.end_time}})
                                    </td>
                                    <td class="text-center">
                                        <p class="font-medium">{{leave.duration}}</p>
                                    </td>
                                    <td class="text-center">
                                        <span class ="px-4 py-2 rounded-full text-white" :class="{'bg-red-500':leave.status=='Rejected', 'bg-green-500':leave.status == 'Approved', 'bg-yellow-500':leave.status ==  'Pending'}">{{leave.status}}</span>
                                    </td>
                                    <td class="text-center">
                                        <span>{{leave.created_at}}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div v-else class=" mt-6 flex items-center justify-center w-full">
                        <div class="text-center">
                            <img class="w-32" src="../../assets/request_empty.png" alt="Image not found">
                            <td colspan="7" class="p-2 text-center">No leaves Found!!</td>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
const url = 'http://127.0.0.1:8000/api/'
export default ({
    props: {
        student_detail: Object,
        students: Array
    },
    emits: ['save-edit'],
    data() {
        return {
            isClickEdit: false,
            isInvalidPhoneNumber: false,
            student_edit: {},
            detail_student_list: this.student_detail,
            isEditSuccess: false
        }
    },
    methods: {
        editStudent(){
            this.isClickEdit = true;
            this.student_edit = {
                first_name: this.detail_student_list.first_name,
                last_name: this.detail_student_list.last_name,
                gender: this.detail_student_list.gender,
                email: this.detail_student_list.email,
                class: this.detail_student_list.class,
                generation: this.detail_student_list.generation,
                phone: this.detail_student_list.phone,
                personal_id: this.detail_student_list.personal_id
            }
        },
        saveEditStudent(id){
            let student_edited = this.student_edit;
            if (student_edited.phone[1] != '0' && student_edited.phone[0] == '0' && student_edited.phone.length < 11 &&student_edited.phone.length > 8){

                    if (this.filterStudentId(student_edited.personal_id)){
                        this.isInvalidPhoneNumber = false;
                        this.isClickEdit = false;
                        this.isEditSuccess = true;
                        let new_update = {
                            first_name: student_edited.first_name,
                            last_name: student_edited.last_name,
                            gender: student_edited.gender,
                            email: student_edited.email,
                            class: student_edited.class,
                            generation: student_edited.generation,
                            phone: student_edited.phone,
                            personal_id: student_edited.personal_id
                        }
                        this.detail_student_list = new_update;
                        return this.$emit('save-edit',new_update,id);
                    }else{
                        alert("Personal Id already exist!")
                    }
            }else{
                this.isInvalidPhoneNumber = true;
            }
        },

        getImage(imageName) {
            console.log('StuDetails');
            return url +'storage/image/' + imageName;
        },

        filterStudentId(id){
            let find = this.students.filter((student)=>student.personal_id == id && student.personal_id != this.student_detail.personal_id);
            console.log(find, "Hello");
            let sms = true
            if (find.length >= 1){
                sms = false
            }
            return sms
        },
    },
})
</script>
<style scoped>
    #card-detail ,.alert-success{
            -webkit-animation: fadeIn .6s ease-out;
            -moz-animation: fadeIn .6s ease-out;
            -o-animation: fadeIn .6s ease-out;
            animation: fadeIn .6s ease-out;
    }
    @-webkit-keyframes fadeIn { 
    0% { opacity: 0; }
    20% { opacity: 0; }
    40% { opacity: 0.3; }
    60% { opacity: 0.5; }
    80% { opacity: 0.9; }
    100% { opacity: 1; }
    }

    @keyframes fadeIn {
    0% { opacity: 0; }
    20% { opacity: 0; }
    40% { opacity: 0.3; }
    60% { opacity: 0.5; }
    80% { opacity: 0.9; }
    100% { opacity: 1; }
    }
</style>