<template>
  <div>
    <nav-component :role="this.$store.state.role" :user_id="this.$store.state.userId" ref="navigation" />

        <div>
          <router-view :user_id="this.$store.state.userId" :role="this.$store.state.role"  :user_email="this.$store.state.userEmail" @update-nav="$refs.navigation.getData(); $refs.navigation.getLeaves()" v-slot="{Component}">
            <transition name="fade">
              <component :is="Component" />
            </transition>
          </router-view>
        </div>

    <footer class="mt-5 text-center text-sm">
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
        if(data==null){
            this.$store.dispatch('logout')
            this.$router.push('/login')
        }
        this.$store.state.userId = data.id;
        this.$store.state.userEmail = data.email;
      }
    },
  },
  async created(){
    this.getUserInfo()
  },
}

</script>
<style>
  *::-webkit-scrollbar:horizontal {
  height: 1px;
  }
  *::-webkit-scrollbar {
      width: 3px;
  }
  *::-webkit-scrollbar-thumb {
    background-color: #0081CA;
    border-radius: 20px;
  }
  body{
    background: url('./assets/Animated_Shape.svg');  
    background-attachment: fixed;
    background-position: center;

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