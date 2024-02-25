export default{
  getDataAllUserTagihan (state) {
    return state.dataIplUser
  },
  getjumlahWargaAndTransaksiAndLaporan (state) {
    return state.jumlahDataInBeranda
  },
  getAllUserById (state) {
    return state.allUsersByRt
  },
  getAllDataAlamatByIdAlamat (state) {
    return state.allDataAlamatByIdAlamat
  },
  getAllDataDetailAlamatByIdAlamat (state) {
    return state.allDataDetailAlamatByIdAlamat
  },
  getSumDataPemasukan (state) {
    return state.allSumPemasukan
  },
  getAllDataPemasukan (state) {
    return state.allPemasukan
  },
  getSumDataPengeluarans (state) {
    return state.allSumPengeluarans
  },
  getAllDataPengeluarans (state) {
    return state.allPengeluarans
  },

}
