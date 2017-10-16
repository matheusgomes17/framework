<template>
  <div id="app">
    <MenuTop />
    <div class="container">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import MenuTop from './components/layout/navbar/MenuTop.vue'

export default {
  components: { MenuTop }
}
</script>

<style src="./assets/sass/app.scss" lang="sass"></style>