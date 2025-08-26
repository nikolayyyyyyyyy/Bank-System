<template>
  <nav class="nav">
    <router-link class="nav-link" to="/">Home</router-link>
  </nav>

  <div class="container">
    <router-view />
  </div>
</template>

<style scopped>
.container {
  max-width: 900px;
  margin: auto;
  background-color: cadetblue;
}

.nav {
  padding: 15px 20px;
  background-color: gray;
  margin-bottom: 50px;
}

.nav-link {
  text-decoration: none;
  color: black;
  font-size: 18px;
  background-color: #fff;
  padding: 5px;
  border-radius: 5px;
  border: 1px solid black;
}
</style>
