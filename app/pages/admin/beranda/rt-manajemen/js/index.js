import dialoghapusUser from "~/components/dialoghapusUser.vue";
import { mapGetters } from "vuex";
export default {
  components: { dialoghapusUser },
  layout: "AdminSideBar",
  middleware: ["guestmiddleware", "rolecheckmiddleware", "adminrwmiddleware"],
  components:{
    dialoghapusUser
  },
  data() {
    return {
      dialogTambah: false,
      dialogEdit: false,
      dialogHapus: false,
      header: [
        { text: "RT", value: "rt" },
        { text: "Ketua RT ", value: "ketua_rt" },
        { text: "Wakil Ketua RT", value: "wakil_ketua_rt" },
        { text: "Aksi", value: "aksi" },
      ],
      loadingData: true,
      inputTambah: {
        rt: null,
        ketua_rt: null,
        wakil_ketua_rt: null,
      },
      inputEdit: {
        rt: null,
        ketua_rt: null,
        wakil_ketua_rt: null,
      },
      inputHapus: [],
      dataCookies: null,
    };
  },
  computed: {
    ...mapGetters({
      getdataAllRt: "adminrw/getdataAllRt",
    }),
  },
  methods: {
    tambahRt() {
      this.inputTambah = Object.assign({}, null);
      this.dialogTambah = true;
    },
    closetambahRt() {
      this.dialogTambah = false;
      this.inputTambah = Object.assign({}, null);
    },
    async konfirmtambahRt() {
      this.dialogTambah = false;
      await this.$store.dispatch("adminrw/storeRT", this.inputTambah);
      await this.$store.dispatch("adminrw/fetchDataAllRT");
      this.inputTambah = Object.assign({}, null);
    },
    EditRt(item) {
      this.inputEdit = Object.assign({}, item);
      this.dialogEdit = true;
    },
    closeEditRt() {
      this.dialogEdit = false;
      this.inputEdit = Object.assign({}, null);
    },
    async konfirmEditRt() {
      this.dialogEdit = false;
      await this.$store.dispatch("adminrw/updateRT", this.inputEdit);
      await this.$store.dispatch("adminrw/fetchDataAllRT");
      this.inputEdit = Object.assign({}, null);
    },
    HapusRt(item) {
      this.inputHapus = Object.assign({}, item);
      this.dialogHapus = true;
    },
    closeHapusRt() {
      this.dialogHapus = false;
      this.inputHapus = Object.assign({}, null);
    },
    async konfirmHapusRt() {
      this.dialogHapus = false;
      await this.$store.dispatch("adminrw/deleteRT", this.inputHapus);
      await this.$store.dispatch("adminrw/fetchDataAllRT");
      this.inputHapus = Object.assign({}, null);
    },
    required(v) {
      return !!v || "Input tidak boleh kosong";
    },
  },
  async created() {

    this.dataCookies = this.$cookies.get("dataUser").data.role;

    await this.$store.dispatch("adminrw/fetchDataAllRT");
    this.loadingData = false;
  },
};
