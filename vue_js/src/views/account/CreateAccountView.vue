<script setup>
import { useRouter } from 'vue-router';
import InputComponent from '../../components/common/InputComponent.vue';
import SelectComponent from '../../components/common/SelectComponent.vue';
import ButtonComponent from '../../components/common/ButtonComponent.vue';
import ErrorParagraphComponent from '../../components/common/ErrorParagraphComponent.vue';
import SuccessParagraphComponent from '../../components/common/SuccessParagraphComponent.vue';
import { onMounted, reactive, ref } from 'vue';

const router = useRouter();
if (!localStorage.getItem('token')) {
  router.push('login');
}

const clients = ref([]);
const successMessage = ref('');
const errors = ref({});
const account = reactive({
  account_number: '',
  currency: '',
  interest: '',
  balance: '',
  client_id: ''
});

const createAccount = async () => {
  const response = await fetch('http://127.0.0.1:8000/api/accounts', {
    method: 'POST',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${localStorage.getItem('token')}`
    },
    body: JSON.stringify(account)
  });

  if (response.ok) {
    successMessage.value = 'Account created successfully.'
    account.account_number = '';
    account.currency = '';
    account.client_id = '';
    account.interest = '';
    account.balance = '';
    errors.value = {}
  } else {
    const data = await response.json();
    errors.value = data.errors;
  }
};

onMounted(async () => {
  const response = await fetch('http://127.0.0.1:8000/api/clients', {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'Authorization': `Bearer ${localStorage.getItem('token')}`,
    }
  });
  if (response.ok) {
    const data = await response.json();
    clients.value = data.map(d => ({ value: d.id, text: d.egn }));
  }
});
</script>

<template>
  <div class="create-account">
    <h1>Добави Акаунт</h1>
    <form class="form" @submit.prevent="createAccount">
      <input-component v-model="account.account_number" title="Номер на сметка" type="text"
        placeholder="Въведи номер" />
      <error-paragraph-component v-if="errors?.account_number" :error="errors.account_number[0]" />

      <select-component v-model="account.client_id" :options="clients" title="ЕГН на клиент" />
      <error-paragraph-component v-if="errors?.client_id" :error="errors.client_id[0]" />

      <select-component v-model="account.currency" :options="[
        {
          value: 'USD',
          text: 'USD'
        },
        {
          value: 'EUR',
          text: 'EUR'
        },
        {
          value: 'GBP',
          text: 'GBP'
        },
        {
          value: 'JPY',
          text: 'JPY'
        },
        {
          value: 'AUD',
          text: 'AUD'
        }
      ]" title="Вид валута" />
      <error-paragraph-component v-if="errors?.currency" :error="errors.currency[0]" />

      <input-component v-model="account.interest" title="Лихва" type="text" placeholder="Въведи лихва" />
      <error-paragraph-component v-if="errors?.interest" :error="errors.interest[0]" />

      <input-component v-model="account.balance" title="Наличност" type="text" placeholder="Въведи наличност" />
      <error-paragraph-component v-if="errors?.balance" :error="errors.balance[0]" />

      <button-component title="Добави" type="submit" />
      <success-paragraph-component v-if="successMessage" :msg="successMessage" />
    </form>
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