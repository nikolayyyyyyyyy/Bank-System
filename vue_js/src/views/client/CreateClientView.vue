<script setup>
import InputComponent from '../../components/common/InputComponent.vue';
import ButtonComponent from '../../components/common/ButtonComponent.vue';
import ErrorParagraphComponent from '../../components/common/ErrorParagraphComponent.vue';
import SuccessParagraphComponent from '../../components/common/SuccessParagraphComponent.vue';
import { useRouter } from 'vue-router';
import { reactive, ref } from 'vue';

const router = useRouter();
if (!localStorage.getItem('token')) {
  router.push('/login');
}

const errors = ref({});
const successMessage = ref('');
const client = reactive({
  first_name: '',
  middle_name: '',
  last_name: '',
  egn: '',
  address: '',
  phone_number: ''
});

const createUser = async () => {
  const response = await fetch('http://127.0.0.1:8000/api/clients', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'Authorization': `Bearer ${localStorage.getItem('token')}`,
    },
    body: JSON.stringify(client)
  })

  if (response.ok) {
    client.first_name = '';
    client.middle_name = '';
    client.last_name = '';
    client.egn = '';
    client.address = '';
    client.phone_number = '';

    successMessage.value = 'Успешно създаден Клиент';
    errors.value = {};
  } else {
    const data = await response.json();
    successMessage.value = '';
    errors.value = data.errors;
  }
};
</script>

<template>
  <div class="create-client">
    <h1>Добави Клиент</h1>
    <form class="form" @submit.prevent="createUser">
      <input-component v-model="client.first_name" title="Име" type="text" placeholder="Въведи име" />
      <error-paragraph-component v-if="errors?.first_name" :error="errors.first_name[0]" />

      <input-component v-model="client.middle_name" title="Презиме" type="text" placeholder="Въведи презиме" />
      <error-paragraph-component v-if="errors?.middle_name" :error="errors.middle_name[0]" />

      <input-component v-model="client.last_name" title="Фамилия" type="text" placeholder="Въведи фамилия" />
      <error-paragraph-component v-if="errors?.last_name" :error="errors.last_name[0]" />

      <input-component v-model="client.egn" title="Егн" type="text" placeholder="Въведи егн" />
      <error-paragraph-component v-if="errors?.egn" :error="errors.egn[0]" />

      <input-component v-model="client.address" title="Град" type="text" placeholder="Въведи град" />
      <error-paragraph-component v-if="errors?.address" :error="errors.address[0]" />

      <input-component v-model="client.phone_number" title="Телефонен Номер" type="text"
        placeholder="Въведи телефонен номер" />
      <error-paragraph-component v-if="errors?.phone_number" :error="errors.phone_number[0]" />

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