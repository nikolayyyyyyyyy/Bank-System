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
  </div>
</template>

<style scoped>
.dashboard {
  display: flex;
  flex-direction: column;
  gap: 100px;
}

.greetings {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 15px;
}
</style>
