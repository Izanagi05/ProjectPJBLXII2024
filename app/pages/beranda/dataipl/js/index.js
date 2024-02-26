import {mapGetters} from 'vuex'
export default{
  layout: "UserSideBar",
  middleware:['guestmiddleware','adminrolemiddleware'],
  data() {
    return {
      header:[
        {text:'Bulan', value:'bulan.nama'},
        {text:'Jenis Iuran', value:'jenis_iuran.nama'},
        {text:'Terbilang', value:'jenis_iuran.jumlah'},
        {text:'Status Pembayaran', value:'status_pembayaran'},
      ]
    }
  },
  computed: {
    ...mapGetters({
      getuserLoginIPL:'user/getuserLoginIPL'
    })
  },
  async created() {
    await this.$store.dispatch('user/getUserLoginbyTahun')
  },
}
