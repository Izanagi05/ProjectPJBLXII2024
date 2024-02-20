import NavbarBeranda from'~/components/NavbarBeranda.vue'
import BottomNavigation from '~/components/BottomNavigation.vue'
export default{
  components:{
    NavbarBeranda,
    BottomNavigation
  },
data() {
  return {

  }
},
async created() {
  await this.$store.dispatch('user/fetchUserLogin')
  await this.$store.dispatch('user/fetchallwargabyalamat')
},
}
