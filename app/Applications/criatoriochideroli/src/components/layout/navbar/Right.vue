<template>
  <ul class="nav navbar-nav ml-auto">
    <router-link :to="{ name: 'app.home' }" tag="li" exact class="nav-item">
      <a class="nav-link"><i class="fa fa-home"></i> Início</a>
    </router-link>

    <router-link :to="{ name: 'app.contact' }" tag="li" class="nav-item">
      <a class="nav-link"><i class="fa fa-envelope"></i> Contato</a>
    </router-link>
  </ul>
</template>

<script>
export default {}
</script>
