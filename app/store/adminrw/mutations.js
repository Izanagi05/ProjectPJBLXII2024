export default {
  GET_TATIB_DATA(state, data) {
    state.AllTatib = data;
  },
  GET_ADMIN_DATA_GROUP(state, data) {
    state.adminAllGroup = data;
  },
  GET_BOT_QR_CODE(state, data) {
    state.dataQRcODE = data;
  },
  GET_ALL_DATA_ALAMAT(state, data) {
    state.dataAllAlamat = data;
  },
  GET_ALL_DATA_DETAIL_ALAMAT(state, data) {
    state.dataAllDetailAlamat = data;
  },
  GET_RW_DATA(state, data) {
    state.dataRw = data;
  },
  GET_ADMIN_DATA_CONTROL(state, data) {
    state.adminDataControl = data;
  },
  DELETE_ADMIN_DATA_CONTROL(state, data) {
    const index = state.adminDataControl.findIndex(
      (item) => item.user_id === data.user_id
    );

    if (index !== -1) {
      state.adminDataControl.splice(index, 1);
    }
  },
  GET_CATEGORY_DETAIL_CONTROL(state, data) {
    state.dataDetailCategory = data;
  },
  GET_DATA_ALL_RT(state, data) {
    state.dataAllRt = data;
  },
  UPDATE_CATEGORY_DETAIL_CONTROL (state, data) {
    const index =state.dataDetailCategory.findIndex(item=> parseInt(item.category_detail_id) === parseInt(data.category_detail_id))

    if(index !== -1){
      const datasementara= state.dataDetailCategory

      datasementara[index] = data
      state.dataDetailCategory=[...datasementara]
      // state.laporanData
    }

  },
  GET_ADMIN_DATA_ROLES(state,data){
    state.adminDataRoles=data
  },
  DATA_ALL_YEARS(state,data){
    state.dataAllYears=data
  },
  DATA_ALL_JENIS_IURAN(state,data){
    state.dataAllJenisIurans=data
  },
  DATA_ALL_BULAN(state,data){
    state.dataAllBulan=data
  },
};
