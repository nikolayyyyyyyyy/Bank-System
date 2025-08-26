<template>
  <nav class="nav">
    <router-link class="nav-link" to="/">Dashboard</router-link>
    <router-link class="nav-link" to="/login">Вход</router-link>
    <router-link class="nav-link" to="/create-client">
      Добави клиент
    </router-link>
  </nav>

  <div class="container">
    <router-view />
  </div>
</template>

<style scopped>
.container {
  max-width: 900px;
  margin: auto;
}

.nav {
  padding: 15px 20px;
  background-color: blue;
  margin-bottom: 50px;
  border-bottom: 1px solid black;
  font-size: 12px;
  display: flex;
  gap: 10px;
}

.nav-link {
  text-decoration: none;
  color: black;
  background-color: #fff;
  padding: 5px;
  border-radius: 5px;
  border: 1px solid black;
}

.nav-link:hover {
  background-color: #beb8b8;
}
</style>
