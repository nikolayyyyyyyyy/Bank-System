<script setup>
defineProps({
  error: String
});
</script>

<template>
  <div>
    <p class="error">{{ error }}</p>
  </div>
</template>

<style scoped>
.error {
  color: red;
  font-size: 12px;
}
</style>