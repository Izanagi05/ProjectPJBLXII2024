export default {
  async fetchDataAllTagihanUserbyTahun({ commit }, data) {
    let remember_token = this.$cookies.get("dataUser")?.data.token;
    await this.$axios
      .get("/getAllTagihanUserbyTahun/" + data ?? "", {
        headers: {
          Authorization: "Bearer " + this.$cookies.get("dataUser").data?.token,
        },
      })
      .then((response) => {
        commit("GET_DATA_ALL_USER_TAGIHAN", response.data?.data);
      });
  },
  async fetchjumlahWargaAndTransaksiAndLaporan({ commit }, data) {
    let remember_token = this.$cookies.get("dataUser")?.data.token;
    await this.$axios
      .get("/jumlahWargaAndTransaksiAndLaporan", {
        headers: {
          Authorization: "Bearer " + this.$cookies.get("dataUser").data?.token,
        },
      })
      .then((response) => {
        commit("GET_DATA_ALL_JUMLAH", response.data?.data);
      });
  },
  async postTransaksiPembayaranIuran({ commit }, data) {
    let remember_token = this.$cookies.get("dataUser")?.data.token;
    const formData = new FormData();
    formData.append("tagihan_bulanan_id", data.tagihan_bulanan_id);
    formData.append("user_id", data.user_id);
    // formData.append("tanggal_pembayaran", data.tanggal_pembayaran);
    formData.append("jumlah_pembayaran", data.jumlah_pembayaran);
    await this.$axios
      .post("/TransaksiPembayaranIuran", data, {
        headers: {
          Authorization: "Bearer " + this.$cookies.get("dataUser").data?.token,
        },
      })
      .then((response) => {
        this.fetchDataAllTagihanUserbyTahun
      });
  },
};
