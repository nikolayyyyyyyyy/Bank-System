<script setup>
defineProps({
  options: Array,
  title: String,
});

const model = defineModel();
</script>

<template>
  <div class="select">
    <label>{{ title }}</label>
    <select v-model="model">
      <option v-for="option in options" :value="option.value">
        {{ option.text }}
      </option>
    </select>
  </div>
</template>

<style scoped>
.select {
  display: flex;
  flex-direction: column;
  gap: 5px;
}

.select select {
  padding: 5px;
  border-radius: 0px 10px 0px 0px;
  border: 2px solid black;
}
</style>