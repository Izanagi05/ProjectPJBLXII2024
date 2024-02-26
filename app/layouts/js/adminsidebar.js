import NavbarBeranda from'~/components/NavbarBeranda.vue'
export default{
  components:{
    NavbarBeranda
  },
data() {
  return {
    urladmin: [

    ],
  }
},
computed: {
  filteredUrlAdmin() {
    return this.urladmin.filter((item) => this.itemcek(item));
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
},
async created() {
  this.urladmin=[
    {
      kondisi:true,
      judul: "Beranda",
      rute: "/admin/beranda",
      icon: "mdi-view-dashboard-outline",
    },
    {
      kondisi:true,
      judul: "Data Warga",
      rute: "/admin/beranda/datawarga",
      icon: "mdi-bell-outline",
    },
    {
      kondisi:true,
      judul: "Data IPL",
      rute: "/admin/beranda/dataipl",
      icon: "mdi-history",
    },
    {
      kondisi:true,
      judul: "Pembayaran Masuk",
      rute: "/admin/beranda/laporaniuran",
      icon: "mdi-history",
    },
    {
      kondisi:true,
      judul: "Pengeluaran",
      rute: "/admin/beranda/laporanpengeluaran",
      icon: "mdi-history",
    },
    {
      kondisi:this.$cookies.get("dataUser").data.role==='Admin RW',
      judul: "Admin Control",
      rute: "/admin/beranda/admin-control",
      icon: "mdi-history",
    },
    {
      kondisi:this.$cookies.get("dataUser").data.role==='Admin RW',
      judul: "Manajemen Iuran",
      rute: "/admin/beranda/manajemen-iuran",
      icon: "mdi-history",
    },
  ]
  await this.$store.dispatch('user/fetchUserLogin')
},
}
