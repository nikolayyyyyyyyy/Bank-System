<script setup>
import TransactionFormComponent from '@/components/forms/TransactionFormComponent.vue';
import { useRouter } from 'vue-router';

const router = useRouter();
if (!localStorage.getItem('token')) {
  router.push('/login');
}
</script>

<template>
  <div class="create-transaction">
    <h1>Добави транзкция</h1>
    <transaction-form-component />
  </div>
</template>

<style scoped>
.create-transaction {
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