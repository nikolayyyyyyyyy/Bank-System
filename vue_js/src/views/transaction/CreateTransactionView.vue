<script setup>
import { useRouter } from 'vue-router';
import InputComponent from '../../components/common/InputComponent.vue';
import SelectComponent from '../../components/common/SelectComponent.vue';
import ErrorParagraphComponent from '../../components/common/ErrorParagraphComponent.vue';
import SuccessParagraphComponent from '../../components/common/SuccessParagraphComponent.vue';
import ButtonComponent from '../../components/common/ButtonComponent.vue';
import { ref, onMounted } from 'vue';
import { transaction } from '@/auth/transaction';
import { client } from '@/auth/client';
import { employee } from '@/auth/employee';
import { account } from '@/auth/account';

const router = useRouter();
if (!localStorage.getItem('token')) {
  router.push('/login');
}
const options = [{ value: 'deposit', text: 'Deposit' }, { value: 'withdrawal', text: 'Withdrawal' }, { value: 'transfer', text: 'Transfer' }];
const successMessage = ref('');
const errors = ref({});
const transactionData = ref({});
const clients = ref([]);
const employees = ref([]);
const accounts = ref([]);
const { createTransaction } = transaction();
const { getClients } = client();
const { getEmployees } = employee();
const { getAccounts } = account();

const create = async () => {
  try {
    successMessage.value = await createTransaction(transactionData.value);
    errors.value = {};
    transactionData.value = {};
  } catch (err) {
    successMessage.value = '';
    errors.value = JSON.parse(err.message)
  }
}
onMounted(async () => {
  clients.value = (await getClients()).map(d => ({ value: d.id, text: d.egn }));
  employees.value = (await getEmployees()).map(c => ({ value: c.id, text: c.first_name + ' ' + c.last_name }));
  accounts.value = (await getAccounts()).map(c => ({ value: c.id, text: c.account_number }));
});
</script>

<template>
  <div class="create-transaction">
    <h1>Добави транзкция</h1>
    <form class="form" @submit.prevent="create">
      <select-component v-model="transactionData.type" :options title="Вид" />
      <error-paragraph-component v-if="errors.errors?.type" :error="errors.errors.type[0]" />

      <select-component v-model="transactionData.client_id" :options="clients" title="ЕГН на клиент" />
      <error-paragraph-component v-if="errors.errors?.client_id" :error="errors.errors.client_id[0]" />

      <select-component v-model="transactionData.employee_id" :options="employees" title="Служител" />
      <error-paragraph-component v-if="errors.errors?.employee_id" :error="errors.errors.employee_id[0]" />

      <select-component v-model="transactionData.account_id" :options="accounts"
        title="Номер на сметка за получаване" />
      <error-paragraph-component v-if="errors.errors?.account_id" :error="errors.errors.account_id[0]" />

      <input-component v-model="transactionData.amount" title="Сума" type="text" placeholder="Въведи сума" />
      <error-paragraph-component v-if="errors.errors?.amount" :error="errors.errors.amount[0]" />

      <button-component title="Добави" type="submit" />
      <success-paragraph-component v-if="successMessage" :msg="successMessage" />
    </form>
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