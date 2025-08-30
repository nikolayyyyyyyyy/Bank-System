<script setup>
import { onBeforeMount } from 'vue';
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { auth } from '@/auth/user';

const router = useRouter();
if (!localStorage.getItem('token')) {
  router.push('login');
}

const { getUser } = auth();
const userName = ref('');
onBeforeMount(async () => {
  userName.value = await getUser();
});
</script>

<template>
  <div class="dashboard">
    <div class="greetings">
      <h1>Добре дошли отново, <span>{{ userName }}</span>!</h1>
      <p>Логнахте се успешно.</p>
    </div>

    <div class="content">
      <router-link class="content-link" to="/client-accounts">Сметки на клиент</router-link>
    </div>
  </div>
</template>

<style scoped>
.dashboard {
  display: flex;
  flex-direction: column;
  gap: 100px;
}

.content {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
}

.content-link {
  text-decoration: none;
  color: black;
  font-size: 18px;
  border: 2px solid black;
  padding: 10px;
}

.content-link:hover {
  background-color: rgb(242, 236, 228);
}

.greetings {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 15px;
}
</style>
