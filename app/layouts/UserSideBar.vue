<template>
  <div>
    <v-app >
      <div style="position: relative;height: 100%;">

        <navbar-beranda />

    <div class="gradient4-brd"></div>
          <div class="gradient5-brd"></div>
        <div class="view bgrbrd-1 pa-4 " style="height: 100%; overflow-y: scroll;overflow-x: hidden;padding-top: 80px !important;">

          <nuxt />
        </div>
        <bottom-navigation />
      </div>
    </v-app>
  </div>
</template>
<script src="./js/usersidebar.js"></script>

<style scoped>

.view {
  background: rgb(248 250 252 / 1) !important;
  /* overflow-x: scroll; */
  padding-bottom: 80px;
}
</style>
