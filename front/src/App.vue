<template>
  <div>
    <nav-component/>
  </div>
  <router-view></router-view>
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
nav a.router-link-exact-active {
  background: orange;
  color: #fff;
}
</style>
