<template>
    <div>
        <div v-if="!isViewDetail" class="w-full sm:px-6 mt-24">
            <div v-if="isCreatedSuccess"
                class="alert-success p-2 rounded bg-green-600 border  text-white flex items-center justify-between">
                Student was created successfull
            </div>
            <h1 class="text-2xl font-semibold my-4">STUDENT INFORMATION</h1>
            <div class="bg-white mt-4 p-3 rounded bg-opacity-70">
                <div>
                    <label for="filter-status text-sm leading-none text-gray-800"><span
                            class="text-red-600">*</span>Batch:</label><br>
                    <div class="flex justify-between w-full">
                        <select v-model="batch" name="" id="filter-status"
                            class="w-[20%] rounded  p-2 focus:outline-none focus:border-2 focus:border-primary border border-gray-400">
                            <option value="All">All</option>
                            <option :value="generation" v-for="generation of getBatch" :key="generation">{{ generation }}
                            </option>
                        </select>
                        <div class="w-[60%] relative flex">
                            <search-bar @update-keyword="updateKeyword" />
                        </div>

                        <div class="w-10 relative rounded bg-green-500 hover:bg-green-600" >
                            <img src="../../../assets/excel.svg" alt="" class="p-2 excel-icon cursor-pointer" @click="downloadFile">
                            <p class="downlaod opacity-0 inline-block bg-[#ddd] left-2 -top-12 text-center w-40 p-2 absolute rounded">Download as excel</p>
                        </div>
                        <div class="w-32 flex justify-end">
                            <button class="text-white bg-orange-500 hover:bg-orange-600 py-2 px-4 rounded border-none"
                                @click="showFormAddStudent">Add Student</button>
                        </div>
                    </div>
                </div>
                <student-lists :isUpdating= "isUpdating" :allStudents="students" :isGettingResources="isGettingResources" :students="batchFilter" @popUp="popUp" @viewDetail="viewStudentDetail"/>      
            </div>
            <div>

                <alert-dialog v-if="isPop" @closePopup="isPop=false" @deleteStudent="deleteStudent"/>
                <form-student v-if="isShow" @close-popup="isShow = false" @add-student="addNewStudent"/>
            </div>
        </div>
        <div v-else>
            <student-detail @notViewDetail="isViewDetail = false" :student_detail="student_detail" :students="students"
                @save-edit="saveEditStudent" />
        </div>
    </div>
</template>

<script>
import StudentListView from '../../../components/StudentList/StudentListView.vue'
import alertDeleteDialog from '../../../components/StudentList/StudentDeleteAlert.vue'
import SearchBar from './../../../components/search/SearchBar.vue';
import studentDetail from '../../../components/StudentList/StudentDetail.vue'
import studentForm from "../../../components/StudentList/StudentForm.vue"
import exportFromJSON from "export-from-json";
import axios from '../../../axios-http.js'
export default {
    components: {
        'student-lists': StudentListView,
        'alert-dialog': alertDeleteDialog,
        'search-bar': SearchBar,
        'student-detail': studentDetail,
        "form-student": studentForm
    },
    data() {
        return {
            students: [],
            isPop: false,
            id: null,
            isViewDetail: false,
            student_detail: {},
            batch: "All",
            searchKeyword: '',
            isShow: false,
            isCreatedSuccess: false,
            isGettingResources: true,
            isUpdating: false,
        }
    },
    computed: {
        batchFilter() {
            if (this.searchKeyword != '') {
                if (this.batch != 'All') {
                    return this.students.filter(student => student.batch == this.batch && (student.first_name.toLowerCase().includes(this.searchKeyword.toLowerCase()) || student.last_name.toLowerCase().includes(this.searchKeyword.toLowerCase())))
                } else {
                    return this.students.filter(student => student.first_name.toLowerCase().includes(this.searchKeyword.toLowerCase()) || student.last_name.toLowerCase().includes(this.searchKeyword.toLowerCase()))
                }
            } else {
                if (this.batch != 'All') {
                    return this.students.filter(student => student.batch == this.batch);
                } else {
                    return this.students;
                }
            }
        },
        getBatch() {
            let generations = []
            for (let student of this.students) {
                generations.push(student.batch)
            }
            let batches = [...new Set(generations)];
            return batches.sort();
        },
    },
    methods: {
        getStudent() {
            axios.get('users_leaves').then(res => {
                this.students = res.data.data.reverse();
                this.isGettingResources = false;
                this.isUpdating = false;
            })
        },
        deleteStudent() {
            this.isUpdating = true;
            axios.delete('/users/' + this.id).then((res) => {
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
        viewStudentDetail(id) {
            this.student_detail = this.students.find((student) => student.id == id);
            this.isViewDetail = true
        },

        saveEditStudent(object,id){
            this.isUpdating = true;
            axios.put("/users/" + id,object).then((res)=>{
                this.getStudent()
            })
        },
        showFormAddStudent() {
            this.isShow = true
        },
        closePopup() {
            this.isShow = false
        },
        addNewStudent(){
            this.isUpdating = true;
            this.getStudent()
            this.closePopup()
            this.successAlert()
        },
        downloadFile() {
            const datas = []
            let students = this.students;
            if (this.batch != 'All') {
                students = this.students.filter(student => student.batch == this.batch);
            }
            students = students.sort((a, b) => {
                if(a.personal_id < b.personal_id) { return -1; }
                if(a.personal_id > b.personal_id) { return 1; }
                return 0;
            })
            for (let student of students) {
                datas.push({
                    Personal_id: student.personal_id,
                    FirstName: student.first_name,
                    LastName: student.last_name,
                    Gender: student.gender,
                    Email: student.email,
                    Batch: student.batch,
                    Class: student.class,
                    Phone: student.phone
                })
            }
            const data = datas;
            if(this.batch !== "All"){
                const fileName ="Student Batch " + this.batch;
                const exportType = exportFromJSON.types.csv;
                if (data) exportFromJSON({ data, fileName, exportType });
            }
            if(this.batch == "All"){
                const fileName ="Student All Batch ";
                const exportType = exportFromJSON.types.csv;
                if (data) exportFromJSON({ data, fileName, exportType });
            }
        },

        successAlert() {
            this.isCreatedSuccess = true;
            setTimeout(() => {
                this.isCreatedSuccess = false;
            }, 2500);
        },

    },
    mounted() {
        this.getStudent();
    },
}
</script>

<style scoped>
    .downlaod:before{
        position: absolute;
        content: "";
        height: 12px;
        width: 12px;
        background: #ddd;
        left: 14px;
        top: 33px;
        transform: translateX(-50%) rotate(45deg);
    }
    .excel-icon:hover + .downlaod{
        opacity: 100;
        transition: all .3s ease-in-out;
    }
</style>