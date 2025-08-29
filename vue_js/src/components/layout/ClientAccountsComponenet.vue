<script setup>
defineProps({
  accounts: Array
});
</script>

<template>
  <div class="accounts">
    <div v-if="accounts" v-for="account in accounts" class="account">
      <h2 class="title">Номер на сметка: {{ account.account_number }}</h2>
      <p class="currency">Валута: {{ account.currency }}</p>
      <p class="interest">Лихва: {{ account.interest }}</p>
      <p class="balance">Наличност: {{ account.balance }} {{ account.currency }}</p>
    </div>
  </div>
</template>

<style scoped>
.account {
  display: flex;
  flex-direction: column;
  gap: 10px;
  background-color: antiquewhite;
  padding: 20px;
  border: 1px solid black;
  border-radius: 10px;
}

.accounts {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.title {
  font-size: 16px;
}
</style>