<script setup>
import ErrorParagraphComponent from '@/components/common/ErrorParagraphComponent.vue';
import AllClientsComponent from '@/components/layout/ClientComponent.vue';
import { ref, onMounted } from 'vue';
import { client } from '@/auth/client';

const clients = ref({});
const error = ref('');
const { getClients } = client();

onMounted(async () => {
  clients.value = await getClients();
});
</script>

<template>
  <div class="all-clients">
    <h2 class="title">Всички Клиенти</h2>
    <div class="content" v-if="clients">
      <all-clients-component v-for="client in clients" :client :key="client.id" />
    </div>
    <error-paragraph-component v-if="error" :error />
  </div>
</template>

<style scoped>
.content {
  margin-top: 50px;
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
}

.all-clients {
  display: flex;
  flex-direction: column;
  gap: 10px;
  margin: auto;
}

h2 {
  font-size: 28px;
  text-align: center;
}
</style>