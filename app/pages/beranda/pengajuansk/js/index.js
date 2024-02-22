import { mapGetters } from "vuex";
import dialoghapusUser from "~/components/dialoghapusUser.vue";
export default{
  middleware:['guestmiddleware','adminrolemiddleware'],

  components: {
    dialoghapusUser
  },
  layout: "UserSideBar",
  data() {
    return {

      selectedGender: null,
      genderOptions: ['Laki-laki', 'Perempuan'],
      selectedReligion: null,
      religionOptions: ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'],
      selectedOccupation: null,
      occupationOptions: [
        'Mahasiswa',
        'Pegawai Kantoran',
        'Wiraswasta',
        'Guru',
        'Dokter',
        'Polisi',
        'Petani',
        'Nelayan',
        'Buruh',
        'Penyiar',
        'Artis',
        'Atlet'
      ],
      selectRules: [
        value => !!value || 'Input tidak boleh kosong'
      ],
      detail_alamat_pilihan:[],
      dialogTambah:false,
      dialogHapus:false,
      dialogEdit:false,
      dialoglaporan:false,
      loadingData:true,
      inputLaporan:{
        user_id:null,
        keperluan:null,
        detail_alamat_id_and_alamat_id:[]
      },
      inputEditLaporan:{
        user_id:null,
        keperluan:null,
        detail_alamat_id_and_alamat_id:[]
      },
      headers: [
        { text: "Keperluan", value: "keperluan" },
        { text: "Aksi", value: "aksi" },
      ],
      dataLaporan_id:null,
      dataLaporanexport:{
        laporan_id:null,
        user_id:null,
        keperluan:null,
        detail_alamat_id_and_alamat_id:[]
      }

    }
  },
  computed:{
...mapGetters({
  getDataAllLaporan: "user/getDataAllLaporan",
  getDataUser: "user/getDataUser",
})
  },
  methods: {
    required(v) {
      return !!v || "Input tidak boleh kosong";
    },
    async tambahlaporan(){

      this.inputLaporan = Object.assign({}, null)
      this.dialogTambah = true;
    },
    async closetambah(){
      this.dialogTambah = false;
      this.inputLaporan = Object.assign({}, null)
    },
    async konfirmpengajuan(){
      await this.$store.dispatch("user/tambahDataLaporan", {
        data: this.inputLaporan,
      });
      this.dialogTambah = false;
      this.inputLaporan = Object.assign({}, null)
    },
   async closelaporanexport(){
     this.dataLaporanexport=Object.assign({}, null)
     this.dialoglaporan=false
    },
   async exportlaporan(item){
    this.dataLaporanexport=Object.assign({}, item)
    // console.log();
     this.dialoglaporan=true
    },
   async konfirmexportlaporan(){
    await this.$store.dispatch("user/exportDataLaporan", this.dataLaporanexport);
     this.dialoglaporan=false
    },
    async hapuslaporan(item){
      this.dataLaporan_id=item?.laporan_id
      this.dialogHapus = true;
    },
    async closehapus(){
      this.dialogHapus = false;
    },
    async konfirmhapuspengajuan(){
      // console.log('simpan');
      await this.$store.dispatch("user/deleteLaporanUser", this.dataLaporan_id);
      this.dialogHapus = false;

    },
  },
  async created() {
    this.loadingData=true
    await this.$store.dispatch("user/fetchUserLogin");
    await this.$store.dispatch("user/fetchAllLaporanUser");
    this.inputLaporan.user_id= this.getDataUser?.user_id
    this.detail_alamat_pilihan =this.getDataUser?.detail_alamats.map(
      (detailAlamat, i) => {
        return {
          alamat_id: detailAlamat?.alamat?.alamat_id,
          nama_alamat: detailAlamat.nama,
          nama_blok: detailAlamat?.alamat.nama,
          detail_alamat_id: detailAlamat.detail_alamat_id,
          concetdatalamat: detailAlamat.nama + ", " + detailAlamat?.alamat.nama,
          detail_alamat_id_and_alamat_id: [
            detailAlamat.detail_alamat_id,
            detailAlamat?.alamat?.alamat_id,
          ],
        };
      }
      );
      this.loadingData=false
    console.log('ui',this.detail_alamat_pilihan);
  },
}
