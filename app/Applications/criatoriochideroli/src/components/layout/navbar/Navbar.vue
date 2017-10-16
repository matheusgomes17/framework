<script>
import Brand from './Brand.vue'
import Right from './Right.vue'

export default {
  name: 'criatorio-chideroli-navbar',
  components: { Brand, Right },
  data () {
    return {isOpen: false}
  },
  methods: {
    onToggleMenu () {
      this.isOpen = !this.isOpen
    }
  }
}
</script>

<template>
  <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container">
          <Brand @toggle="onToggleMenu" />
          <div class="collapse navbar-collapse" :class="{in: isOpen}">
            <Right />
          </div>
      </div>
  </nav>
</template>
