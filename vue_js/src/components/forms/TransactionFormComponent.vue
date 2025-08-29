<script setup>
import InputComponent from '../common/InputComponent.vue';
import SelectComponent from '../common/SelectComponent.vue';
import ErrorParagraphComponent from '../common/ErrorParagraphComponent.vue';
import SuccessParagraphComponent from '../common/SuccessParagraphComponent.vue';
import ButtonComponent from '../common/ButtonComponent.vue';
import { ref, reactive, onMounted } from 'vue';

const successMessage = ref('');
const errors = ref({});
const transaction = reactive({
  type: '',
  client_id: '',
  employee_id: '',
  account_id: '',
  amount: ''
});

const clients = ref([]);
const employees = ref([]);
const accounts = ref([]);

const createTransaction = async () => {
  const response = await fetch('http://127.0.0.1:8000/api/transactions', {
    method: 'POST',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${localStorage.getItem('token')}`
    },
    body: JSON.stringify(transaction)
  })

  if (response.ok) {
    transaction.type = '';
    transaction.client_id = '';
    transaction.employee_id = '';
    transaction.account_id = '';
    transaction.amount = '';
    successMessage.value = 'Successfully added transaction.';
    errors.value = {};
  } else {
    const data = await response.json();
    errors.value = data.errors;

    console.log(errors.value);

  }
}
onMounted(async () => {
  const clientReq = await fetch('http://127.0.0.1:8000/api/clients', {
    method: 'GET',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
  });
  const clientRes = await clientReq.json();
  clients.value = clientRes.map(c => ({ value: c.id, text: c.egn }));

  const employeeReq = await fetch('http://127.0.0.1:8000/api/employees', {
    method: 'GET',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
  });

  const employeeRes = await employeeReq.json();
  employees.value = employeeRes.map(c => ({ value: c.id, text: c.first_name + ' ' + c.last_name }));

  const accoutReq = await fetch('http://127.0.0.1:8000/api/accounts', {
    method: 'GET',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
  });

  const accoutRes = await accoutReq.json();
  accounts.value = accoutRes.map(c => ({ value: c.id, text: c.account_number }));
});
</script>

<template>
  <form class="form" @submit.prevent="createTransaction">
    <select-component v-model="transaction.type" :options="[
      {
        value: 'deposit',
        text: 'Deposit'
      },
      {
        value: 'withdrawal',
        text: 'Withdrawal'
      },
      {
        value: 'transfer',
        text: 'Transfer'
      }
    ]" title="Вид" />
    <error-paragraph-component v-if="errors?.type" :error="errors.type[0]" />

    <select-component v-model="transaction.client_id" :options="clients" title="ЕГН на клиент" />
    <error-paragraph-component v-if="errors?.client_id" :error="errors.client_id[0]" />

    <select-component v-model="transaction.employee_id" :options="employees" title="Служител" />
    <error-paragraph-component v-if="errors?.employee_id" :error="errors.employee_id[0]" />

    <select-component v-model="transaction.account_id" :options="accounts" title="Номер на сметка за получаване" />
    <error-paragraph-component v-if="errors?.account_id" :error="errors.account_id[0]" />

    <input-component v-model="transaction.amount" title="Сума" type="text" placeholder="Въведи сума" />
    <error-paragraph-component v-if="errors?.amount" :error="errors.amount[0]" />

    <button-component title="Добави" type="submit" />
    <success-paragraph-component v-if="successMessage" :msg="successMessage" />
  </form>
</template>

<style scoped>
.form {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
</style>