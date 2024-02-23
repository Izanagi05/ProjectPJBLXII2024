<template>
  <div>
    <v-app>
      <v-row class="ma-0 bgbrd-1" style="overflow-y: hidden; height: 100vh">
        <v-col
          v-if="!$vuetify.breakpoint.smAndDown"
          cols="12"
          lg="2"
          md="2"
          sm="12"
          xs="12"
          class="pa-4"
        >
          <nuxt-link to="/beranda" class="text-decoration-none">
            <div class="d-flex align-center mt-4 mb-6">
              <v-img
                :src="require('~/assets/img/beranda/logo2.png')"
                max-width="40"
              ></v-img>
              <div
                :class="[
                  'font-weight-bold text-decoration-none text-logo',
                  $vuetify.breakpoint.smAndDown ? '' : ' text-body-1',
                ]"
              >
                LayananWarga
              </div>
            </div>
          </nuxt-link>
          <v-navigation-drawer permanent floating class="white rounded-xl">
            <p class="font-weight-medium text-body-1 ma-4">Menu</p>
            <div
              style="height: 90vh; overflow-y: scroll"
              class="pa-4 rounded-xl"
            >
              <!-- <div> -->

              <v-tooltip v-for="(item, index) in urladmin" right :key="index">
                <template v-slot:activator="{ on, attrs }">
                  <v-list-item
                    text
                    v-on="on"
                    v-bind="attrs"
                    rounded
                    :ripple="false"
                    :class="[
                      'd-flex  align-center mb-4 justify-start text-capitalize text-2 rounded-lg',
                      $route.path === item.rute
                        ? 'routeactive white--text'
                        : '',
                    ]"
                    @click="$router.push(item.rute)"
                  >
                    <v-icon
                      :color="$route.path === item.rute ? '#ffffff' : '#364F6B'"
                      >{{ item.icon }}</v-icon
                    >
                    <div class="ma-0 text-body-2 text-truncate ml-2">
                      {{ item.judul }}
                    </div>
                  </v-list-item>
                </template>
                <span> {{ item.judul }}</span>
              </v-tooltip>
              <!-- </v-list> -->
              <!-- </div> -->
            </div>
          </v-navigation-drawer>
        </v-col>
        <v-col
          cols="12"
          lg="10"
          md="10"
          sm="12"
          xs="12"
          :class="['pa-0', $vuetify.breakpoint.smAndDown ? 'pb-15' : '']"
        >
          <navbar-beranda />
          <div
            class="view bgrbrd-1 pa-4"
            style="height: 100vh; overflow-y: scroll;padding-top: 80px !important;"
          >
            <nuxt />
          </div>
        </v-col>
      </v-row>
    </v-app>
  </div>
</template>
<script src="./js/adminsidebar.js"></script>

<style scoped>
.view {
  background: rgb(248 250 252 / 1) !important;
  /* overflow-x: scroll; */
  padding-bottom: 80px;
}
</style>
