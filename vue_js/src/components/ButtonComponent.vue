<script setup>
defineProps({
  type: String,
  title: String
});
</script>

<template>
  <div class="button">
    <button :type="type">{{ title }}</button>
  </div>
</template>

<style scoped>
.button {
  display: flex;
  justify-content: center;
}

button {
  width: 30%;
  padding: 5px 10px;
  border: 1px solid black;
  border-radius: 5px;
  color: #FFF;
  background-color: blue;
}

button:hover {
  background-color: rgb(3, 3, 184);
}
</style>