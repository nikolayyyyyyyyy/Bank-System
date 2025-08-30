<script setup>
import ParagraphComponent from '../common/ParagraphComponent.vue';
import DeleteButtonComponent from '../common/DeleteButtonComponent.vue';
defineProps({
  client: Object
});

const deleteClient = async (id) => {
  const response = await fetch(`http://127.0.0.1:8000/api/clients/${id}/delete`, {
    method: 'DELETE',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
  });

  if (response.ok) {
    window.location.reload();
  }
};
</script>

<template>
  <div class="card">
    <paragraph-component title="Име" :text="client.first_name + ' ' + client.middle_name + ' ' + client.last_name" />
    <paragraph-component title="ЕГН" :text="client.egn" />
    <paragraph-component title="Адрес" :text="client.address" />
    <paragraph-component title="Телефон" :text="client.phone_number" />

    <router-link class="link" :to="`client/${client.id}/update`">Промени</router-link>
    <delete-button-component class="delete_btn" @click="deleteClient(client.id)" title="Изтрий" />
  </div>
</template>

<style scoped>
.link {
  width: 30%;
  padding: 5px 10px;
  border: 1px solid black;
  border-radius: 5px;
  color: #FFF;
  background-color: blue;
  text-decoration: none;
  text-align: center;
  align-self: center;
  font-size: 14px;
}

.card {
  display: flex;
  flex-direction: column;
  gap: 10px;
  border: 2px solid gray;
  padding: 10px;
  border-radius: 10px;
  width: 30%;
}
</style>