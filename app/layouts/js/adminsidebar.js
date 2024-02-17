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
        rute: "/beranda/notifikasi",
        icon: "mdi-bell-outline",
      },
      {
        judul: "Data Keluarga",
        rute: "/beranda/riwayatlaporan",
        icon: "mdi-history",
      },
      {
        judul: "Data IPL",
        rute: "/beranda/riwayatlaporan",
        icon: "mdi-history",
      },
      {
        judul: "Data Transaksi",
        rute: "/beranda/riwayatlaporan",
        icon: "mdi-history",
      },
      {
        judul: "Pembayaran Masuk",
        rute: "/beranda/riwayatlaporan",
        icon: "mdi-history",
      },
      {
        judul: "Pembayaran Keluar",
        rute: "/beranda/riwayatlaporan",
        icon: "mdi-history",
      },
      {
        judul: "Laporan Iuran",
        rute: "/beranda/riwayatlaporan",
        icon: "mdi-history",
      },
      {
        judul: "Laporan Pengeluaran",
        rute: "/beranda/riwayatlaporan",
        icon: "mdi-history",
      },
    ],
  }
},
}
