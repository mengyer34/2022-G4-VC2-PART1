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
export default {
  components: {
    'nav-component': TheNavigation,
    'admin-nav-drawer': AdminNavDrawer
  },
  data() {
    return {
      role: 'student',
      user: "",
      user_id: 4,
    }
  },
  created(){
    axios.get("http://127.0.0.1:8000/api/users_leaves/"+this.user_id).then((res)=>{
      this.user = res.data.data.first_name + " " + res.data.data.last_name
    })
  },
  provide() {
    return {
      role: this.role,
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
