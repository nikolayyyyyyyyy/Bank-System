<script setup>
import { ref } from 'vue';

const user = ref({});

if (localStorage.getItem("user")) {
  user.value = localStorage.getItem("user");
}
</script>

<template>
  <nav class="nav">
    <router-link v-if="user.value" class="nav-link" to="/">Dashboard</router-link>
    <router-link v-else="user.value" class="nav-link" to="/login">Вход</router-link>
  </nav>
</template>

<style scoped>
.nav {
  padding: 15px 20px;
  background-color: blue;
  margin-bottom: 50px;
  border-bottom: 1px solid black;
  font-size: 12px;
  display: flex;
  gap: 10px;
}

.nav-link {
  text-decoration: none;
  color: black;
  background-color: #fff;
  padding: 5px;
  border-radius: 5px;
  border: 1px solid black;
}

.nav-link:hover {
  background-color: #beb8b8;
}
</style>
