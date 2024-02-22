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
    <div class="px-4 py-2 d-flex justify-space-between backdrop-blur-lg   align-center "  style="z-index:40;position: fixed;width: 100%;">
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
    dialoglogout:false,
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
    url2: [
      {
        judul: "Beranda",
        rute: "/admin/beranda",
        icon: "mdi-view-dashboard-outline",
      },
      {
        judul: "Admin Control",
        rute: "/admin/beranda/admin-control",
        icon: "mdi-account-cog",
      },
      {
        judul: "Data Laporan",
        rute: "/admin/beranda/data-laporan",
        icon: "mdi-file-chart",
      },
      {
        judul: "Notifikasi",
        rute: "/admin/beranda/notifikasi",
        icon: "mdi-bell-outline",
      },
      {
        judul: "Log Aktivitas",
        rute: "/admin/beranda/log-aktivitas",
        icon: "mdi-history",
      },
    ],
    descdialogpanic: false,
    menu: false,

    menuItems: [
      { icon: "mdi-plus", judul: "Profil", color: "" },
      { icon: "mdi-plus", judul: "Beranda", color: "" },
      { icon: "mdi-logout", judul: "Logout", color: "red--text" },
      // Tambahkan item-item lain sesuai kebutuhan
    ],
  }),
  computed: {
    formatTgl() {
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
  computed: {},
  methods: {

    konfirmlogout(){
      this.$store.dispatch('user/postLogout')
    }
  },
};
</script>
