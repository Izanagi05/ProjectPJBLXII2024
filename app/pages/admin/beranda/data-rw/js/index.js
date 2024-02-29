import dialoghapusUser from "~/components/dialoghapusUser.vue";
import { mapGetters } from "vuex";
export default {
  components: { dialoghapusUser },
  layout: "AdminSideBar",
  middleware: ["guestmiddleware", "rolecheckmiddleware", "adminrwmiddleware"],

  data() {
    return {
      activePicker: null,
      date: null,
      menu: false,
      checktmptlahir: false,
      modal: false,
      datePickerFormat: "YYYY-MM-DD",
      editActive: false,
      qrCodeUrl: null,
      loadingData: true,
      inputEditRW: {
        nama: null,
        no: null,
        tanggal: null,
        kota: null,
        alamat: null,
        alamat_lengkap: null,
        ketua_rw: null,
        wakil_rw: null,
      },
      isRefreshing:false,
    };
  },
  computed: {
    ...mapGetters({
      getdataQRcODE: "adminrw/getdataQRcODE",
      getdataRw: "adminrw/getdataRw",
    }),
  },
  watch: {
    menu(val) {
      val && setTimeout(() => (this.activePicker = "YEAR"));
    },
  },
  methods: {
 async   refreshQrKode(){

   this.isRefreshing = true;
  await this.$store.dispatch("adminrw/getQrCodeinUrl");
  setTimeout(() => {
    this.isRefreshing = false;
  }, 3000);
    },
    async simpanData() {
      this.editActive = !this.editActive;
      await this.$store.dispatch("adminrw/updateRW", this.inputEditRW);
      await this.$store.dispatch("adminrw/getRW");
    },
    fetchQRCode() {
      // Lakukan permintaan HTTP ke endpoint server bot untuk mendapatkan QR code
    },
    parseDate(date) {
      if (!date) return null;

      const [month, day, year] = date.split("/");
      return `${year}-${month.padStart(2, "0")}-${day.padStart(2, "0")}`;
    },
    save(date) {
      this.$refs.menu.save(date);
      // this.dataEdit.tgl_lahir = date.toISOString().substring(0, 10);
    },
    required(v) {
      return !!v || "Input tidak boleh kosong";
    },
  },
  async created() {
    await this.$store.dispatch("adminrw/getRW");
    this.inputEditRW = Object.assign({}, this.$store.state.adminrw.dataRw);
    try {
      await this.$store.dispatch("adminrw/getQrCodeinUrl");
    } catch (error) {
      console.log("Terrjadi kesalahan atau bot belum menyala");
    }
    this.loadingData = false;
  },
};
