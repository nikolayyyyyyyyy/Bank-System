<script setup>
import { useRouter } from 'vue-router';
import { ref } from 'vue';
import { auth } from '@/auth/user';
import InputComponenet from '../components/common/InputComponent.vue';
import ButtonComponent from '../components/common/ButtonComponent.vue';
import ErrorParagraphComponent from '../components/common/ErrorParagraphComponent.vue';

const router = useRouter();
if (localStorage.getItem('token')) {
  router.push('/');
}

const errors = ref({});
const loginData = ref({
  email: '',
  password: ''
});

const { login } = auth();

const logUser = async () => {

  try {
    await login(loginData.value);
    router.push('/');
    window.location.reload();
  } catch (err) {
    errors.value = JSON.parse(err.message);
  }
}
</script>

<template>
  <div class="login">
    <h1>Вход</h1>
    <form class="form" @submit.prevent="logUser">
      <input-componenet v-model="loginData.email" title="Имейл" type="text" placeholder="Въведи имейл" />
      <error-paragraph-component v-if="errors.errors?.email" :error="errors.errors.email[0]" />

      <input-componenet v-model="loginData.password" title="Парола" type="password" placeholder="Въведи парола" />
      <error-paragraph-component v-if="errors.errors?.password" :error="errors.errors.password[0]" />

      <button-component title="Влез" type="submit" />
      <error-paragraph-component v-if="errors.message && !errors.errors" :error="errors.message" />
    </form>
  </div>
</template>

<style scoped>
.login {
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
