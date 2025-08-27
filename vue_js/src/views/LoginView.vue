<script setup>
import FormComponenet from "@/components/FormComponenet.vue";
</script>

<template>
  <div class="login">
    <h1>Вход</h1>
    <form-componenet />
  </div>
</template>

<style scoped>
.login {
  display: flex;
  flex-direction: column;
  gap: 10px;
  width: 45%;
  margin: auto;
}

h1 {
  font-size: 28px;
  text-align: center;
}
</style>
