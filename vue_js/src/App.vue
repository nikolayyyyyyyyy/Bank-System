<script setup>
import HeaderComponent from "./components/HeaderComponent.vue";
</script>

<template>
  <HeaderComponent />
  <div class="container">
    <router-view />
  </div>
</template>

<style scoped>
.container {
  max-width: 900px;
  margin: auto;
}
</style>
