export default{
layout:'UserSideBar',
middleware:['guestmiddleware','adminrolemiddleware'],
data() {
  return {
    dialogevent:true,
    event:{
      tanggal:'2 Agustus 2022'
    }
  }
},
  methods: {
    detailevent(){
      this.dialogevent=true
    },
    closedetailevent(){
      this.dialogevent=false
    }
  },
}
