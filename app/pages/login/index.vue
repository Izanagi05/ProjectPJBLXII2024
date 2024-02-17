<template>
  <div style="height: 100%">
    <div class="" style="position: relative; height: 100%">
      <div class="gradientlogin"></div>
      <div class="gradientlogin2"></div>
      <div class="gradientlogin3"></div>
      <div class="d-flex justify-center align-center" style="height: 100%">
        <v-card
          max-width="800"
          style="box-shadow: none"
          class="rounded-xl bg-whiteblur-card1 pa-4"
        >
          <p class="text-h4 text-1">Login</p>
          <p class="text-caption grey--text">
            Silahkan login dengan akun yang sudah ada
          </p>
          <v-form>
            <v-text-field
              :readonly="loading"
              :rules="[required]"
              class="mb-2"
              clearable
              v-model="datalogin.email"
              label="Email"
            />
            <v-text-field
              :readonly="loading"
              :rules="[required]"
              :append-icon="lihat ? 'mdi-eye' : 'mdi-eye-off'"
              :type="lihat ? 'text' : 'password'"
              clearable
              v-model="datalogin.password"
              label="Password"
              @click:append="lihat = !lihat"
            />
          </v-form>

          <div class="d-flex justify-end">
            <v-btn
              block
              depressed
              :disabled="loading ? true : false"
              text
              @click="loading ? waitLogin() : login()"
              class="bg-1 mt-2 text-capitalize"
            >
              Log in
            </v-btn>
          </div>
        </v-card>
      </div>
    </div>
  </div>
</template>
<script src="./js/index.js"></script>
<style scoped>
.gradientlogin {
  position: absolute;
  top: 0px;
  left: -100px;
  --size: 500px;
  --speed: 20s;
  --easing: cubic-bezier(0.8, 0.2, 0.2, 0.8);
  width: var(--size);
  height: var(--size);
  filter: blur(120px);
  background: #0e6ae3;
  border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
}
.gradientlogin2 {
  position: absolute;
  bottom: 15px;
  left: 400px;
  --size: 200px;
  --speed: 20s;
  --easing: cubic-bezier(0.8, 0.2, 0.2, 0.8);
  width: var(--size);
  height: var(--size);
  filter: blur(70px);
  background: #0e6ae3;
  border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
}
.gradientlogin3 {
  position: absolute;
  bottom: 100px;
  right: 100px;
  --size: 400px;
  --speed: 20s;
  --easing: cubic-bezier(0.8, 0.2, 0.2, 0.8);
  width: var(--size);
  height: var(--size);
  filter: blur(90px);
  background: #0e6ae3;
  border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
}
</style>
