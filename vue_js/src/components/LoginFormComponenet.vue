<script setup>
import { useRouter } from 'vue-router';
import { ref } from 'vue';
import InputComponenet from './InputComponenet.vue';
import ButtonComponent from './ButtonComponent.vue';
import ErrorParagraphComponent from './ErrorParagraphComponent.vue';

const router = useRouter();
const errors = ref({
  email: '',
  password: '',
  message: ''
});
const loginData = ref({
  email: '',
  password: ''
});

const logUser = async () => {

  const response = await fetch('http://127.0.0.1:8000/api/login', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
    },
    body: JSON.stringify(loginData.value)
  })

  if (!response.ok) {
    const data = await response.json();
    if (data.errors) {
      errors.value = data.errors;
    } else {
      errors.value.email = [];
      errors.value.password = [];
      errors.value.message = data.message;
    }
  } else {
    const data = await response.json();
    localStorage.setItem("token", data.token);
    router.push('/');
  }
}
</script>

<template>
  <form class="form" @submit.prevent="logUser">
    <input-componenet v-model="loginData.email" title="Имейл" type="text" placeholder="Въведи имейл" />
    <error-paragraph-component v-if="errors?.email" :error="errors.email[0]" />

    <input-componenet v-model="loginData.password" title="Парола" type="password" placeholder="Въведи парола" />
    <error-paragraph-component v-if="errors?.password" :error="errors.password[0]" />

    <button-component title="Влез" type="submit" />
    <error-paragraph-component v-if="errors?.message" :error="errors.message" />
  </form>
</template>

<style scoped>
.form {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
</style>