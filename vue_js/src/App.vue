<script setup>
import HeaderComponent from "./components/common/HeaderComponent.vue";
</script>

<template>
  <HeaderComponent />
  <div class="container">
    <router-view />
  </div>
</template>

<style scoped>
.container {
  max-width: 1100px;
  margin: auto;
}
</style>
