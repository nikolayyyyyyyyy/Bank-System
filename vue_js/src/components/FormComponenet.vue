<script setup>
import InputComponenet from './InputComponenet.vue';
import ButtonComponent from './ButtonComponent.vue';
</script>

<template>
  <form class="form" action="">
    <input-componenet title="Имейл" type="text" placeholder="Въведи имейл" />
    <input-componenet title="Парола" type="password" placeholder="Въведи парола" />
    <button-component title="Влез" type="submit" />
  </form>
</template>

<style scoped>
.form {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
</style>