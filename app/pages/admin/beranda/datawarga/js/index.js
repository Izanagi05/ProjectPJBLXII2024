import dialogInputUser from "~/components/dialogInputUser.vue";
import dialogInputtambahUser from "~/components/dialogInputtambahUser.vue";
import dialoghapusUser from "~/components/dialoghapusUser.vue";
import { mapGetters } from "vuex";
export default {
  layout: "AdminSideBar",
  middleware: ["guestmiddleware", "rolecheckmiddleware"],
  components: {
    dialogInputUser,
    dialogInputtambahUser,
    dialoghapusUser
  },
  data() {
    return {
      dialogtambah: false,
      editdialog: false,
      hapusdialog: false,
      modal: false,
      datePickerFormat: "YYYY-MM-DD",
      header: [
        { text: "Nama", value: "nama" },
        { text: "nik", value: "nik" },
        { text: "no_kk", value: "no_kk" },
        { text: "Foto KTP", value: "foto_ktp" },
        { text: "Foto KK", value: "foto_kk" },
        { text: "Status Berktp", value: "status_berktp" },
        { text: "Aksi", value: "aksi" },
      ],
      hubunganOptions: [
        { text: "Kepala Keluarga", value: "Kepala Keluarga" },
        { text: "Istri", value: "Istri" },
        { text: "Anak", value: "Anak" },
        { text: "Lainnya", value: "Lainnya" },
      ],
      statusBerKtpOptions: [
        { text: "Sudah", value: "Sudah" },
        { text: "Belum", value: "Belum" },
      ],
      jenisKelaminOptions: [
        { text: "Laki-laki", value: "Laki-laki" },
        { text: "Perempuan", value: "Perempuan" },
      ],
      statusPerkawinanOptions: [
        { text: "Belum Menikah", value: "Belum Menikah" },
        { text: "Menikah", value: "Menikah" },
        { text: "Duda", value: "duda" },
        { text: "Janda", value: "Janda" },
        { text: "Lainnya", value: "Lainnya" },
      ],
      activePicker: null,
      date: null,
      menu: false,
      checktmptlahir: false,
      inputFileEdit: {
        foto_ktp: null,
        foto_kk: null,
        foto_profil: null,
      },
      inputEdit: {
        user_id: null,
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
      },
      inputFileTambah: {
        foto_ktp: null,
        foto_kk: null,
        foto_profil: null,
      },
      inputTambah: {
        user_id: null,
        nama: null,
        jenis_kelamin: null,
        nik: "3333",
        no_kk: "333",
        foto_ktp: null,
        foto_kk: null,
        provinsi_lahir_id: null,
        tempat_lahir_lainnya: null,
        tgl_lahir: null,
        no_telp: "081290991181",
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
      detail_alamat: null,
      inputData: [],
      idwarga: [],
      loadingData: true,
      headers: [
        { text: "Nama", value: "nama" },
        { text: "NIK", value: "nik" },
        { text: "No KK", value: "no_kk" },
        { text: "No Telepon", value: "no_telp" },
        { text: "Foto KTP", value: "fotoktp" },
        { text: "Foto KK", value: "fotokk" },
        { text: "Sebagai", value: "hubungan" },
        { text: "Tanggal lahir", value: "tgl_lahir" },
        { text: "Aksi", value: "aksi" },
      ],
      selectRules: [(value) => !!value || "Input tidak boleh kosong"],
    };
  },
  computed: {
    ...mapGetters({
      getDataAgama: "user/getDataAgama",
      getDataProvinsi: "user/getDataProvinsi",
      getDataUser: "user/getDataUser",
      getAllUserById: "admindata/getAllUserById",
    }),
  },
  watch: {
    '$store.state.user.dataAllWargaAlamat': {
      handler(newData, oldData) {
        console.log('Data di state getDataAllWargaAlamat telah berubah:', newData);
        this.dataTabel = newData; // Misalkan dataTabel adalah data yang digunakan dalam tabel
      },
      deep: true // Jika perlu memantau perubahan dalam objek atau array secara mendalam
    }
  },
  methods: {
    tambah() {
      this.inputTambah = Object.assign({}, null)
      this.inputFileTambah = Object.assign({}, null)
      this.dialogtambah = true;
    },
  async  konfirmtambah() {
      await this.$store.dispatch("admindata/tambahDataWargabyAdmin", {
        data: this.inputTambah,
        fotobaru: this.inputFileTambah,
      });
      this.$store.dispatch("admindata/fetchAllUserRt");
      this.dialogtambah = false;
    },
    closetambah() {
      this.dialogtambah = false;
      this.inputTambah = Object.assign({}, null)
      this.inputFileTambah = Object.assign({}, null)
    },
    async editwarga(item) {
      this.inputEdit = Object.assign({}, item);
      this.editdialog = true;
    },
    async konfirmedit() {
      this.editdialog = false;
    },
    async closeedit() {
      this.editdialog = false;
      this.inputFileEdit=Object.assign({}, null)
    },
    async konfrimdataedit() {
      await this.$store.dispatch("user/updateDataWargabyAlamat", {
        data: this.inputEdit,
        fotobaru: this.inputFileEdit,
      });
      this.editdialog = false;
      this.inputFileEdit=Object.assign({}, null)
    },
    async hapuswarga(item){
      this.idwarga = Object.assign({}, item);
      this.hapusdialog = true;
    },
    async closehapus() {
      this.hapusdialog = false;
      this.idwarga = Object.assign({}, null);
    },
     konfrimdelete() {
       this.$store.dispatch("user/deleteDataUserbyid", this.idwarga?.user_id);
      //  this.$store.dispatch("user/fetchallwargabyalamat");
      this.hapusdialog = false;
    },
    required(v) {
      return !!v || "Input tidak boleh kosong";
    },
  },
  async created() {

    await this.$store.dispatch("user/fetchDataAgama");
    await this.$store.dispatch("user/fetchDataProvinsi");
   await this.$store.dispatch("admindata/fetchAllUserRt");
   await this.$store.dispatch(
    "admindata/fetchDataAlamatByRt"
  );
  await this.$store.dispatch(
    "admindata/fetchDataDetailAlamatByRt", this.data_alamat_by_rt.alamat_id??1
  );
    this.loadingData=false
  },
};
