<template>
    <div class="w-full sm:px-6 mt-24">
        <h1 class="text-lg font-semibold">STUDENT INFORMATION</h1>
        <div class="bg-white mt-4 p-3 rounded">
            <div>
                <label for="filter-status text-sm leading-none text-gray-800"><span class="text-red-600">*</span>Batch:</label><br>
                <div class="flex justify-between w-full">
                    <select v-model="batch" name="" id="filter-status" class="w-[20%] rounded border p-2 focus:outline-none focus:border-primary">
                        <option value="All">All</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                    </select>
                    <div class="w-[60%] relative flex">
                        <input v-model="search" class="p-2 focus:border-primary outline-none rounded-l border border-gray-300 w-full" type="text" placeholder="Student name...">
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
                <student-lists :students="batchFilter" @popUp="popUp" @viewDetail="viewStudentDetail"/>      
                <student-detail v-if="isViewDetail" @notViewDetail="isViewDetail=false" :student_detail="student_detail" @save-edit="saveEditStudent"/> 
                <alert-dialog v-if="isPop" @closePopup="isPop=false" @deleteStudent="deleteStudent"/> 
            </div>
        </div>

    </div>
</template>

<script>
import axios from '../../../axios-http.js'
import StudentListView from '../../../components/StudentList/StudentListView.vue'
import alertDeleteDialog from '../../../components/StudentList/StudentDeleteAlert.vue'
import studentDetail from '../../../components/StudentList/StudentDetail.vue'
const url = 'http://localhost:8000/api/'
export default {
    components: {
        'student-lists': StudentListView,
        'alert-dialog':alertDeleteDialog,
        'student-detail': studentDetail,
    },
    data() {
        return {
            students: [],
            isPop: false,
            id: null,
            isViewDetail: false,
            student_detail: {},
            batch: 'All',
            search: '',
        }
    },
    computed: {
        batchFilter() {
            if (this.search != '') {
                if (this.batch != 'All') {
                    return this.students.filter(student => student.generation == this.batch && (student.first_name.toLowerCase().includes(this.search.toLowerCase()) || student.last_name.toLowerCase().includes(this.search.toLowerCase())))
                }else {
                    return this.students.filter(student => student.first_name.toLowerCase().includes(this.search.toLowerCase()) || student.last_name.toLowerCase().includes(this.search.toLowerCase()))
                }
            }else {
                if (this.batch != 'All') {
                    return this.students.filter(student => student.generation == this.batch);
                }else {
                    return this.students;
                }
            }
        }
    },
    methods: {
        getStudent() {
            axios.get(url + 'users_leaves').then(res => {
                this.students = res.data.data;
            })
        },   
        deleteStudent() {
            axios.delete(url + 'users/' + this.id).then(res => {
                this.getStudent();
            })
            this.isPop = !this.isPop;
        },
        popUp(id) {
            this.isPop = true;
            this.id = id;
        },
        viewStudentDetail(id){
            this.student_detail = this.students.find((student)=>student.id == id);
            this.isViewDetail = true
        },
        saveEditStudent(object,id){
            axios.put(url + "users/" + id,object).then((res)=>{
                this.getStudent()
            })
        }
    },
    mounted() {
        this.getStudent();
    },
}
</script>