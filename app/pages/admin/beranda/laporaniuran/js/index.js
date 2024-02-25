import {mapGetters} from 'vuex'
export default{
  layout: "AdminSideBar",
  middleware:['guestmiddleware', 'rolecheckmiddleware'],
  data() {
    return {
      loadingData:true,
      header:[
        {text:'Jenis Iuran', value:'jenis_iuran.nama'},
        {text:'Deskripsi ', value:'jenis_iuran.deskripsi'},
        {text:'Jumlah', value:'jenis_iuran.jumlah'},
      ],
      loadingData:true,
    }
  },
  computed:{
    ...mapGetters({
      getAllDataPemasukan:'admindata/getAllDataPemasukan',
      getSumDataPemasukan:'admindata/getSumDataPemasukan'
    })
  },
  methods: {
    required(v) {
      return !!v || "Input tidak boleh kosong";
    },
  },
  async created() {
 await this.$store.dispatch('admindata/fetchDataPembayaranIuran', this.$cookies.get("dataUser").data?.role)
 await this.$store.dispatch('admindata/fetchDataSumPembayaranIuran', this.$cookies.get("dataUser").data?.role)

 this.loadingData=false

  },
}
