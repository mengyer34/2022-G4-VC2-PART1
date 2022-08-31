<template>
  <div>
    <nav-component :role="userStore.role" :user_id="userStore.userId" ref="navigation" />

        <div :class="{'w-[100%]': userStore.role == 'admin'}">
          <router-view :user_id="userStore.userId" :user_email="userStore.userEmail" @update-nav="$refs.navigation.getData(); $refs.navigation.getLeaves()" v-slot="{Component}">
            <transition name="fade">
              <component :is="Component" />
            </transition>
          </router-view>
        </div>

    <footer class="mt-24 text-center  text-sm" :class="{'w-full ': userStore.role == 'student', 'ml-[13rem]': userStore.role=='admin'}">
      Copyright © 2022 Passerelles Numériques SLMS - All rights reserved.
    </footer>
  </div>
</template>
<script>
import TheNavigation from './components/navigation/TheNavigation.vue';
import axios from "./axios-http"
import { useAuth } from './stores/useAuth';

export default {
  setup() {
    const userStore = useAuth()
    return { userStore }
  },

  components: {
    'nav-component': TheNavigation,
  },

  methods: {
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