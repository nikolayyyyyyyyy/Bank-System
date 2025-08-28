<script setup>
import { useRouter } from 'vue-router';
import EmployeeFormComponent from '@/components/EmployeeFormComponent.vue';

const router = useRouter();

if (!localStorage.getItem('token')) {
  router.push('/login');
}
</script>

<template>
  <div class="create-employee">
    <h1>Добави Служител</h1>
    <employee-form-component />
  </div>
</template>

<style scoped>
.create-employee {
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