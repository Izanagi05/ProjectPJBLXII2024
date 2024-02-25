export default {
  GET_ADMIN_DATA_CONTROL(state, data) {
    state.adminDataControl = data;
  },
  DELETE_ADMIN_DATA_CONTROL(state, data) {
    const index = state.adminDataControl.findIndex(
      (item) => item.user_id === data.user_id
    );

    if (index !== -1) {
      // Hapus item dari array
      state.adminDataControl.splice(index, 1);
    }
  },
  GET_CATEGORY_DETAIL_CONTROL(state, data) {
    state.dataDetailCategory = data;
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
};
