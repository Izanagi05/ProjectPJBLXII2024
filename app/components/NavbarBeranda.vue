<template>
  <div>
    <v-dialog  class="rounded-xl dialog-event"
      v-model="dialoglogout"
      style="box-shadow: 0px"
      max-width="600"
    >
      <v-card
        style="box-shadow: none"
        class="rounded-xl bg-whiteblur-card1 py-10 px-8"
      >
      <div class="mt-6  mb-10">

        <div class="text-h5 font-weight-medium  ">Yakin ingin  logout?</div>
        <p class="black--text mt-2 text-body-1">Silahkan login lagi setelah logout</p>
      </div>
      <div class="d-flex justify-space-between">
              <v-btn
                class="rounded-xl  text-capitalize   black--text"
                @click="dialoglogout=false"
                >
                Batal</v-btn
              >
              <v-btn
                class="rounded-xl text-capitalize d-flex red white--text"
                @click="konfirmlogout"

                ><v-icon class="white--text " small>mdi-logout</v-icon>
               Logout </v-btn
              >
            </div>
      </v-card>
    </v-dialog>
    <v-navigation-drawer  floating class="pa-4 white rounded-r-xl"
    v-if="$vuetify.breakpoint.smAndDown && dataCookies.includes('Admin')"
        v-model="drawer"
        style="position: fixed"
        temporary
      >
        <div
          class=""
          style="
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
          "
        >
          <div>
            <p class="font-weight-medium text-body-1 mb-">Menu</p>
            <v-tooltip v-for="(item, index) in filteredUrlAdmin" right :key="index">
              <template v-slot:activator="{ on, attrs }">
                <v-list-item
                  text
                  v-on="on"
                  v-bind="attrs"
                  rounded
                  :ripple="false"
                  :class="[
                    'd-flex  align-center mb-4 justify-start text-capitalize text-2 rounded-lg',
                    $route.path === item.rute ? 'routeactive white--text' : '',
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
          </div>
        </div>
      </v-navigation-drawer>
    <div :class="['px-4 py-2 d-flex justify-space-between backdrop-blur-lg   align-center  ', dataCookies.includes('Admin')?'':'positionfixed']"  style="z-index:40;width: 100%;">
      <v-app-bar-nav-icon
      v-if="$vuetify.breakpoint.smAndDown && dataCookies.includes('Admin')"
        @click.stop="drawer = !drawer"
      />
      <div class="d-flex align-center justify-space-between" style="width:100%;">
        <p class="font-weight-medium mb-0 text-body-1">
          {{ hari }}
        </p>
        <v-btn icon class="red" @click="dialoglogout=true"><v-icon class="white--text" >mdi-logout</v-icon></v-btn>
      </div>
      <!-- <div class="d-flex align-center justify-end" style="width:100%;"> -->
      <!-- </div> -->

    </div>
  </div>
</template>
<script>
export default {
  data: () => ({
    menunotif: false,
    dialoglogout: false,
    tanggal: new Date(),
    hari: "_",
    drawer: false,
    formatTgl: null,
    url: [
      {
        judul: "Beranda",
        rute: "/beranda",
        icon: "mdi-view-dashboard-outline",
      },
      {
        judul: "Data Keluarga",
        rute: "/beranda/datakeluarga",
        icon: "mdi-bell-outline",
      },
      {
        judul: "Buat Surat Pengantar",
        rute: "/beranda/riwayatlaporan",
        icon: "mdi-history",
      },
      {
        judul: "Data IPL",
        rute: "/beranda/riwayatlaporan",
        icon: "mdi-history",
      },
      {
        judul: "Tata Tertib",
        rute: "/beranda/riwayatlaporan",
        icon: "mdi-history",
      },
    ],
    urladmin: [
    ],
    descdialogpanic: false,
    menu: false,

    menuItems: [
      { icon: "mdi-plus", judul: "Profil", color: "" },
      { icon: "mdi-plus", judul: "Beranda", color: "" },
      { icon: "mdi-logout", judul: "Logout", color: "red--text" },
      // Tambahkan item-item lain sesuai kebutuhan
    ],
    dataCookies:[],
  }),
  computed: {
     filteredUrlAdmin() {
      return this.urladmin.filter((item) => {
        return item.kondisi;
      });
    },
    formatTgl2() {
      const formatter = new Intl.DateTimeFormat("id-ID", {
        day: "numeric",
        month: "long",
        year: "numeric",
      });
      return formatter.format(this.tanggal);
    },
  },
  mounted() {
    // this.getCurrentLocation();
    const kk = `1`;
    if (new Date().getHours() >= 18 || new Date().getHours() == `00`) {
      this.hari = "Selamat Malam";
    } else if (new Date().getHours() < 12) {
      this.hari = "Selamat Pagi";
      // console.log(this.jam)
    } else if (new Date().getHours() >= 12 && new Date().getHours() < 15) {
      this.hari = "Selamat Siang";
    } else if (new Date().getHours() >= 15 && new Date().getHours() < 18) {
      this.hari = "Selamat Sore";
    } else {
      this.hari = "_";
    }
  },
  methods: {
    itemcek(item) {
    if (
      (item.judul === "Admin Control" ||item.judul === "Manajemen Iuran")&&
      this.$cookies.get("dataUser").data.role !=='Admin RW'
    ) {
      return false;
    }
    return true;
  },
    konfirmlogout() {
      this.$store.dispatch("user/postLogout");
    },
  },
  async created() {
   this.urladmin = [
      {
        kondisi: true,
        judul: "Beranda",
        rute: "/admin/beranda",
        icon: "mdi-view-dashboard-outline",
      },
      {
        kondisi: true,
        judul: "Data Warga",
        rute: "/admin/beranda/datawarga",
        icon: "mdi-bell-outline",
      },
      {
        kondisi: true,
        judul: "Data IPL",
        rute: "/admin/beranda/dataipl",
        icon: "mdi-chart-line",
      },
      {
        kondisi: true,
        judul: "Pembayaran Masuk",
        rute: "/admin/beranda/laporaniuran",
        icon: "mdi-currency-usd",
      },
      {
        kondisi: true,
        judul: "Pengeluaran",
        rute: "/admin/beranda/laporanpengeluaran",
        icon: "mdi-cash",
      },
      {
        kondisi:
          this.$cookies.get("dataUser").data.role === "Admin RW" ,
        judul: "Data RW",
        rute: "/admin/beranda/data-rw",
        icon: "mdi-cog-outline",
      },
      {
        kondisi: this.$cookies.get("dataUser").data.role === "Admin RW",
        judul: "Admin Control",
        rute: "/admin/beranda/admin-control",
        icon: "mdi-account-wrench-outline",
      },
      {
        kondisi: this.$cookies.get("dataUser").data.role === "Admin RW",
        judul: "Manajemen Iuran",
        rute: "/admin/beranda/manajemen-iuran",
        icon: "mdi-file-document-outline",
      },
      {
        kondisi: this.$cookies.get("dataUser").data.role === "Admin RW",
        judul: "Manajemen RT",
        rute: "/admin/beranda/rt-manajemen",
        icon: "mdi-cog-outline ",
      },
      {
        kondisi: this.$cookies.get("dataUser").data.role === "Admin RW",
        judul: "Manajemen Info",
        rute: "/admin/beranda/info-manajemen",
        icon: "mdi-cellphone-information ",
      },
    ];
   this.dataCookies= this.$cookies.get("dataUser").data.role
  },
};
</script>

<style scoped>
.positionfixed {
  position: fixed !important;
}
</style>
