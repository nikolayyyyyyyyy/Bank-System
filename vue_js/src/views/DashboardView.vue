<script setup>
import { onMounted } from 'vue';
import { ref } from 'vue';

const userName = ref('');
onMounted(async () => {
  const response = await fetch(`http://127.0.0.1:8000/api/user`, {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'Authorization': `Bearer ${localStorage.getItem('token')}`,
    }
  });

  const data = await response.json();
  userName.value = data.name;
});
</script>

<template>
  <div class="greetings">
    <h1>Добре дошли отново, <span>{{ userName }}</span>!</h1>
    <p>Логнахте се успешно.</p>
  </div>

  <div class="content"></div>
</template>

<style scoped>
.greetings {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 15px;
}
</style>
