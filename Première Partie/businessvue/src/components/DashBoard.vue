<template>
  <main role="main" style="margin-top: 120px">
    <section class="panel important">
      <form v-on:submit.prevent="UpdateUser">
        <div class="twothirds">
          <label for="name">Name</label>
          <input
            type="text"
            name="name"
            v-model="user.name"
            size="40"
            required
          /><br /><br />

          <label for="name">Company Name</label>
          <input
            type="text"
            name="companyname"
            v-model="user.companyname"
            size="40"
            required
          /><br /><br />

          <label for="name">Email</label>
          <input
            type="email"
            name="email"
            v-model="user.email"
            size="40"
            required
          /><br /><br />
          <label for="name">Phone Number</label>
          <input
            type="number"
            name="phone"
            v-model="user.phone"
            size="40"
            required
          /><br /><br />
        </div>
        <div class="pt-2">
          <button class="btn btn-primary border-0">Save Changes</button>
        </div>
      </form>
    </section>
  </main>
</template>
<style scoped>
header[role="banner"] {
  background: white;
  box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.15);
}
nav[role="navigation"] {
  background: #2a3542;
  color: #ddd;
}
nav[role="navigation"] li a {
  color: #ddd;
  text-decoration: none;
  display: block;
  padding: 0.7em;
}
nav[role="navigation"] li a:before {
  content: "\f248";
  font-family: FontAwesome;
  padding-right: 0.6em;
}
a {
  text-decoration: none;
  color: inherit;
}

h2,
h3,
h4 {
  font-weight: 300;
  margin: 0;
}
h2 {
  color: #ff1a1a;
}
ul,
li {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

main li:before {
  content: "";
  position: absolute;
  width: 0;
  height: 0;
  left: 0;
  top: 0.3em;
  border-left: solid 10px #dde;
  border-top: solid 5px transparent;
  border-bottom: solid 5px transparent;
}

.warn {
  color: red;
}

form input {
  width: 100%;
  display: block;
  border: solid 1px #dde;
  padding: 0.5em;
  border-radius: 15px;
}
form input[type="submit"] {
  background: turquoise;
  border: none;
  border-bottom: solid 4px #21ccbb;
  padding: 0.5em 2em;
  margin: 1em 0;
  color: white;
  text-shadow: 0 -1px 0 #21ccbb;
  font-size: 1.1em;
  font-weight: bold;
  display: inline-block;
  width: auto;
  -webkit-border-radius: 0.5em;
  -moz-border-radius: 0.5em;
  -ms-border-radius: 0.5em;
  border-radius: 0.5em;
}

header[role="banner"] {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 99;
  height: 75px;
}
header[role="banner"] .utilities {
  position: absolute;
  top: 0;
  right: 0;
  background: transparent;
  color: darkslategray;
  width: auto;
}
nav[role="navigation"] {
  position: fixed;
  width: 200px;
  top: 75px;
  bottom: 0px;
  left: 0px;
}

main[role="main"] {
  margin: 75px 0 40px 200px;
}

.panel {
  float: left;
  width: 96%;
  margin-left: 20px;
}
.panel:after {
  content: "";
  display: table;
  clear: both;
}
.twothirds {
  width: 50%;
  justify-items: center;
  float: center;
}

.title-pen span {
  color: #55acee;
}

.user-profile ul.data {
  margin: 2em auto;
  height: 3.7em;
  background: #4eb6b6;
  text-align: center;
  border-radius: 0 0 0.3em 0.3em;
}
.user-profile li {
  margin: 0 auto;
  padding: 1.3em;
  width: 33.33334%;
  display: table-cell;
  text-align: center;
}

.user-profile span {
  font-family: "varela round", sans-serif;
  color: #e3eeee;
  white-space: nowrap;
  font-size: 1.27em;
  font-weight: medium;
}
.user-profile span:hover {
  color: #daebea;
}
</style>

<script>
export default {
  data() {
    return {
      name: "",
      loname: localStorage.getItem("user_name"),
      email: "",
      loemail: localStorage.getItem("email"),
      password: "",
      new_password: "",
      confirm_new_password: "",
      user: {
        name: "",
        email: "",
        companyname: "",
        phone: "",
      },
    };
  },
  mounted() {
    this.getUser();
  },
  methods: {
    async getUser() {
      const response = await fetch("http://127.0.0.1:8000/api/profile", {
        method: "GET",
        headers: {
          Authorization: "Bearer " + localStorage.getItem("user_token"),
          "Content-type": "application/json; charset=UTF-8",
        },
      });
      const data = await response.json();
      this.user = data;
    },

    async UpdateUser() {
      fetch("http://localhost:8000/api/updateuser", {
        method: "PUT",
        body: JSON.stringify({
          name: this.user.name,
          email: this.user.email,
          companyname: this.user.companyname,
          phone: this.user.phone,
        }),
        headers: {
          Authorization: "Bearer " + localStorage.getItem("user_token"),
          "Content-type": "application/json; charset=UTF-8",
        },
      }).then(() => {
        this.getUser();
      });
    },
  },
};
</script>
