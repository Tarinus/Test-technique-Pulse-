<template>
  <div class="container-fluid" style="text-align: center; margin-top: 100px">
    <div
      class="row justify-content-center align-items-center"
      style="min-height: 85vh"
    >
      <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
        <div class="card bg-white border-0 shadow p-2">
          <div class="card-header border-0 bg-white pb-0">
            <h2><strong>Create account</strong></h2>
          </div>
          <div class="card-body">
            <form v-on:submit.prevent="VerifySame">
              <div class="form-group py-2">
                <label for="fullname">Name</label>
                <input
                  placeholder="Exp: Zaldivar"
                  class="form-control my-1"
                  autocomplete="off"
                  v-model="name"
                  name="fullname"
                  id="fullname"
                  autofocus
                  required
                />
                <small class="form-text text-muted">Enter your name</small>
              </div>

              <div class="form-group py-2">
                <label for="fullname">Company Name</label>
                <input
                  placeholder="Exp: Golden Tech"
                  class="form-control my-1"
                  autocomplete="off"
                  v-model="companyname"
                  name="companyname"
                  id="companyname"
                  autofocus
                />
                <small class="form-text text-muted"
                  >Enter your company name</small
                >
              </div>

              <div class="form-group py-2">
                <label for="email">Email</label>
                <input
                  placeholder="Exp: abc@gmail.com"
                  class="form-control my-1"
                  autocomplete="off"
                  v-model="email"
                  name="email"
                  id="email"
                />
                <small class="form-text text-muted">Enter your email</small>
              </div>

              <div class="form-group py-2">
                <label for="fullname">Phone Number</label>
                <input
                  type="number"
                  class="form-control my-1"
                  autocomplete="off"
                  v-model="phone"
                  name="phone"
                  id="phone"
                  autofocus
                />
                <small class="form-text text-muted"
                  >Enter your phone number</small
                >
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
                <small class="form-text text-muted">Enter your password</small>
              </div>
              <div class="form-group py-2">
                <label for="password">Password Confirm</label>
                <input
                  class="form-control my-1"
                  type="password"
                  v-model="confirm_password"
                  name="password"
                  id="confirm_password"
                  required
                />
                <small class="form-text text-muted"
                  >Confirm your password</small
                >
              </div>
              <div class="pt-2">
                <button class="btn btn-primary border-0 py-2 px-3 w-100">
                  Create account
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "SignUp",
  data() {
    return {
      name: "",
      email: "",
      phone: "",
      companyname: "",
      password: "",
      confirm_password: "",
    };
  },

  methods: {
    VerifySame() {
      alert();
      var a = this.password;
      var b = this.confirm_password;
      console.log(a);
      console.log(b);
      var confirm_pass = document.getElementById("confirm_password");
      if (a !== b) {
        confirm_pass.setCustomValidity("Passwords Don't Match");
      } else {
        this.createUser();
      }
    },
    async createUser() {
      await fetch("http://127.0.0.1:8000/api/register", {
        method: "POST",
        body: JSON.stringify({
          name: this.name,
          companyname: this.companyname,
          email: this.email,
          phone: this.phone,
          password: this.password,
          confirm_password: this.confirm_password,
        }),
        headers: {
          "Content-type": "application/json; charset=UTF-8",
        },
      }).then(() => {
        this.$router.push("/signin");
      });
    },
  },
};
</script>
