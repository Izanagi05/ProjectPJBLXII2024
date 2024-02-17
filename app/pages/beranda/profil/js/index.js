import { mapGetters, mapActions } from "vuex";
export default {
  layout: "UserSideBar",
  data() {
    return {
      editdialog: false,
      date: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10),
        hubunganOptions: ['Kepala Keluarga', 'Istri', 'Anak', 'Lainnya'],
        jenisKelaminOptions: ['Laki-laki', 'Perempuan'],
        statusPerkawinanOptions: ['Belum Menikah', 'Menikah', 'Duda', 'Janda', 'Lainnya'],
        statusBerktpOptions: ['Sudah', 'Belum'],
        checktmptlahir:false,
        inputEdit: {
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
          status_berktp: 'Belum',
          status_perkawinan: 'Belum Menikah',
          agama_id: null,
        },
        detail_alamat:null,
      menu: false,
      modal: false,
    };
  },
  computed:{
    detailalamatt(){
      this.getDataUser?.detail_alamats.map(detailAlamat => {
        return {
          nama_alamat: detailAlamat.nama,
          nama_blok: detailAlamat.alamat.nama
        };
      });
    },
    ...mapGetters({
      getDataAgama:'user/getDataAgama',
      getDataProvinsi:'user/getDataProvinsi',
      getDataUser:'user/getDataUser'
    })
  },
  methods: {
    editprofil() {
      this.editdialog = true;
    },
    konfirmprofil() {
      this.editdialog = false;
    },
    closeprofil() {
      this.editdialog = false;
    },
    required(v) {
      return !!v || "Input tidak boleh kosong";
    },
  },
async created() {

  this.detail_alamat =this.getDataUser?.detail_alamats.map(detailAlamat => {
    return {
      nama_alamat: detailAlamat.nama,
      nama_blok: detailAlamat.alamat.nama
    };
  });

    await this.$store.dispatch('user/fetchDataAgama')
    await this.$store.dispatch('user/fetchDataProvinsi')

  },
};
