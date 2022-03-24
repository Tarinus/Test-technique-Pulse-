<template>
  <div style="margin-top: 120px">
    <div>
      <div class="row" id="page-content" v-for="card in cards" :key="card.id">
        <div class="padding">
          <div class="row container">
            <div class="col-xl-6 col-md-12">
              <div class="card user-card-full">
                <div class="row m-l-0 m-r-0">
                  <div class="col-sm-4 bg-c-lite-green user-profile">
                    <div class="card-block text-center text-white">
                      <div class="m-b-25">
                        <img
                          src="https://img.icons8.com/bubbles/100/000000/user.png"
                          class="img-radius"
                          alt="User-Profile-Image"
                        />
                      </div>
                      <h6 class="f-w-600">{{ card.name }}</h6>
                      <i
                        class="mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"
                      ></i>
                    </div>
                  </div>
                  <div class="col-sm-8">
                    <div class="card-block">
                      <h6 class="m-b-20 p-b-5 b-b-default f-w-600">
                        Information
                      </h6>
                      <div class="row">
                        <div class="col-sm-6">
                          <p class="m-b-10 f-w-600">Name</p>
                          <h6 class="text-muted f-w-400">{{ card.name }}</h6>
                        </div>
                        <div class="col-sm-6">
                          <p class="m-b-10 f-w-600">Company Name</p>
                          <h6 class="text-muted f-w-400">
                            {{ card.companyname }}
                          </h6>
                        </div>
                        <div class="col-sm-6">
                          <p class="m-b-10 f-w-600">Email</p>
                          <h6 class="text-muted f-w-400">{{ card.email }}</h6>
                        </div>
                        <div class="col-sm-6">
                          <p class="m-b-10 f-w-600">Phone Number</p>
                          <h6 class="text-muted f-w-400">{{ card.phone }}</h6>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="mybutton">
      <button class="feedback">
        <router-link id="deco" to="/addcard">Add Card</router-link>
      </button>
    </div>
  </div>
</template>
<style scoped>
body {
  background-color: #f9f9fa;
}

.user-card-full {
  overflow: hidden;
}

.card {
  border-radius: 5px;
  -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
  box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
  border: none;
  margin-bottom: 30px;
}

.m-r-0 {
  margin-right: 0px;
}

.m-l-0 {
  margin-left: 0px;
}

.user-card-full .user-profile {
  border-radius: 5px 0 0 5px;
}

.bg-c-lite-green {
  background: -webkit-gradient(
    linear,
    left top,
    right top,
    from(#f29263),
    to(#ee5a6f)
  );
  background: linear-gradient(to right, #ee5a6f, #f29263);
}

.user-profile {
  padding: 20px 0;
}

.card-block {
  padding: 1.25rem;
}

.m-b-25 {
  margin-bottom: 25px;
}

.img-radius {
  border-radius: 5px;
}

h6 {
  font-size: 14px;
}

.card .card-block p {
  line-height: 25px;
}

@media only screen and (min-width: 1400px) {
  p {
    font-size: 14px;
  }
}

.card-block {
  padding: 1.25rem;
}

.b-b-default {
  border-bottom: 1px solid #e0e0e0;
}

.m-b-20 {
  margin-bottom: 20px;
}

.p-b-5 {
  padding-bottom: 5px !important;
}

.card .card-block p {
  line-height: 25px;
}

.m-b-10 {
  margin-bottom: 10px;
}

.text-muted {
  color: #919aa3 !important;
}

.b-b-default {
  border-bottom: 1px solid #e0e0e0;
}

.f-w-600 {
  font-weight: 600;
}

.m-b-20 {
  margin-bottom: 20px;
}

.m-t-40 {
  margin-top: 20px;
}

.p-b-5 {
  padding-bottom: 5px !important;
}

.m-b-10 {
  margin-bottom: 10px;
}

.m-t-40 {
  margin-top: 20px;
}

.user-card-full .social-link li {
  display: inline-block;
}

.user-card-full .social-link li a {
  font-size: 20px;
  margin: 0 10px 0 0;
  -webkit-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}
.feedback {
  background-color: #31b0d5;
  color: white;
  padding: 10px 20px;
  border-radius: 20px;
  border-color: #46b8da;
}

#mybutton {
  position: fixed;
  bottom: -4px;
  right: 10px;
  margin: 30px;
}
</style>

<script>
export default {
  name: "BusinessCard",
  data() {
    return {
      cards: "",
    };
  },
  mounted() {
    this.getCard();
  },
  methods: {
    turn() {
      console.log(document.getElementsByClassName("card"));
    },
    async getCard() {
      const response = await fetch("http://127.0.0.1:8000/api/cards", {
        method: "GET",
        headers: {
          Authorization: "Bearer " + localStorage.getItem("user_token"),
          "Content-type": "application/json; charset=UTF-8",
        },
      });
      const data = await response.json();
      console.log(data);
      this.cards = data;
    },
  },
};
</script>
