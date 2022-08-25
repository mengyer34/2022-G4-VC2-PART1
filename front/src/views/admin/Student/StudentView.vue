<template>
    <div>
        <div v-if="!isViewDetail" class="w-full sm:px-6 mt-24">
            <h1 class="text-2xl font-semibold my-9">STUDENT INFORMATION</h1>
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
                            <search-bar @update-keyword="updateKeyword" />
                        </div>
                        <div class="w-32 flex justify-end">
                            <button class="text-white bg-orange-500 py-2 px-4 rounded border-none">Add Student</button>
                        </div>
                    </div>
                    <student-lists :students="batchFilter" @popUp="popUp" @viewDetail="viewStudentDetail"/>      
                </div>
                <alert-dialog v-if="isPop" @closePopup="isPop=false" @deleteStudent="deleteStudent"/> 
            </div>
        </div>
        <div v-else>
            <student-detail @notViewDetail="isViewDetail=false" :student_detail="student_detail" :students="students" @save-edit="saveEditStudent"/> 
        </div>
    </div>
</template>

<script>
import axios from '../../../axios-http.js'
import StudentListView from '../../../components/StudentList/StudentListView.vue'
import alertDeleteDialog from '../../../components/StudentList/StudentDeleteAlert.vue'
import SearchBar from './../../../components/search/SearchBar.vue';
import studentDetail from '../../../components/StudentList/StudentDetail.vue'
const url = 'http://localhost:8000/api/'
export default {
    components: {
        'student-lists': StudentListView,
        'alert-dialog':alertDeleteDialog,
        'search-bar': SearchBar,
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
            searchKeyword: '',
        }
    },
    computed: {
        batchFilter() {
            if (this.search != '') {
                if (this.batch != 'All') {
                    return this.students.filter(student => student.generation == this.batch && (student.first_name.toLowerCase().includes(this.searchKeyword.toLowerCase()) || student.last_name.toLowerCase().includes(this.searchKeyword.toLowerCase())))
                }else {
                    return this.students.filter(student => student.first_name.toLowerCase().includes(this.searchKeyword.toLowerCase()) || student.last_name.toLowerCase().includes(this.searchKeyword.toLowerCase()))
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
        updateKeyword(keyword) {
            this.searchKeyword = keyword;
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