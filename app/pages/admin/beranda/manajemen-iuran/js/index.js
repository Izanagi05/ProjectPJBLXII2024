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
      headers: [
        { text: "Tahun", value: "tahun" },
        { text: "Aksi", value: "aksi" },
      ],
    };
  },
  computed: {
    ...mapGetters({
      getdataAllJenisIurans: "adminrw/getdataAllJenisIurans",
      getdataAllYears: "adminrw/getdataAllYears",
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
    required(v) {
      return !!v || "Input tidak boleh kosong";
    },
  },
  async created() {
    this.loadingData = false;
    await this.$store.dispatch("adminrw/getAllJenisIurans");
    await this.$store.dispatch("adminrw/getAllTahun");
  },
};
