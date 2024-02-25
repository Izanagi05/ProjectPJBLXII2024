import dialoghapusUser from "~/components/dialoghapusUser.vue";
import { mapGetters } from "vuex";
export default {
  components:{dialoghapusUser},
  layout: "AdminSideBar",
  middleware: ["guestmiddleware", "rolecheckmiddleware", "adminrwmiddleware"],
  data() {
    return {
      cari: "",
      debounceInterval: null,
      debounceDelay: 3000,
      dialoghapus: false,
      dialogtambah: false,
      userId: null,
      loading: false,
      dialogubahPass: false,
      adminDataDialog: {
        user_id: null,
        new_password: null,
        confirm_password: null,
      },
      lihat:false,
      lihat2:false,
      headers: [
        { text: "Nama ", value: "user_data.name" },
        { text: "No Telp ", value: "user_data.phone" },
        { text: "Email ", value: "user_data.email" },
        { text: "Role Admin", value: "admin_role.nama" },
        { text: "Status ", value: "user_data.status" },
        { text: "Ubah Password ", value: "ubah_pass" },
        { text: "Aksi ", value: "action" },
      ],
      inputTambah: {
        user_id: null,
        admin_role_id: null,
        nama: null,
        jenis_kelamin: null,
        nik: null,
        no_kk: null,
        foto_ktp: null,
        foto_kk: null,
        provinsi_lahir_id: null,
        tempat_lahir_lainnya: null,
        tgl_lahir: null,
        no_telp: null,
        pekerjaan: null,
        hubungan: null,
        status_berktp: null,
        status_perkawinan: null,
        agama_id: null,
        detail_alamat_id_and_alamat_id: [],
      },
      data_alamat_by_rt:{

        alamat_id: null,
        detail_alamat_id: null,
      },
      inputFileTambah: {
        foto_ktp: null,
        foto_kk: null,
        foto_profil: null,
      },
      dataCookies:null,
      loadingData:null,
    };
  },
  computed: {
    ...mapGetters({
      getadminDataControl: "adminrw/getadminDataControl",
      getDataUser: "user/getDataUser",
      getAllDataAlamatByIdAlamat: "admindata/getAllDataAlamatByIdAlamat",
      getAllDataDetailAlamatByIdAlamat: "admindata/getAllDataDetailAlamatByIdAlamat",
      getAdminDataRoles: "adminrw/getAdminDataRoles",
    }),
  },
  methods: {
    required(v) {
      return !!v || "Input tidak boleh kosong";
    },
    async caridata() {
      await this.$store.dispatch("adminrw/fetchDataAdminControl", this.cari);
    },
    debouncingcari() {
      clearInterval(this.debounceInterval);
      this.debounceInterval = setInterval(() => {
        this.caridata();
        clearInterval(this.debounceInterval);
      }, this.debounceDelay);
    },
    tambah() {
      this.inputTambah = Object.assign({}, null)
      this.inputFileTambah = Object.assign({}, null)
      this.dialogtambah = true;
    },
    async inputalamat(id){
      console.log('idcoyyy',id);
      await this.$store.dispatch(
        "admindata/fetchDataDetailAlamatByRt", id);

    },
  async  konfirmtambah() {
      await this.$store.dispatch("adminrw/tambahDataAdmin", {
        data: this.inputTambah,
        detail_alamat: this.data_alamat_by_rt,
      });
      await this.$store.dispatch("adminrw/fetchDataAdminControl", this.cari);
      this.dialogtambah = false;
    },
    closetambah() {
      this.dialogtambah = false;
      this.inputTambah = Object.assign({}, null)
      this.data_alamat_by_rt = Object.assign({}, null)
    },
    hapus(item) {
      this.dialoghapus = true;
      this.userId = item.user_id;
    },
    closehapus(){
      this.dialoghapus=false
    },
    konfirmasihapus() {
      this.dialoghapus = false;
      console.log(this.userId);
      this.$store.dispatch("adminrw/deleteDataAdminControl", this.userId);
    },
    ubahPass(item) {
      console.log(item);
      this.adminDataDialog.user_id = item?.user_data.user_id;
      this.dialogubahPass = true;
    },
    closeUbahPass() {
      this.adminDataDialog.user_id = null;
      this.adminDataDialog.new_password = null;
      this.adminDataDialog.confirm_password = null;
      this.dialogubahPass = false;
    },
    tes() {
      console.log(this.adminDataDialog);
    },
    konfirmubah() {
      this.$store.dispatch(
        "adminrw/changeUserPassword",
        this.adminDataDialog
      );
      this.adminDataDialog.user_id = null;
      this.adminDataDialog.new_password = null;
      this.adminDataDialog.confirm_password = null;

      this.dialogubahPass = false;
    },
  },
  async created() {
    await this.$store.dispatch("adminrw/fetchADminRolesData");
    await this.$store.dispatch("adminrw/fetchDataAdminControl", this.cari);
    await this.$store.dispatch(
      "admindata/fetchDataAlamatByRt"
    );
    this.dataCookies=this.$cookies.get("dataUser").data?.role
      this.loadingData=false
  },
};
