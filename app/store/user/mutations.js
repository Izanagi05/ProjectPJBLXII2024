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
    });
  },
  TAMBAH_DATA_LAPORAN(state, data){
   state.dataAllLaporan?.user_laporans.push(data)
  },
  UPDATE_DATA_LAPORAN(state, data){
    const index = state.dataAllLaporan?.user_laporans.findIndex(item => item.laporan_id === data.laporan_id);
    console.log(index);
    if (index !== -1) {
      const dataCopy= state.dataAllLaporan
      dataCopy.user_laporans[index]= data
      // console.log(  dataCopy.user_laporans[index]);
      // state.dataAllLaporan=[...dataCopy]
      state.dataAllLaporan = { ...state.dataAllLaporan, user_laporans: dataCopy };

    }
  },
  GET_DATA_ALL_LAPORAN(state, data){
   state.dataAllLaporan=data
  },
  DELETE_DATA_LAPORAN(state, data){
  //  state.dataAllLaporan=data
   const index = state.dataAllLaporan?.user_laporans.findIndex(item => item.laporan_id === data);
   console.log('ppp',index);
   if (index !== -1) {
     state.dataAllLaporan?.user_laporans.splice(index, 1);
   }

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
