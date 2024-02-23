export default{
  GET_DATA_ALL_USER_TAGIHAN(state, data){
    state.dataIplUser=data
  },
  GET_DATA_ALL_JUMLAH(state, data){
    state.jumlahDataInBeranda=data
  },
  GET_DATA_ALL_USER_BY_RT(state, data){
    state.allUsersByRt=data
  },
  GET_DATA_DETAIL_ALAMAT_BY_ADMIN(state, data){
    state.allDataDetailAlamatByIdAlamat=data
  },
  GET_DATA_ALAMAT_BY_ADMIN(state, data){
    state.allDataAlamatByIdAlamat=data
  },

}
