<script setup>
import { useRouter } from 'vue-router';
import InputComponent from '../../components/common/InputComponent.vue';
import ButtonComponent from '../../components/common/ButtonComponent.vue';
import ErrorParagraphComponent from '../../components/common/ErrorParagraphComponent.vue';
import SuccessParagraphComponent from '../../components/common/SuccessParagraphComponent.vue';
import SelectComponent from '../../components/common/SelectComponent.vue';
import { ref } from 'vue';
import { employee } from '@/auth/employee';

const router = useRouter();
if (!localStorage.getItem('token')) {
  router.push('/login');
}

const options = [{ value: 'manager', text: 'Manager' }, { value: 'cashier', text: 'Cashier' }, { value: 'director', text: 'Director' }, { value: 'developer', text: 'Developer' }, { value: 'security', text: 'Security' }, { value: 'cleaner', text: 'Cleaner' }, { value: 'secretary', text: 'Secretary' }];
const employeeData = ref({});
const errors = ref({});
const successMessage = ref('');
const { createEmployee } = employee();

const create = async () => {
  try {
    successMessage.value = await createEmployee(employeeData.value);
    errors.value = {};
    employeeData.value = {};
  } catch (err) {
    successMessage.value = '';
    errors.value = JSON.parse(err.message)
  }
};
</script>

<template>
  <div class="create-employee">
    <h1>Добави Служител</h1>
    <form class="form" @submit.prevent="create">
      <input-component v-model="employeeData.first_name" title="Име" type="text" placeholder="Въведи име" />
      <error-paragraph-component v-if="errors.errors?.first_name" :error="errors.errors.first_name[0]" />

      <input-component v-model="employeeData.middle_name" title="Презиме" type="text" placeholder="Въведи презиме" />
      <error-paragraph-component v-if="errors.errors?.middle_name" :error="errors.errors.middle_name[0]" />

      <input-component v-model="employeeData.last_name" title="Фамилия" type="text" placeholder="Въведи фамилия" />
      <error-paragraph-component v-if="errors.errors?.last_name" :error="errors.errors.last_name[0]" />

      <input-component v-model="employeeData.employee_number" title="Номер на служител" type="text"
        placeholder="Въведи номер на служител" />
      <error-paragraph-component v-if="errors.errors?.employee_number" :error="errors.errors.employee_number[0]" />

      <select-component v-model="employeeData.position" :options title="Позиция" />
      <error-paragraph-component v-if="errors.errors?.position" :error="errors.errors.position[0]" />

      <input-component v-model="employeeData.telephone_number" title="Телефон" type="text"
        placeholder="Въведи телефон" />
      <error-paragraph-component v-if="errors.errors?.telephone_number" :error="errors.errors.telephone_number[0]" />

      <button-component title="Добави" type="submit" />
      <success-paragraph-component v-if="successMessage" :msg="successMessage" />
    </form>
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

.form {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

h1 {
  font-size: 28px;
  text-align: center;
}
</style>