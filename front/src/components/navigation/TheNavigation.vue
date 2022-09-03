<template>
    <div class="bg-white w-full fixed top-0 z-50">
        <nav :class="{'bg-white animate-pulse': !isReady, 'bg-primary': isReady}" class="flex w-full p-2 text-white justify-between items-center px-4">
            <ul @click="show=false">
                <li class="flex items-center space-x-2">
                    <img src="../../assets/pnc_logo.png" alt="logo" class="w-[50px]">
                    <span :class="{'text-black': !isReady}" class="text-2xl font-semibold">SLMS</span>
                </li>
            </ul>
            <ul @click="show=false" id="animation" class="flex">
                <li v-if="role !== 'admin' && isReady">
                    <router-link class="p-2 px-6 flex" to="/">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-[1.35rem] w-6 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                        Home
                    </router-link>
                </li>
                <li v-if="role !== 'admin' && isReady">
                    <router-link class="flex p-2 px-6" to="/histories">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                        </svg>
                        List Leaves
                    </router-link>
                </li>

                <li v-if="role == 'admin' && isReady">
                    <router-link class="flex p-2 px-6" to="/dashboard">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-[1.35rem] w-6 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm9 4a1 1 0 10-2 0v6a1 1 0 102 0V7zm-3 2a1 1 0 10-2 0v4a1 1 0 102 0V9zm-3 3a1 1 0 10-2 0v1a1 1 0 102 0v-1z" clip-rule="evenodd" />
                        </svg>
                        Dashboard
                    </router-link>
                </li>
                <li v-if="role == 'admin' && isReady">
                    <router-link class="flex p-2 px-6" to="/students">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-[1.35rem] w-6 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 2a1 1 0 00-1 1v1a1 1 0 002 0V3a1 1 0 00-1-1zM4 4h3a3 3 0 006 0h3a2 2 0 012 2v9a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2zm2.5 7a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm2.45 4a2.5 2.5 0 10-4.9 0h4.9zM12 9a1 1 0 100 2h3a1 1 0 100-2h-3zm-1 4a1 1 0 011-1h2a1 1 0 110 2h-2a1 1 0 01-1-1z" clip-rule="evenodd" />
                        </svg>
                        Students
                    </router-link>
                </li>
                <li v-if="role == 'admin' && isReady">
                    <router-link class="flex p-2 px-6" to="/leaves">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                        </svg>
                        Leaves

                        <div v-if="isReady && countUnseenNotification > 0" :class="{'animate-bounce': ringing}" class="ml-3 flex justify-center items-center">
                            <small class="bg-red-400 text-white rounded-lg px-[0.30rem] border">{{ countUnseenNotification }}</small>
                        </div>
                    </router-link>
                </li>
                <div v-if="!isReady" class="h-10 w-96 bg-slate-300 rounded"></div>
            </ul>
            <ul class="flex space-x-5 relative">

                <li v-if="role !== 'admin'" >
                    <router-link class="relative" to="notifications">
                        <span v-if="countUnseenNotification > 0" :class="{'animate-bounce': ringing}" class="bg-red-700 text-xs rounded-full px-1 absolute">{{ countUnseenNotification }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                        </svg>
                    </router-link>
                </li>
                <li v-if="isReady" @click="show=!show" class="flex flex-col items-end min-w-[9rem] space-x-2 cursor-pointer">
                    <div class="flex justify-center items-center">
                        <div class="w-8 h-8 mr-2">
                            <img v-if="user.profile_image != undefined" :src="getImage" alt="" class=" w-[30px] h-[30px] rounded-full">
                            <img v-else src="../../assets/avatar.png" alt="" class=" w-[30px] h-[30px] rounded-full">
                        </div>
                        <span v-if="role != 'admin'">{{user.first_name}} {{user.last_name}}</span>
                        <span v-else>{{user.username}}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>

                    <div v-if="show" class="py-1 rounded-md shadow-xs absolute bg-gray-200 mt-10 right-0">
                        <router-link class="flex px-4 py-2 text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-warning hover:text-white focus:outline-none focus:bg-gray-100" :to="role =='admin'?'/admin':'/profile'">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Your Profile
                        </router-link>
                        <div class="flex px-4 py-2 text-sm leading-5 text-gray-700 transition duration-150 ease-in-out focus:outline-none hover:bg-warning hover:text-white" @click="submitLogout">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Sign out
                        </div>
                    </div>
                </li>
                <div v-else class="flex justify-center items-center">
                    <div class="rounded-full bg-slate-300 h-[2rem] w-[2rem] mr-2"></div>
                    <div class="h-6 w-40 bg-slate-300 rounded-xl"></div>
                </div>
                
            </ul>
        </nav>
        
        <loading-show v-if="isLoggingOut">
            Logging out...
        </loading-show>
    </div>
</template>
<script>
import axios from "../../axios-http"
import LoadingShow from './../animations/LoadingShow.vue';
export default {
    components: {
        'loading-show': LoadingShow,
    },
    props: {
        user_id: Number,
        role: String
    },
    data() {
        return {
            show: false,
            user: null,
            leaves: [],
            isLoggingOut: false,
            ringing: true,
        };
    },
    
    methods: {
        submitLogout(){
            this.isLoggingOut = true;
            let dataToDel = {token: 'slms', role: 'role'}
            setTimeout(() => {
                this.isLoggingOut = false;
                this.$store.dispatch('logout')
                this.$router.push('/login')
            }, 1000);
        },
        getData() {
            axios.get('account/find').then(res=> {
                this.user = res.data.data;
                this.getLeaves();
            })
        },

        getLeaves() {
            if(this.user != null) {
                if (this.user.role != 'admin') {
                    axios.get('users_leaves/' + this.user_id).then(res => {
                        this.leaves = res.data.data.leaves;
                    })
                } else {
                    axios.get('leaves_user/').then(res => {
                        this.leaves = res.data.data;
                    })
                }
            }
        },
    },

    computed: {
        countUnseenNotification() {
            let countUnseen = 0;
            if (this.role != 'admin') {
                this.leaves.forEach(eachLeave => {
                    if (!eachLeave.is_user_seen && eachLeave.status !== 'Pending') {
                        countUnseen += 1
                    }
                });
            } else {
                this.leaves.forEach(eachLeave => {
                    if (!eachLeave.is_admin_seen) {
                        countUnseen += 1
                    }
                });
            }
            return countUnseen;
        },

        isReady() {
            return this.user !== null;
        },

        getImage() {
            if (this.user.profile_image != undefined) {
                return 'http://127.0.0.1:8000/api/' +'storage/image/' + this.user.profile_image;
            } else {
                return "";
            }
        },
    },
    
    watch: {
        user_id() {
            this.getData();
        },
        
        countUnseenNotification(newValue) {
            setTimeout(() => {
                    this.ringing = false;
                }, 5000)
        }
    },

    created() {
        if (this.user_id) {
            this.getData();
        }
    }
}
</script>

<style scoped>
    nav a.router-link-exact-active {
    background: #FF6B00;
    color: #fff;
    }

    
</style>