<script setup>
import { useRouter } from 'vue-router';
import InputComponent from '../../components/common/InputComponent.vue';
import SelectComponent from '../../components/common/SelectComponent.vue';
import ButtonComponent from '../../components/common/ButtonComponent.vue';
import ErrorParagraphComponent from '../../components/common/ErrorParagraphComponent.vue';
import SuccessParagraphComponent from '../../components/common/SuccessParagraphComponent.vue';
import { onMounted, ref } from 'vue';
import { account } from '@/auth/account';
import { client } from '@/auth/client';

const router = useRouter();
if (!localStorage.getItem('token')) {
  router.push('login');
}
const options = [{ value: 'USD', text: 'USD' }, { value: 'EUR', text: 'EUR' }, { value: 'GBP', text: 'GBP' }, { value: 'JPY', text: 'JPY' }, { value: 'AUD', text: 'AUD' }];
const clients = ref([]);
const successMessage = ref('');
const errors = ref({});
const accountData = ref({});
const { createAccount } = account();
const { getClients } = client();

const create = async () => {
  try {
    successMessage.value = await createAccount(accountData.value);
    errors.value = {};
    accountData.value = {};
  } catch (err) {
    successMessage.value = '';
    errors.value = JSON.parse(err.message)
  }
};

onMounted(async () => {
  clients.value = (await getClients()).map(d => ({ value: d.id, text: d.egn }));
});
</script>

<template>
  <div class="create-account">
    <h1>Добави Акаунт</h1>
    <form class="form" @submit.prevent="create">
      <input-component v-model="accountData.account_number" title="Номер на сметка" type="text"
        placeholder="Въведи номер" />
      <error-paragraph-component v-if="errors.errors?.account_number" :error="errors.errors.account_number[0]" />

      <select-component v-model="accountData.client_id" :options="clients" title="ЕГН на клиент" />
      <error-paragraph-component v-if="errors.errors?.client_id" :error="errors.errors.client_id[0]" />

      <select-component v-model="accountData.currency" :options title="Вид валута" />
      <error-paragraph-component v-if="errors.errors?.currency" :error="errors.errors.currency[0]" />

      <input-component v-model="accountData.interest" title="Лихва" type="text" placeholder="Въведи лихва" />
      <error-paragraph-component v-if="errors.errors?.interest" :error="errors.errors.interest[0]" />

      <input-component v-model="accountData.balance" title="Наличност" type="text" placeholder="Въведи наличност" />
      <error-paragraph-component v-if="errors.errors?.balance" :error="errors.errors.balance[0]" />

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