<template>
  <div>
    <nav-component/>

  <router-view v-slot="{Component}">
    <transition name="fade">
      <component :is="Component" />
    </transition>
  </router-view>
  </div>
</template>
<script>
import UserNavigation from './components/navigation/UserNavigation.vue';
export default {
  components: {
    'nav-component': UserNavigation
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
