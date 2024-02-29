import { mapGetters } from "vuex";
import dialoghapusUser from "~/components/dialoghapusUser.vue";
export default {
  layout: "AdminSideBar",
  middleware: ["guestmiddleware", "rolecheckmiddleware", "adminrwmiddleware"],
  components: {
    dialoghapusUser,
  },
  data() {
    return {
      dataIzin:[
        {key:'Berizin',value:'Berizin'},
        {key:'Belum Berizin', value:'Belum Berizin'},
        {},
      ],
      header: [
        { text: "Nama Grup", value: "group_nama" },
        { text: "Status Izin", value: "izin" },
        { text: "Rt", value: "r_t.rt" },
        { text: "Aksi", value: "aksi" },
      ],
      inputEdit:{
        rt_id:null,
        izin:null,
      },
      inputKirimPesanGroup:{
        to:null,
        message:null,
      },
      dialogDelete:false,
      inputDelete:[],
      dialogKirimPesanGroup:false,
      dialogEditGroup:false,
      loadingData:true,
    };
  },
  computed: {
    ...mapGetters({
      getadminAllGroup: "adminrw/getadminAllGroup",
      getdataAllRt: "adminrw/getdataAllRt",
    }),
  },
  methods: {
    closeEdit(){
      this.dialogEditGroup=false
      this.inputEdit=Object.assign({},null)
    },
    editGroup(item){
      this.dialogEditGroup=true
      this.inputEdit=Object.assign({},item)

    },
    async konfirmEdit(){
     this.dialogEditGroup=false

      await this.$store.dispatch('adminrw/updateIzinGroupData', this.inputEdit)
      await this.$store.dispatch('adminrw/getAllGroupData')
    },
    closeEdit(){
      this.dialogEditGroup=false
      this.inputEdit=Object.assign({},null)
    },
    closeKirimPesanGroup(){
      this.dialogKirimPesanGroup=false
      this.inputKirimPesanGroup=Object.assign({},null)
    },
    kirimPesanGroup(item){
      this.dialogKirimPesanGroup=true
      this.inputKirimPesanGroup=Object.assign({},item)

    },
    async konfirmKirimPesanGroup(){
     this.dialogKirimPesanGroup=false

      await this.$store.dispatch('adminrw/postMessageCustomToGroup', this.inputKirimPesanGroup)
    },
    closeEdit(){
      this.dialogEditGroup=false
      this.inputEdit=Object.assign({},null)
    },
    closeDelete(){
      this.dialogDelete=false
      this.inputDelete=Object.assign({},null)
    },
    deleteGroup(item){
      this.dialogDelete=true
      this.inputDelete=Object.assign({},item)

    },
    async konfirmDelete(){
      this.dialogDelete=false
      await this.$store.dispatch('adminrw/deleteGroupData', this.inputDelete)
      await this.$store.dispatch('adminrw/getAllGroupData')
    },
    closeEdit(){
      this.dialogEditGroup=false
      this.inputEdit=Object.assign({},null)
    },
    required(v) {
      return !!v || "Input tidak boleh kosong";
    },
  },
  async created() {
    await this.$store.dispatch('adminrw/getAllGroupData')
    await this.$store.dispatch("adminrw/fetchDataAllRT");
    this.loadingData = false;
  },
};
