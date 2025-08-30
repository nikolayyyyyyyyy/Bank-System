<script setup>
import InputComponent from '../../components/common/InputComponent.vue';
import ButtonComponent from '../../components/common/ButtonComponent.vue';
import ErrorParagraphComponent from '../../components/common/ErrorParagraphComponent.vue';
import SuccessParagraphComponent from '../../components/common/SuccessParagraphComponent.vue';
import { useRouter } from 'vue-router';
import { ref } from 'vue';
import { client } from '@/auth/client';

const router = useRouter();
if (!localStorage.getItem('token')) {
  router.push('/login');
}

const errors = ref({});
const successMessage = ref('');
const clientData = ref({});
const { createClient } = client();

const create = async () => {
  try {
    successMessage.value = await createClient(clientData.value);
    clientData.value = {};
    errors.value = {};
  } catch (err) {
    successMessage.value = '';
    errors.value = JSON.parse(err.message)
  }
};
</script>

<template>
  <div class="create-client">
    <h1>Добави Клиент</h1>
    <form class="form" @submit.prevent="create">
      <input-component v-model="clientData.first_name" title="Име" type="text" placeholder="Въведи име" />
      <error-paragraph-component v-if="errors.errors?.first_name" :error="errors.errors.first_name[0]" />

      <input-component v-model="clientData.middle_name" title="Презиме" type="text" placeholder="Въведи презиме" />
      <error-paragraph-component v-if="errors.errors?.middle_name" :error="errors.errors.middle_name[0]" />

      <input-component v-model="clientData.last_name" title="Фамилия" type="text" placeholder="Въведи фамилия" />
      <error-paragraph-component v-if="errors.errors?.last_name" :error="errors.errors.last_name[0]" />

      <input-component v-model="clientData.egn" title="Егн" type="text" placeholder="Въведи егн" />
      <error-paragraph-component v-if="errors.errors?.egn" :error="errors.errors.egn[0]" />

      <input-component v-model="clientData.address" title="Град" type="text" placeholder="Въведи град" />
      <error-paragraph-component v-if="errors.errors?.address" :error="errors.errors.address[0]" />

      <input-component v-model="clientData.phone_number" title="Телефонен Номер" type="text"
        placeholder="Въведи телефонен номер" />
      <error-paragraph-component v-if="errors.errors?.phone_number" :error="errors.errors.phone_number[0]" />

      <button-component title="Добави" type="submit" />
      <success-paragraph-component v-if="successMessage" :msg="successMessage" />
    </form>
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