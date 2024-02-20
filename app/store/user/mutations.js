export default{
  GET_DATA_AGAMA(state, data){
    state.dataAgama=data
  },
  GET_DATA_USER_LOGIN(state, data){
    state.dataUserLogin=data
  },
  GET_DATA_ALL_WARGA_ALAMAT(state, data){
    state.dataAllWargaAlamat=data
  },
  UPDATE_DATA_WARGA_ALAMAT(state, data){
    state.dataAllWargaAlamat?.detail_alamats.forEach((element, index) => {
      const itemIndex = element.wargas.findIndex(item => item?.user_id === data?.user_id);
      if (itemIndex !== -1) {
        // Hapus item dari array di dalam loop forEach
        const itemCopy = state.dataAllWargaAlamat;
        console.log('omagani', itemCopy.detail_alamats[index]?.wargas[itemIndex]);
        itemCopy.detail_alamats[index].wargas[itemIndex] = data;
        state.dataAllWargaAlamat = {
          ...state.dataAllWargaAlamat,
          detail_alamats: state.dataAllWargaAlamat.detail_alamats.map((detailAlamat, idx) => {
            if (idx === index) {
              return {
                ...detailAlamat,
                wargas: [...detailAlamat.wargas] // Salin array wargas
              };
            }
            return detailAlamat;
          })
        };
      }
    })
  },
  TAMBAH_DATA_WARGA_ALAMAT(state, data){
    state.dataAllWargaAlamat?.detail_alamats.forEach((element, index) => {
      state.dataAllWargaAlamat.detail_alamats[index].wargas.push(data);
      if (itemIndex !== -1) {
      }
    });
  },
  DELETE_DATA_BY_ID_WARGA_ALAMAT(state, data){
    state.dataAllWargaAlamat?.detail_alamats.forEach((element, index) => {
      const itemIndex = element.wargas.findIndex(item => item?.user_id === data);
      if (itemIndex !== -1) {
        // Hapus item dari array di dalam loop forEach
        state.dataAllWargaAlamat?.detail_alamats[index].wargas.splice(itemIndex, 1);
      }
    });
  },
  UPDATE_DATA_USER_LOGIN(state, data){
    state.dataUserLogin=data
  },
  GET_DATA_PROVINSI(state, data){
    state.dataProvinsi=data
  }
}
