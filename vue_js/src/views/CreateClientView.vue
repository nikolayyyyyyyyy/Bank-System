<script setup>
import ClientFormComponent from '@/components/forms/ClientFormComponent.vue';
import { useRouter } from 'vue-router';

const router = useRouter();

if (!localStorage.getItem('token')) {
  router.push('/login');
}
</script>

<template>
  <div class="create-client">
    <h1>Добави Клиент</h1>
    <client-form-component />
  </div>
</template>

<style scoped>
.create-client {
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