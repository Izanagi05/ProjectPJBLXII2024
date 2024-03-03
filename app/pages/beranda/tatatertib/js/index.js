import {mapGetters} from 'vuex'
export default{
  layout: "UserSideBar",
  middleware:['guestmiddleware','adminrolemiddleware'],
  data() {
    return {
    }
  },
  computed:{
    ...mapGetters({
      getAllTatib:'adminrw/getAllTatib'
    })
  },
  async created() {
    this.$store.dispatch('adminrw/getTataTertib')
  },
}
