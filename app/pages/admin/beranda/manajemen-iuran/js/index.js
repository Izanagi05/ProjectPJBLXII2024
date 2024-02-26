import dialoghapusUser from "~/components/dialoghapusUser.vue";
import { mapGetters } from "vuex";
export default {
  components: { dialoghapusUser },
  layout: "AdminSideBar",
  middleware: ["guestmiddleware", "rolecheckmiddleware", "adminrwmiddleware"],
  data() {
    return {
      loadingData: true,
      dialogtambahTahun: false,
      dialogEditTahun: false,
      dialogHapusTahun: false,
      inputHapusTahun:[],
      inputTambahTahun: {
        checkyearwithtagihan:false,
        tahun: null,
        jenis_iuran_id: null,
      },
      inputEditTahun: {
        checkyearwithtagihan:false,
        tahun: null,
        jenis_iuran_id: null,
      },

      dialogtambahJenisIuran: false,
      dialogEditJenisIuran: false,
      dialogHapusJenisIuran: false,
      inputHapusJenisIuran:[],
      inputTambahJenisIuran: {
        nama:null,
        deskripsi:null,
        jumlah:null,
        tahun_id:null,
        bulan_id:null,
        withtagihan: false,
        semuabulan: false,
      },
      inputEditJenisIuran: {
        nama:null,
        deskripsi:null,
        jumlah:null,
        tahun_id:null,
        bulan_id:null,
        withtagihan: false,
        semuabulan: false,
      },
      headers: [
        { text: "Tahun", value: "tahun" },
        { text: "Aksi", value: "aksi" },
      ],
      headersIuran: [
        { text: "Nama", value: "nama" },
        { text: "Deskripsi", value: "deskripsi" },
        { text: "Terbilang", value: "jumlah" },
        { text: "Aksi", value: "aksi" },
      ],
    };
  },
  computed: {
    ...mapGetters({
      getdataAllJenisIurans: "adminrw/getdataAllJenisIurans",
      getdataAllYears: "adminrw/getdataAllYears",
      getdataAlldataAllBulan: "adminrw/getdataAlldataAllBulan",
    }),
  },
  methods: {
    tambahTahun() {
      this.inputTambahTahun = Object.assign({}, null);
      this.dialogtambahTahun = true;
    },
    closeTambahTahun() {
      this.dialogtambahTahun = false;
      this.inputTambahTahun = Object.assign({}, null);
    },
    async konfirmTambahTahun() {
      this.dialogtambahTahun = false;
      await this.$store.dispatch("adminrw/createNewYear",
         this.inputTambahTahun,
      );
      await  this.$store.dispatch('adminrw/getAllTahun')
    },
    EditTahun(item) {
      this.inputEditTahun = Object.assign({}, item);
      this.dialogEditTahun = true;
    },
    closeEditTahun() {
      this.dialogEditTahun = false;
      this.inputEditTahun = Object.assign({}, null);
    },
    async konfirmEditTahun() {
      this.dialogEditTahun = false;
      await this.$store.dispatch("adminrw/updateTahun",
        this.inputEditTahun,
      );
      await  this.$store.dispatch('adminrw/getAllTahun')
    },
    HapusTahun(item) {
      this.inputHapusTahun = Object.assign({}, item);
      this.dialogHapusTahun = true;
    },
    closeHapusTahun() {
      this.dialogHapusTahun = false;
      this.inputHapusTahun = Object.assign({}, null);
    },
    async konfirmHapusTahun() {
      this.dialogHapusTahun = false;
      await this.$store.dispatch("adminrw/deleteYear",
         this.inputHapusTahun,
      );
      await  this.$store.dispatch('adminrw/getAllTahun')
    },


    tambahJenisIuran() {
      this.inputTambahJenisIuran = Object.assign({}, null);
      this.dialogtambahJenisIuran = true;
    },
    closeTambahJenisIuran() {
      this.dialogtambahJenisIuran = false;
      this.inputTambahJenisIuran = Object.assign({}, null);
    },
    async konfirmTambahJenisIuran() {
      this.dialogtambahJenisIuran = false;
      await this.$store.dispatch("adminrw/createJenisIuran",
         this.inputTambahJenisIuran,
      );
      await this.$store.dispatch("adminrw/getAllJenisIurans");
    },
    EditJenisIuran(item) {
      this.inputEditJenisIuran = Object.assign({}, item);
      this.dialogEditJenisIuran = true;
    },
    closeEditJenisIuran() {
      this.dialogEditJenisIuran = false;
      this.inputEditJenisIuran = Object.assign({}, null);
    },
    async konfirmEditJenisIuran() {
      this.dialogEditJenisIuran = false;
      await this.$store.dispatch("adminrw/updateJenisIuran",
        this.inputEditJenisIuran,
      );
      await this.$store.dispatch("adminrw/getAllJenisIurans")
    },
    HapusJenisIuran(item) {
      this.inputHapusJenisIuran = Object.assign({}, item);
      this.dialogHapusJenisIuran = true;
    },
    closeHapusJenisIuran() {
      this.dialogHapusJenisIuran = false;
      this.inputHapusJenisIuran = Object.assign({}, null);
    },
    async konfirmHapusJenisIuran() {
      this.dialogHapusJenisIuran = false;
      await this.$store.dispatch("adminrw/deleteJenisIuran",
         this.inputHapusJenisIuran,
      );
      await this.$store.dispatch("adminrw/getAllJenisIurans");
    },
    required(v) {
      return !!v || "Input tidak boleh kosong";
    },
  },
  async created() {
    this.loadingData = false;
    await this.$store.dispatch("adminrw/getAllJenisIurans");
    await this.$store.dispatch("adminrw/getAllBulan");
    await this.$store.dispatch("adminrw/getAllTahun");
  },
};
