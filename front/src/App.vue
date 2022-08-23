<template>
  <div>
    <nav-component :user="user"/>

    <div>
      <admin-nav-drawer v-if="role == 'admin'" />

      <div :class="{'flex justify-center w-[70] ml-[13rem]': role == 'admin'}">
        <div :class="{'w-[100%]': role == 'admin'}">
          <router-view v-slot="{Component}">
            <transition name="fade">
              <component :is="Component" />
            </transition>
          </router-view>
        </div>
      </div>
    </div>
    <footer class="text-center mt-24 w-full text-sm">
      Copyright © 2022 Passerelles Numériques SLMS - All rights reserved.
    </footer>
  </div>
</template>
<script>
import TheNavigation from './components/navigation/TheNavigation.vue';
import AdminNavDrawer from './components/navigation/AdminNavDrawer.vue';
import axios from "axios"
const url = "http://127.0.0.1:8000/api/"
import { useEmail } from './store/index';

export default {
  setup() {
    const emailStore = useEmail()
    return { emailStore }
  },
  components: {
    'nav-component': TheNavigation,
    'admin-nav-drawer': AdminNavDrawer
  },
  data() {
    return {
      role: 'admin',
      user: [],
      user_id: 12,
      user: "",
      user_id: 1,
      email: useEmail().email
    }
  },
  created(){
    axios.get(url + "users/" + this.user_id).then((res)=>{
      this.user = res.data.data
      this.user = res.data.data.first_name + " " + res.data.data.last_name
      this.emailStore.email = res.data.data.email
    })
  },
  provide() {
    return {
      role: this.role,
      user_id: this.user_id
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
