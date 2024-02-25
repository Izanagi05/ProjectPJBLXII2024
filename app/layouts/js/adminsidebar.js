import NavbarBeranda from'~/components/NavbarBeranda.vue'
export default{
  components:{
    NavbarBeranda
  },
data() {
  return {
    urladmin: [
      {
        judul: "Beranda",
        rute: "/admin/beranda",
        icon: "mdi-view-dashboard-outline",
      },
      {
        judul: "Data Warga",
        rute: "/admin/beranda/datawarga",
        icon: "mdi-bell-outline",
      },
      {
        judul: "Data IPL",
        rute: "/admin/beranda/dataipl",
        icon: "mdi-history",
      },
      {
        judul: "Data Transaksi",
        rute: "/admin/beranda/laporaniuran",
        icon: "mdi-history",
      },
      {
        judul: "Pembayaran Masuk",
        rute: "/admin/beranda/laporaniuran",
        icon: "mdi-history",
      },
      {
        judul: "Pengeluaran",
        rute: "/admin/beranda/laporanpengeluaran",
        icon: "mdi-history",
      },
      {
        judul: "Admin Control",
        rute: "/admin/beranda/admin-control",
        icon: "mdi-history",
      },
      {
        judul: "Manajemen Iuran",
        rute: "/admin/beranda/manajemen-iuran",
        icon: "mdi-history",
      },
    ],
  }
},
async created() {
  await this.$store.dispatch('user/fetchUserLogin')
},
}
