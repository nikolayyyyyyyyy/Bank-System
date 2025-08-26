<template>
  <div class="greetings">
    <h1>Добре дошли отново!</h1>
    <p>Логнахте се успешно.</p>
  </div>

  <div class="content"></div>
</template>

<style scoped>
.greetings h1 {
  font-size: 30px;
  font-weight: 400;
  text-align: center;
}

.greetings p {
  margin-block: 30px;
  text-align: center;
}

.content {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}

a {
  text-decoration: none;
  color: black;
  width: 50%;
  border: 3px solid gray;
  padding: 10px;
}

a:hover {
  background-color: blanchedalmond;
}
</style>
