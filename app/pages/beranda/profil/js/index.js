import { mapGetters, mapActions } from "vuex";

import dialogInputUser from "~/components/dialogInputUser.vue";
export default {
  layout: "UserSideBar",
  components: {
    dialogInputUser,
  },
  data() {
    return {
      editdialog: false,
      modal: false,
      datePickerFormat: "YYYY-MM-DD",
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
      inputFileEdit:{
        foto_ktp: null,
        foto_kk: null,
        foto_profil: null,
      },
      inputEdit: {
        nama: null,
        jenis_kelamin: null,
        nik: null,
        no_kk: null,
        foto_ktp: null,
        foto_kk: null,
        provinsi_lahir_id: null,
        tempat_lahir_lainnya: null,
        tgl_lahir:null,
        no_telp: null,
        pekerjaan: null,
        hubungan: null,
        status_berktp: null,
        status_perkawinan: null,
        agama_id: null,
      },
      detail_alamat: null,
      loadingData:true
    };
  },
  computed: {
    detailalamatt() {
      this.getDataUser?.detail_alamats.map((detailAlamat) => {
        return {
          nama_alamat: detailAlamat.nama,
          nama_blok: detailAlamat.alamat.nama,
        };
      });
    },
    ...mapGetters({
      getDataAgama: "user/getDataAgama",
      getDataProvinsi: "user/getDataProvinsi",
      getDataUser: "user/getDataUser",
    }),
  },
  watch: {
    menu (val) {
      val && setTimeout(() => (this.activePicker = 'YEAR'))
    },
  },
  methods: {
    parseDate (date) {
      if (!date) return null

      const [month, day, year] = date.split('/')
      return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
    },
    save(date) {
      this.$refs.menu.save(date);
      // this.inputEdit.tgl_lahir = date.toISOString().substring(0, 10);
    },
    editprofil() {
      this.editdialog = true;
      this.inputEdit=  Object.assign({}, this.getDataUser);
    },
    async konfirmprofil() {

      await this.$store.dispatch("user/updateDataUserLogin", { data: this.inputEdit, fotobaru: this.inputFileEdit });
      this.editdialog = false;
      this.inputFileEdit = Object.assign({}, null)
    },
    closeprofil() {
      this.editdialog = false;
      this.inputFileEdit = Object.assign({}, null)
    },
    required(v) {
      return !!v || "Input tidak boleh kosong";
    },
  },
  async created() {
    this.detail_alamat = this.getDataUser?.detail_alamats.map(
      (detailAlamat) => {
        return {
          nama_alamat: detailAlamat.nama,
          nama_blok: detailAlamat.alamat.nama,
        };
      }
    );

    await this.$store.dispatch("user/fetchDataAgama");
    await this.$store.dispatch("user/fetchDataProvinsi");
    this.loadingData =false
  },
};
