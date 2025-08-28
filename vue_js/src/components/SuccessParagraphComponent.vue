<script setup>
defineProps({
  msg: String
});
</script>

<template>
  <div>
    <p class="success">{{ msg }}</p>
  </div>
</template>

<style scoped>
.success {
  color: green;
  font-size: 12px;
}
</style>