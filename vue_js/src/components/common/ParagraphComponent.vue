<script setup>
defineProps({
  title: String,
  text: String
});
</script>

<template>
  <div class="content">
    <h2 class="title">{{ title }}:</h2>
    <p class="content">{{ text }}</p>
  </div>
</template>

<style scoped>
.content {
  text-align: center;
}

.title {
  font-size: 18px;
}
</style>