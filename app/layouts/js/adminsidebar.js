import NavbarBeranda from "~/components/NavbarBeranda.vue";

export default {
  components: {
    NavbarBeranda,
  },
  data() {
    return {
      urladmin: [],
    };
  },
  computed: {
    filteredUrlAdmin() {
      return this.urladmin.filter((item) => {
        return item.kondisi;
      });
    },
  },
  methods: {
    itemcek(item) {
      if (item.kondisi) {
        return false;
      }
      return true;
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
    await this.$store.dispatch("user/fetchUserLogin");
  },
};
