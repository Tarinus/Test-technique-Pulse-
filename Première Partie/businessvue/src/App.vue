<template>
  <div id="nav">
    <nav class="nanbar containe">
      <div class="nanbar__logo"></div>
      <div class="nanbar__buttons">
        <button class="login__button btnn" v-show="!show">
          <router-link id="deco" to="/signin">Sign In</router-link>
        </button>
        <button class="signin__button btnn" v-show="!show">
          <router-link id="deco" to="/signup">Sign Up</router-link>
        </button>
        <button class="logout__button btnn" @click="logout" v-show="show">
          logout
        </button>
        <button class="logout__button btnn" v-show="show">
          <router-link id="deco" to="/profile">Profile</router-link>
        </button>
        <button class="logout__button btnn" v-show="show">
          <router-link id="deco" to="/cards">My Cards</router-link>
        </button>
      </div>
    </nav>
  </div>
  <router-view />
</template>

<script>
export default {
  mounted() {
    setInterval(() => {
      this.signin();
    }, 1000);
  },
  data() {
    return {
      show: false,
    };
  },
  methods: {
    logout() {
      localStorage.removeItem("user_token");
      this.show = true;
      this.$router.push("/");
      this.signin();
    },

    signin() {
      if (localStorage.getItem("user_token")) {
        this.show = true;
      } else {
        this.show = false;
      }
    },
  },
};
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");
@import "~bootstrap/dist/css/bootstrap.css";

:root {
  --secondary: #011627;
  --background: #41ead4;
  --button: white;
  --button__hover: #2e9fde;
}

body {
  font-family: "Poppins";
  /* color: white; */
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.containe {
  padding: 0 15px;
}

.nanbar {
  width: -webkit-fill-available;
  top: 0;
  position: fixed;
  height: 80px;
  background-color: #3e9f71;
  display: flex;
  justify-content: space-between;
  z-index: 1;
}
.nanbar__logo {
  color: white;
}

.nanbar__nav {
  display: flex;
  align-items: left;
}
.nanbar__menu {
  list-style: none;
  display: flex;
}
.nanbar__item {
  margin-right: 20px;
}
.nanbar__link {
  text-decoration: none;
  color: rgba(255, 255, 255, 1);
}

.nanbar__link:hover {
  transition: all 0.3s ease;
  color: rgba(255, 255, 255, 0.5);
}

.nanbar__buttons {
  display: flex;
  align-items: center;
}
.btnn {
  margin-right: 20px;
  background-color: var(--button__hover);
  border: none;
  font-family: "Poppins";
  padding: 10px 0;
  font-size: 15px;
  border-radius: 10px;
  min-width: 85px;
  max-width: 90px;
  color: white;
}

.btnn:hover {
  transition: all 0.3s ease-in-out;
  filter: opacity(0.8);
  cursor: pointer;
}

#deco {
  text-decoration: none;
  color: white;
}
</style>
