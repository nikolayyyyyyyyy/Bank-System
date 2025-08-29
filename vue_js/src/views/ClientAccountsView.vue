<script setup>
import SelectComponent from '@/components/common/SelectComponent.vue';
import ButtonComponent from '@/components/common/ButtonComponent.vue';
import ErrorParagraphComponent from '@/components/common/ErrorParagraphComponent.vue';
import ClientAccountsComponenet from '@/components/layout/ClientAccountsComponenet.vue';
import { ref, onBeforeMount } from 'vue';

const client_id = ref('');
const accounts = ref([]);
const clients = ref([]);
const noAccountsFound = ref('');

const getUserAccounts = async () => {
  const response = await fetch(`http://127.0.0.1:8000/api/clients/${client_id.value}`, {
    method: 'GET',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
  });

  if (response.ok) {
    accounts.value = (await response.json()).accounts;
    client_id.value = '';
    if (accounts.value.length == 0) {
      noAccountsFound.value = `Клиент с id ${client_id.value} няма сметки.`
    } else {
      noAccountsFound.value = '';
    }
  }
};

onBeforeMount(async () => {
  const response = await fetch('http://127.0.0.1:8000/api/clients', {
    method: 'GET',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
  })

  if (response.ok) {
    clients.value = (await response.json()).map(e => ({ value: e.id, text: e.egn }));
  }
});
</script>

<template>
  <div class="client-accounts">
    <form class="form" @submit.prevent="getUserAccounts">
      <select-component v-model="client_id" :options="clients" title="ЕГН на клиент" />
      <button-component type="submit" title="Търси" />
    </form>

    <div class="content">
      <h2 class="title">Сметки</h2>
      <client-accounts-componenet :accounts="accounts" />
      <error-paragraph-component v-if="noAccountsFound" error="Клиентът няма сметки." />
    </div>
  </div>
</template>

<style scoped>
.client-accounts {
  display: flex;
  justify-content: space-between;
}

.content {
  width: 50%;
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.form {
  width: 40%;
  display: flex;
  flex-direction: column;
  gap: 10px;
}
</style>