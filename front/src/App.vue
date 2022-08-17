<template>
  <div>
    <nav-component/>

  <router-view v-slot="{Component}">
    <transition name="grow-out">
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

  .grow-out-enter-from, 
  .grow-out-leave-to{
    opacity: 0;
    transform: scale(1.2);
  }

  .grow-out-enter-active,
  .grow-out-leave-active{
    transition: 0.3s ease-out;
  }
</style>
