<template>
    <div class="w-full sm:px-6 mt-24">
        <h1 class="text-lg font-semibold">STUDENT INFORMATION</h1>
        <div class="bg-white mt-4 p-3 rounded">
            <div>
                <label for="filter-status text-sm leading-none text-gray-800"><span class="text-red-600">*</span>Batch:</label><br>
                <div class="flex justify-between">
                    <select v-model="batch" name="" id="filter-status" class="w-[20%] rounded border p-2 focus:outline-none focus:border-primary">
                        <option value="All">All</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                    </select>
                    <div class="w-[60%]">
                        <input class="p-2 outline-none w-[80%] rounded-l border border-gray-300" type="text" placeholder="Student name...">
                        <button class="px-4 py-2  bg-blue-600 border border-blue-600 text-white rounded-r">Search</button>
                    </div>
                    <div>
                        <button class="text-white bg-orange-500 py-2 px-4 rounded border-none">Add Student</button>
                    </div>
                </div>
            </div>
            <div>
                <student-lists :students="batchFilter" @popUp="popUp"/>      
                <alert-dialog v-if="isPop" @closePopup="isPop=false" @deleteStudent="deleteStudent"/> 
            </div>
        </div>

    </div>
</template>

<script>
import axios from '../../../axios-http.js'
import StudentListView from '../../../components/StudentList/StudentListView.vue'
import alertDeleteDialog from '../../../components/StudentList/StudentDeleteAlert.vue'
const url = 'http://localhost:8000/api/'
export default {
    components: {
        'student-lists': StudentListView,
        'alert-dialog':alertDeleteDialog
    },
    data() {
        return {
            students: [],
            isPop: false,
            id: null,
            batch: 'All',
        }
    },
    computed: {
        batchFilter() {
            if (this.batch == '2023') {
                return this.students.filter(student => student.generation == '2023');
            }else if (this.batch == '2022') {
                return this.students.filter(student => student.generation == '2022');
            }else if (this.batch == '2021') {
                return this.students.filter(student => student.generation == '2021');
            }else {
                return this.students;
            }
        }
    },
    methods: {
        getStudent() {
            axios.get(url + 'users').then(res => {
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
    },
    mounted() {
        this.getStudent();
    },
}
</script>