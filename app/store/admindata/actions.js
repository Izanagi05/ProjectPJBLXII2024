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
  async fetchAllUserRt({ commit }, data) {
    await this.$axios
      .get("/getAllUserRt", {
        headers: {
          Authorization: "Bearer " + this.$cookies.get("dataUser").data?.token,
        },
      })
      .then((response) => {
        commit("GET_DATA_ALL_USER_BY_RT", response.data?.data);
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
  async tambahDataWargabyAdmin({ commit }, payload) {
    try {
      const { data, fotobaru, detail_alamat } = payload;
      const formData = new FormData();
      // formData.append("user_id", data.user_id);
      formData.append("nama", data.nama);
      formData.append("jenis_kelamin", data.jenis_kelamin);
      formData.append("nik", data.nik);
      formData.append("no_kk", data.no_kk);
      formData.append("foto_profil", fotobaru.foto_profil ?? data.foto_profil);
      formData.append("foto_ktp", fotobaru.foto_ktp ?? data.foto_ktp);
      formData.append("foto_kk", fotobaru.foto_kk ?? data.foto_kk);
      formData.append("provinsi_lahir_id", data.provinsi_lahir_id);
      formData.append("tempat_lahir_lainnya", data.tempat_lahir_lainnya);
      formData.append("tgl_lahir", data.tgl_lahir);
      formData.append("no_telp", data.no_telp);
      formData.append("pekerjaan", data.pekerjaan);
      formData.append("hubungan", data.hubungan);
      formData.append("status_berktp", data.status_berktp);
      formData.append("status_perkawinan", data.status_perkawinan);
      formData.append("agama_id", data.agama_id);
      formData.append("status", data.status);
      formData.append("alamat_id", data.detail_alamat_id_and_alamat_id[1]);
      formData.append(
        "detail_alamat_id",
        data.detail_alamat_id_and_alamat_id[0]
      );

      await this.$axios
        .post("/storeUser", formData, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          // this.fetchallwargabyalamat;

          commit("TAMBAH_DATA_WARGA_ALAMAT", response.data?.data);
          console.log(response.data?.data);
          // return response.data?.data
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async fetchDataDetailAlamatByRt({ commit }, data) {
    try {
      await this.$axios
        .get(
          "/getDataDetailAlamatByRt/"+data,
          {
            headers: {
              Authorization:
                "Bearer " + this.$cookies.get("dataUser").data?.token,
            },
          }
        )
        .then((response) => {
          commit("GET_DATA_DETAIL_ALAMAT_BY_ADMIN", response.data?.data);
          console.log(response.data?.data);
          // return response.data?.data
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async fetchDataAlamatByRt({ commit }, data) {
    try {
      await this.$axios
        .get(
          "/getDataAlamatByRt",
          {
            headers: {
              Authorization:
                "Bearer " + this.$cookies.get("dataUser").data?.token,
            },
          }
        )
        .then((response) => {
          commit("GET_DATA_ALAMAT_BY_ADMIN", response.data?.data);
          console.log(response.data?.data);
          // return response.data?.data
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
};
