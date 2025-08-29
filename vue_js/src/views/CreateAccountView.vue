<script setup>
import AccountFormComponent from '@/components/AccountFormComponent.vue';
import { useRouter } from 'vue-router';

const router = useRouter();
if (!localStorage.getItem('token')) {
  router.push('login');
}
</script>

<template>
  <div class="create-account">
    <h1>Добави Акаунт</h1>
    <account-form-component />
  </div>
</template>

<style scoped>
.create-account {
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