<template>
  <div>
    <v-app-bar style="z-index: 20;"
      :class="[scrollPosition>50 ?'backdrop-blur-lg ':'transparent']"
      :elevation="elevation"
      fixed
    >
      <v-app-bar-nav-icon v-if="$vuetify.breakpoint.smAndDown" :color="menucolor" @click.stop="drawer = !drawer" />
      <div class="px-4" style="width:100%;">
        <div class="d-flex justify-space-between align-center">
          <div class="d-flex text-start align-center">
            <nuxt-link
              to="/"
              :class="['font-weight-bold text-decoration-none', $vuetify.breakpoint.smAndDown ? 'ml-2' : 'ml-4 text-h6']"
              :style="{ color: textcolor }"
            >
              LayananWarga
            </nuxt-link>
          </div>
          <div v-if="!$vuetify.breakpoint.smAndDown">
            <div class="link d-flex justify-end align-center">
              <nuxt-link
                v-for="(rute, index) in navigationLinks"
                :key="index"
                :to="`/${rute.id}`"
                class="text-decoration-none  mr-4"
                :style="{ color: textcolor }"
              >
                {{ rute.judul }}
              </nuxt-link>
              <!-- Tombol Login -->
              <v-btn v-if="dataLoginCookies"
                :class="['text-capitalize px-4 text-body-1 font-weight-medium rounded-lg ml-4', textcolor === '#ffffff' ? 'text-1' : 'white--text']"
                :color="textcolor"
                to="/login"
                style="transition: background-color 0.3s ease-in-out"
              >
                Login
              </v-btn>
            </div>
          </div>
        </div>
      </div>
    </v-app-bar>
    <v-navigation-drawer
      v-if="$vuetify.breakpoint.smAndDown"
      v-model="drawer"
      class="rounded-e-lg"
      style="position: fixed"
      temporary
    >
      <v-card class="sidebar-profil pa-4   rounded-lg" style="height:100%;">
        <v-icon v-if="$vuetify.breakpoint.smAndDown" color="black" class="  mb-4" @click.stop="drawer = !drawer">
          mdi-close
        </v-icon>
        <div
          :class="[
            'font-weight-bold  mb-4 text-2',
            $vuetify.breakpoint.smAndDown ? 'text-subtitle-6' : 'text-h5',
          ]"
        >
Menu
        </div>
        <div v-for="(rute, i) in navigationLinks" :key="i" class="ml-2  my-4 ">
          <nuxt-link :to="`/${rute.id}`" class="text-2 text-decoration-none ">
            {{ rute.judul }}
          </nuxt-link>
        </div>
        <v-btn v-if="!dataLoginCookies"
                :class="['text-capitalize px-4 text-body-1 bg-1 white--text font-weight-medium rounded-lg ']"

                to="/login"
                style="transition: background-color 0.3s ease-in-out;width: 100%;"
              >
                Login
              </v-btn>
        <div />
      </v-card>
    </v-navigation-drawer>
  </div>
</template>

<script>
export default {
  data () {
    return {
      drawer: false,
      dataLoginCookies:0,
      no_admin: '6281563151038',
      navigationLinks: [
        { judul: 'Beranda', id: '' },
        { judul: 'Kontak kami', id: 'kontak' }
      ],
      menu: false,
      lebihlanjutlinks: [
        { judul: 'Kontak kami', id: 'kontak' }
      ],
      scrollPosition: 0,
      textcolor: '#102E46',
      menucolor: '#102E46',
      navBackgroundColor: 'transparent',
      elevation: 0
    }
  },
  mounted () {
    window.addEventListener('scroll', this.handleScroll)
  },
  beforeDestroy () {
    window.removeEventListener('scroll', this.handleScroll)
  },
  methods: {
    handleScroll () {
      this.scrollPosition = window.scrollY
      if (this.scrollPosition > 50) {
        this.navBackgroundColor = '#ffffff'
        // this.textcolor = '#1185FF'
        // this.menucolor = '#404145'
        this.elevation = 2
      } else {
        this.navBackgroundColor = 'transparent'
        this.textcolor = '#102E46'
        this.menucolor = '#102E46'
        this.elevation = 0
      }
    }
  }
}
</script>

<style scoped>
.html {
  background-color: #fff;
  overflow: hidden;
}
</style>
