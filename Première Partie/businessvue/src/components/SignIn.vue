<template>
  <section class="Login">
    <div class="container-fluid" style="text-align: center">
      <div
        class="row justify-content-center align-items-center"
        style="min-height: 85vh"
      >
        <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
          <div class="card bg-white border-0 shadow p-2">
            <div class="card-header border-0 bg-white pb-0">
              <h2><strong>Login</strong></h2>
              <p class="text-muted">Log in and access our services.</p>
            </div>
            <div class="card-body">
              <form v-on:submit.prevent="loginUser">
                <div class="form-group py-2">
                  <label for="name">Name</label>
                  <input
                    placeholder="Exp: Zadig"
                    class="form-control my-1"
                    autocomplete="off"
                    name="name"
                    v-model="name"
                    id="name"
                    autofocus
                    required
                  />
                  <small class="form-text text-muted">Enter your name</small>
                </div>
                <div class="form-group py-2">
                  <label for="password">Password</label>
                  <input
                    class="form-control my-1"
                    type="password"
                    v-model="password"
                    name="password"
                    id="password"
                    required
                  />
                  <small class="form-text text-muted"
                    >Enter your password</small
                  >
                </div>
                <div class="pt-2">
                  <button class="btn btn-primary border-0 py-2 px-3 w-100">
                    Login
                  </button>
                </div>
                <div style="margin-top: 20px">
                  <p>
                    Don't have an account yet?
                    <span style="color: blue; cursor: pointer" @click="signin"
                      >Signup Here</span
                    >
                  </p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "SignIn",

  data() {
    return {
      name: "",
      password: "",
      token: "",
    };
  },

  methods: {
    signin() {
      this.$router.push("/signup");
    },
    async loginUser() {
      await fetch("http://127.0.0.1:8000/api/login", {
        method: "POST",
        body: JSON.stringify({
          name: this.name,
          password: this.password,
        }),
        headers: {
          "Content-type": "application/json; charset=UTF-8",
        },
      })
        .then((resp) => resp.json())
        .then(function (data) {
          console.log(data);
          localStorage.setItem("user_name", data.data.name);
          localStorage.setItem("user_token", data.data.token);
          localStorage.setItem("user_id", data.data.id);
        })
        .then(() => {
          this.$router.push("/cards");
        });
    },
  },
};
</script>
