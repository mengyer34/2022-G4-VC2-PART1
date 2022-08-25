<template>
  <div>
    <nav-component :user_id="userStore.userId" :user="user" :leaves="leaves"/>

    <div>
      <admin-nav-drawer v-if="role == 'admin'" />

      <div :class="{'flex justify-center w-[70] ml-[13rem]': role == 'admin'}">
        <div :class="{'w-[100%]': role == 'admin'}">
          <router-view @notifUpdated="notifUpdated" @user-updated="userUpdated" :user="user" v-slot="{Component}">
            <transition name="fade">
              <component :is="Component" />
            </transition>
          </router-view>
        </div>
      </div>
    </div>
    <footer class="mt-24 text-center  text-sm" :class="{'w-full ': role == 'student', 'w-[70] ml-[13rem]': role=='admin'}">
      Copyright © 2022 Passerelles Numériques SLMS - All rights reserved.
    </footer>
  </div>
</template>
<script>
import TheNavigation from './components/navigation/TheNavigation.vue';
import AdminNavDrawer from './components/navigation/AdminNavDrawer.vue';
import axios from "./axios-http"
import { useAuth } from './stores/useAuth';

export default {
  setup() {
    const userStore = useAuth()
    return { userStore }
  },
  components: {
    'nav-component': TheNavigation,
    'admin-nav-drawer': AdminNavDrawer
  },
  data() {
    return {
      role: 'user',
      user: [],
      leaves: []
    }
  },
  methods: {
    // notifUpdated() {
    //   axios.get("users_leaves/" + this.userStore.userId).then((res)=>{
    //     this.leaves = res.data.data.leaves;
    //   })
    // },
    async getUserInfo(){
      const result = await axios.get('findUser')
      const data = await result.data.data;
      console.log(data);
      this.userStore.userId = data.id;
      this.userStore.userEmail = data.email;
    },
  },
  async created(){
    await this.userStore.getUserInfo()
  },
  provide() {
    return {
      role: this.role,
      user_id: this.user_id,
    }
  }
}

</script>
<style>
body{
  background: #dddd;
}

  .fade-enter-from, 
  .fade-leave-to{
    opacity: 0;
    transform: translateX(50px)
  }

  .fade-enter-active,
  .fade-leave-active{
    transition:all 0.3s ease-out;
  }
</style>