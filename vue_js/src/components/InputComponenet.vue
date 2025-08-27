<script setup>
defineProps({
  title: String,
  type: String,
  placeholder: String
});
</script>

<template>
  <div class="input">
    <label>{{ title }}</label>
    <input :type="type" :placeholder="placeholder">
  </div>
</template>

<style scoped>
.input {
  display: flex;
  flex-direction: column;
  gap: 5px;
}

.input input {
  padding: 5px;
  border-radius: 0px 10px 0px 0px;
}
</style>
