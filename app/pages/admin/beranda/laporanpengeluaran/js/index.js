import { mapGetters } from "vuex";
import dialoghapusUser from "~/components/dialoghapusUser.vue";
export default {
  layout: "AdminSideBar",
  middleware: ["guestmiddleware", "rolecheckmiddleware"],
  components:{
    dialoghapusUser
  },
  data() {
    return {
      dialogTambah: false,
      dialogEdit: false,
      dialogHapus: false,
      inputTambah: {
        nama_pengeluaran: null,
        deskripsi: null,
        jumlah: null,
      },
      inputEdit: {
        nama_pengeluaran: null,
        deskripsi: null,
        jumlah: null,
      },
      header:[
        {text:'Nama', value:'nama_pengeluaran'},
        {text:'Deskripsi', value:'deskripsi'},
        {text:'Terbilang', value:'jumlah'},
        {text:'Aksi', value:'aksi'},
      ],
      dataPengeluaranId: null,
      loadingData:true,
      dataCookies:true,

    };
  },
  computed: {
    ...mapGetters({
      getAllDataPengeluarans:'admindata/getAllDataPengeluarans',
      getSumDataPengeluarans:'admindata/getSumDataPengeluarans'
    })
  },
  methods: {
     tambahPengeluaran() {
       this.inputTambah = Object.assign({}, null);
      this.dialogTambah = true;
    },
    closeTambahPengeluaran() {
      this.dialogTambah = false;
      this.inputTambah = Object.assign({}, null);
    },
    async konfirmTambahPengeluaran() {
      this.dialogTambah = false;
      await  this.$store.dispatch(
        "admindata/tambahDataPengeluaranRt",
        this.inputTambah
        );
        await this.$store.dispatch('admindata/fetchDataPengeluaranIuran', this.$cookies.get("dataUser").data?.role)
        await this.$store.dispatch('admindata/fetchDataSumPengeluaranIuran', this.$cookies.get("dataUser").data?.role)

        console.log('p');
      this.inputTambah = Object.assign({}, null);
    },
    editPengeluaran(item) {
      this.inputEdit = Object.assign({}, item);
      this.dialogEdit = true;

    },
    closeEditPengeluaran() {
      this.dialogEdit = false;
      this.inputEdit = Object.assign({}, null);
    },
   async konfirmEditPengeluaran() {
     this.dialogEdit = false;
    await  this.$store.dispatch(
      "admindata/updateDataPengeluaranRt",
      this.inputEdit
    );
    await this.$store.dispatch('admindata/fetchDataPengeluaranIuran', this.$cookies.get("dataUser").data?.role)
    await this.$store.dispatch('admindata/fetchDataPengeluaranIuran', this.$cookies.get("dataUser").data?.role)
    await this.$store.dispatch('admindata/fetchDataSumPengeluaranIuran', this.$cookies.get("dataUser").data?.role)

    this.inputEdit = Object.assign({}, null);
   },
    hapusPengeluaran(item) {
      this.dialogHapus = true;
     this.dataPengeluaranId=item
    },
    closeHapusPengeluaran() {
      this.dialogHapus = true;

    },
  async konfirmHapusPengeluaran() {
    this.dialogHapus = false;
    await  this.$store.dispatch(
      "admindata/deleteDataPengeluaranRt",
      this.dataPengeluaranId
      );
      await this.$store.dispatch('admindata/fetchDataPengeluaranIuran', this.$cookies.get("dataUser").data?.role)
      await this.$store.dispatch('admindata/fetchDataSumPengeluaranIuran', this.$cookies.get("dataUser").data?.role)

    },
    required(v) {
      return !!v || "Input tidak boleh kosong";
    },
  },
  async created() {
    this.dataCookies= this.$cookies.get("dataUser").data?.role
    const role=this.$cookies.get("dataUser").data?.role
   await this.$store.dispatch('admindata/fetchDataPengeluaranIuran', role)
   await this.$store.dispatch('admindata/fetchDataSumPengeluaranIuran', this.$cookies.get("dataUser").data?.role)
    this.loadingData=false
  },
};
