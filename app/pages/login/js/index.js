import {mapGetters} from 'vuex'
export default{
  data() {
    return {
      loading: false,
      lihat:false,
      debounceInterval: null,
      debounceDelay: 10000,
      datalogin:{
        email:'test0@gmail.com',
        password:'password',
      }
    }
  },

  methods: {
   async waitLogin(){
      console.log('tunggu');
    },
   async login() {

      this.loading = true;
      await this.$store.dispatch("user/LoginUser", this.datalogin);
      setTimeout(() => (this.loading = false), 2000);
    },
    required(v) {
      return !!v || "Input tidak boleh kosong";
    },
  },
}
