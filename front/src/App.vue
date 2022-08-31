<template>
  <div>
    <nav-component :role="userStore.role" :user_id="userStore.userId" ref="navigation" />

    <div >
      <admin-nav-drawer v-if="userStore.role == 'admin'" :user_id="userStore.userId" ref="drawer" />

      <div :class="{'flex justify-center w-[70] ml-[13rem]': userStore.role == 'admin'}">
        <div :class="{'w-[100%]': userStore.role == 'admin'}">
          <router-view :user_id="userStore.userId" :user_email="userStore.userEmail" @update-nav="$refs.navigation.getData()" @update-drawer="$refs.drawer.getData()" v-slot="{Component}">
            <transition name="fade">
              <component :is="Component" />
            </transition>
          </router-view>
        </div>
      </div>
    </div>
    <footer class="mt-24 text-center  text-sm" :class="{'w-full ': userStore.role == 'student', 'ml-[13rem]': userStore.role=='admin'}">
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
      // role: 'admin',
    }
  },
  methods: {
    async getUserInfo(){
      const result = await axios.get('/account/find')
      const data = await result.data.data;
      console.log(data);
      this.userStore.userId = data.id;
      this.userStore.userEmail = data.email;
      this.userStore.role = data.role;
      // this.$store.state.role = data.role;
      this.$cookies.set('role', data.role);
      console.log(this.$cookies.get('role'));
    },
  },
  async created(){
    this.getUserInfo()
  },
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