import { mapGetters } from "vuex";
import dialoghapusUser from "~/components/dialoghapusUser.vue";
export default {
  layout: "AdminSideBar",
  middleware: ["guestmiddleware", "rolecheckmiddleware"],
  components: {
    dialoghapusUser,
  },
  data() {
    return {
      dialogTambahAlamat: false,
      dialogUpdateAlamat: false,
      dialogHapusAlamat: false,
      dialogTambahDetailAlamat: false,
      dialogUpdateDetailAlamat: false,
      dialogHapusDetailAlamat: false,
      inputTambahAlamat: {
        rt_id: null,
        nama: null,
      },
      inputEditAlamat: {
        rt_id: null,
        nama: null,
      },
      headerAlamat: [
        { text: "Alamat", value: "nama" },
        { text: "RT", value: "r_t.rt" },
        { text: "Aksi", value: "aksi" },
      ],
      headerDetailAlamat: [
        { text: "Detail Alamat", value: "nama" },
        { text: "Alamat", value: "alamat.nama" },
        { text: "Aksi", value: "aksi" },
      ],
      inputHapusAlamat: [],
      inputTambahDetailAlamat: {
        alamat_id: null,
        nama: null,
      },
      inputEditDetailAlamat: {
        alamat_id: null,
        nama: null,
      },
      inputHapusDetailAlamat: [],
      dataCookies: null,
      loadingData: true,
    };
  },
  computed: {
    ...mapGetters({
      getjumlahWargaAndTransaksiAndLaporan:
        "admindata/getjumlahWargaAndTransaksiAndLaporan",
      getdataAllRt: "adminrw/getdataAllRt",
      getdataAllAlamat: "adminrw/getdataAllAlamat",
      getdataAllDetailAlamat: "adminrw/getdataAllDetailAlamat",
    }),
  },
  methods: {
    tambahAlamat() {
      this.inputTambahAlamat = Object.assign({}, null);
      this.dialogTambahAlamat = true;
    },
    closetambahAlamat() {
      this.dialogTambahAlamat = false;
      this.inputTambahAlamat = Object.assign({}, null);
    },
    async konfirmtambahAlamat() {
      this.dialogTambahAlamat = false;
      await this.$store.dispatch(
        "adminrw/tambahallalamat",
        this.inputTambahAlamat
      );
      await this.$store.dispatch("adminrw/getallalamat");
      this.inputTambahAlamat = Object.assign({}, null);
    },
    EditAlamat(item) {
      this.inputEditAlamat = Object.assign({}, item);
      this.dialogUpdateAlamat = true;
    },
    closeEditAlamat() {
      this.dialogUpdateAlamat = false;
      this.inputEditAlamat = Object.assign({}, null);
    },
    async konfirmEditAlamat() {
      this.dialogUpdateAlamat = false;
      await this.$store.dispatch("adminrw/updateAlamat", this.inputEditAlamat);
      await this.$store.dispatch("adminrw/getallalamat");
      this.inputEditAlamat = Object.assign({}, null);
    },
    HapusAlamat(item) {
      this.inputHapusAlamat = Object.assign({}, item);
      this.dialogHapusAlamat = true;
    },
    closeHapusAlamat() {
      this.dialogHapusAlamat = false;
      this.inputHapusAlamat = Object.assign({}, null);
    },
    async konfirmHapusAlamat() {
      this.dialogHapusAlamat = false;
      await this.$store.dispatch("adminrw/deleteAlamat", this.inputHapusAlamat);
      await this.$store.dispatch("adminrw/getallalamat");
      this.inputHapusAlamat = Object.assign({}, null);
    },

    tambahDetailAlamat() {
      this.inputTambahDetailAlamat = Object.assign({}, null);
      this.dialogTambahDetailAlamat = true;
    },
    closetambahDetailAlamat() {
      this.dialogTambahDetailAlamat = false;
      this.inputTambahDetailAlamat = Object.assign({}, null);
    },
    async konfirmtambahDetailAlamat() {
      this.dialogTambahDetailAlamat = false;
      await this.$store.dispatch(
        "adminrw/tambahDetailAlamat",
        this.inputTambahDetailAlamat
      );
      await this.$store.dispatch("adminrw/getAllDetailAlamat");
      this.inputTambahDetailAlamat = Object.assign({}, null);
    },
    EditDetailAlamat(item) {
      this.inputEditDetailAlamat = Object.assign({}, item);
      this.dialogUpdateDetailAlamat = true;
    },
    closeEditDetailAlamat() {
      this.dialogUpdateDetailAlamat = false;
      this.inputEditDetailAlamat = Object.assign({}, null);
    },
    async konfirmEditDetailAlamat() {
      this.dialogUpdateDetailAlamat = false;
      await this.$store.dispatch(
        "adminrw/updateDetailAlamat",
        this.inputEditDetailAlamat
      );
      await this.$store.dispatch("adminrw/getAllDetailAlamat");
      this.inputEditDetailAlamat = Object.assign({}, null);
    },
    HapusDetailAlamat(item) {
      this.inputHapusDetailAlamat = Object.assign({}, item);
      this.dialogHapusDetailAlamat = true;
    },
    closeHapusDetailAlamat() {
      this.dialogHapusDetailAlamat = false;
      this.inputHapusDetailAlamat = Object.assign({}, null);
    },
    async konfirmHapusDetailAlamat() {
      this.dialogHapusDetailAlamat = false;
      await this.$store.dispatch(
        "adminrw/deleteDetailAlamat",
        this.inputHapusDetailAlamat
      );
      await this.$store.dispatch("adminrw/getAllDetailAlamat");
      this.inputHapusDetailAlamat = Object.assign({}, null);
    },
    required(v) {
      return !!v || "Input tidak boleh kosong";
    },
  },

  async created() {
    this.dataCookies = this.$cookies.get("dataUser").data.role;
    await this.$store.dispatch(
      "admindata/fetchjumlahWargaAndTransaksiAndLaporan"
    );
    if (this.dataCookies === "Admin RW") {
      await this.$store.dispatch("adminrw/fetchDataAllRT");
      await this.$store.dispatch("adminrw/getallalamat");
      await this.$store.dispatch("adminrw/getAllDetailAlamat");
    }
    this.loadingData = false;
  },
};
