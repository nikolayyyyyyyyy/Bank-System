<script setup>
import { useRouter } from 'vue-router';
import InputComponent from '../../components/common/InputComponent.vue';
import ButtonComponent from '../../components/common/ButtonComponent.vue';
import ErrorParagraphComponent from '../../components/common/ErrorParagraphComponent.vue';
import SuccessParagraphComponent from '../../components/common/SuccessParagraphComponent.vue';
import SelectComponent from '../../components/common/SelectComponent.vue';
import { reactive, ref } from 'vue';

const router = useRouter();

if (!localStorage.getItem('token')) {
  router.push('/login');
}

const employee = reactive({
  first_name: '',
  middle_name: '',
  last_name: '',
  employee_number: '',
  position: '',
  telephone_number: ''
});

const errors = ref({});

const successMessage = ref('');

const createEmployee = async () => {
  console.log(employee);

  const response = await fetch('http://127.0.0.1:8000/api/employees', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'Authorization': `Bearer ${localStorage.getItem('token')}`,
    },
    body: JSON.stringify(employee)
  })

  if (response.ok) {
    employee.first_name = '';
    employee.middle_name = '';
    employee.last_name = '';
    employee.employee_number = '';
    employee.position = '';
    employee.telephone_number = '';

    successMessage.value = 'Успешно създаден Служител';
    errors.value = {};
  } else {
    const data = await response.json();
    successMessage.value = '';
    errors.value = data.errors;
  }
};
</script>

<template>
  <div class="create-employee">
    <h1>Добави Служител</h1>
    <form class="form" @submit.prevent="createEmployee">
      <input-component v-model="employee.first_name" title="Име" type="text" placeholder="Въведи име" />
      <error-paragraph-component v-if="errors?.first_name" :error="errors.first_name[0]" />

      <input-component v-model="employee.middle_name" title="Презиме" type="text" placeholder="Въведи презиме" />
      <error-paragraph-component v-if="errors?.middle_name" :error="errors.middle_name[0]" />

      <input-component v-model="employee.last_name" title="Фамилия" type="text" placeholder="Въведи фамилия" />
      <error-paragraph-component v-if="errors?.last_name" :error="errors.last_name[0]" />

      <input-component v-model="employee.employee_number" title="Номер на служител" type="text"
        placeholder="Въведи номер на служител" />
      <error-paragraph-component v-if="errors?.employee_number" :error="errors.employee_number[0]" />

      <select-component v-model="employee.position" :options="[
        {
          value: 'manager',
          text: 'Manager'
        },
        {
          value: 'cashier',
          text: 'Cashier'
        },
        {
          value: 'director',
          text: 'Director'
        },
        {
          value: 'developer',
          text: 'Developer'
        },
        {
          value: 'security',
          text: 'Security'
        },
        {
          value: 'cleaner',
          text: 'Cleaner'
        },
        {
          value: 'secretary',
          text: 'Secretary'
        },
      ]" title="Позиция" />
      <error-paragraph-component v-if="errors?.position" :error="errors.position[0]" />

      <input-component v-model="employee.telephone_number" title="Телефон" type="text" placeholder="Въведи телефон" />
      <error-paragraph-component v-if="errors?.telephone_number" :error="errors.telephone_number[0]" />

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