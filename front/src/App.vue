<template>
  <div>
    <nav-component :role="this.$store.state.role" :user_id="this.$store.state.userId" ref="navigation" />

        <div>
          <router-view :user_id="this.$store.state.userId" :user_email="this.$store.state.userEmail" @update-nav="$refs.navigation.getData(); $refs.navigation.getLeaves()" v-slot="{Component}">
            <transition name="fade">
              <component :is="Component" />
            </transition>
          </router-view>
        </div>

    <footer class="mt-14 text-center  text-sm">
      Copyright © 2022 Passerelles Numériques SLMS - All rights reserved. 
    </footer>
  </div>
</template>
<script>
import TheNavigation from './components/navigation/TheNavigation.vue';
import axios from "./axios-http"

export default {
  components: {
    'nav-component': TheNavigation,
  },
  methods: {
    async getUserInfo(){
      if(this.$cookies.get('slms')){
        const result = await axios.get('/account/find')
        const data = await result.data.data;
        this.$store.state.userId = data.id;
        this.$store.state.userEmail = data.email;
        this.$store.state.role = data.role;
        this.$cookies.set('role', data.role);
      }
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