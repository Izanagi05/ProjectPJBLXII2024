import axios from "axios";
export default {
  async createTagihanByUserIdIPL({ commit }, data) {
    try {
      const formData = new FormData();
      formData.append('nama', data.nama);
      formData.append('deskripsi', data.deskripsi);
      formData.append('jumlah', data.jumlah);
      formData.append('tahun_id', data.tahun_id??null);
      formData.append('bulan_id', data.bulan_id??1);
      formData.append('user_id', data.user_id);
      formData.append('jenis_iuran_id', data.jenis_iuran_id);

      await this.$axios
        .post("/createTagihanByUserIdIPL",formData, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          // console.log(response.data?.data);
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async getAllDetailAlamat({ commit }, data) {
    try {
      await this.$axios
        .get("/getAllDetailAlamat", {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          commit("GET_ALL_DATA_DETAIL_ALAMAT", response.data?.data);
          // console.log(response.data?.data);
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async tambahDetailAlamat({ commit }, data) {
    try {
      const formData = new FormData();
      formData.append("alamat_id", data.alamat_id);
      formData.append("nama", data.nama);
      await this.$axios
        .post("/tambahDetailAlamat",formData, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          console.log(response);
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async updateDetailAlamat({ commit }, data) {
    try {
      const formData = new FormData();
      formData.append("alamat_id", data.alamat_id);
      formData.append("nama", data.nama);
      await this.$axios
        .post("/updateDetailAlamat",formData, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          console.log(response);
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async deleteDetailAlamat({ commit }, data) {
    try {
      await this.$axios
        .delete("/deleteDetailAlamat/"+data.alamat_id, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          // console.log(response.data?.data);
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async getallalamat({ commit }, data) {
    try {
      await this.$axios
        .get("/getallalamat", {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          commit("GET_ALL_DATA_ALAMAT", response.data?.data);
          // console.log(response.data?.data);
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async tambahallalamat({ commit }, data) {
    try {
      const formData = new FormData();
      formData.append("rt_id", data.rt_id);
      formData.append("nama", data.nama);
      await this.$axios
        .post("/tambahallalamat",formData, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          console.log(response);
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async updateAlamat({ commit }, data) {
    try {
      const formData = new FormData();
      formData.append("alamat_id", data.alamat_id);
      formData.append("rt_id", data.rt_id);
      formData.append("nama", data.nama);
      await this.$axios
        .post("/updateAlamat",formData, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          console.log(response);
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async deleteAlamat({ commit }, data) {
    try {
      await this.$axios
        .delete("/deleteAlamat/"+data.alamat_id, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          // console.log(response.data?.data);
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async deleteTataTertib({ commit }, data) {
    try {
      await this.$axios
        .delete("/deleteTataTertib/"+data.tata_tertib_id, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },

  async getTataTertib({ commit }, data) {
    try {
      await this.$axios
        .get("/getTataTertib", {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          commit("GET_TATIB_DATA", response.data?.data);
          // console.log(response.data?.data);
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async tambahTataTertib({ commit }, data) {
    try {
      const formData = new FormData();
      formData.append("judul", data.judul);
      formData.append("deskripsi", data.deskripsi);
      await this.$axios
        .post("/tambahTataTertib",formData, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async updateTataTertib({ commit }, data) {
    try {
      const formData = new FormData();
      formData.append("tata_tertib_id", data.tata_tertib_id);
      formData.append("judul", data.judul);
      formData.append("deskripsi", data.deskripsi);
      await this.$axios
        .post("/updateTataTertib",formData, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          // console.log(response.data?.data);
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async deleteTataTertib({ commit }, data) {
    try {
      await this.$axios
        .delete("/deleteTataTertib/"+data.tata_tertib_id, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async updateRW({ commit }, data) {
    try {
      const formData = new FormData();
      formData.append("nama", data.nama);
      formData.append("no", data.no);
      formData.append("tanggal", data.tanggal);
      formData.append("kota", data.kota);
      formData.append("alamat", data.alamat);
      formData.append("alamat_lengkap", data.alamat_lengkap);
      formData.append("ketua_rw", data.ketua_rw);
      formData.append("wakil_rw", data.wakil_rw);
      await this.$axios
        .post("/updateRW",formData, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          // console.log(response.data?.data);
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async getRW({ commit }, data) {
    try {
      await this.$axios
        .get("/getRW", {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          commit("GET_RW_DATA", response.data?.data);
          // console.log(response.data?.data);
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async getAllGroupData({ commit }, data) {
    try {
      await this.$axios
        .get("/getAllGroupData", {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          commit("GET_ADMIN_DATA_GROUP", response.data?.data);
          // console.log(response.data?.data);
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async getQrCodeinUrl({ commit }, data) {
    try {
      await this.$axios
        .get("/getQrCodeinUrl", {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          commit("GET_BOT_QR_CODE", response.data?.data);
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async deleteGroupData({ commit }, data) {
    try {
      await this.$axios
        .delete("/deleteGroupData/"+data.wa_group_id, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          // console.log(response.data?.data);
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async fetchDataAdminControl({ commit }, data) {
    try {
      await this.$axios
        .get("/getAllDataAdmin" + "/" + (data ?? ""), {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          commit("GET_ADMIN_DATA_CONTROL", response.data?.data);
          // console.log(response.data?.data);
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async fetchDataAllRT({ commit }, data) {
    try {
      await this.$axios
        .get("/getAllRT", {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          commit("GET_DATA_ALL_RT", response.data?.data);
          // console.log(response.data?.data);
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async postMessageCustomToGroup({ commit }, data) {
    try {
      const formData = new FormData();
      formData.append("to", data.group_data_id);
      formData.append("message", data.message);
      await this.$axios
        .post("/postMessageCustomToGroup",formData, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          // console.log(response.data?.data);
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async storeRT({ commit }, data) {
    try {
      const formData = new FormData();
      formData.append("rt", data.rt);
      formData.append("ketua_rt", data.ketua_rt);
      formData.append("wakil_ketua_rt", data.wakil_ketua_rt);
      await this.$axios
        .post("/storeRT",formData, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          // commit("GET_DATA_ALL_RT", response.data?.data);
          // console.log(response.data?.data);
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async updateIzinGroupData({ commit }, data) {
    try {
      const formData = new FormData();
      formData.append("wa_group_id", data.wa_group_id);
      formData.append("izin", data.izin);
      formData.append("rt_id", data.rt_id);
      await this.$axios
        .post("/updateIzinGroupData",formData, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          // commit("GET_DATA_ALL_RT", response.data?.data);
          // console.log(response.data?.data);
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async updateRT({ commit }, data) {
    try {
      const formData = new FormData();
      formData.append("rt_id", data.rt_id);
      formData.append("rt", data.rt);
      formData.append("ketua_rt", data.ketua_rt);
      formData.append("wakil_ketua_rt", data.wakil_ketua_rt);
      await this.$axios
        .post("/updateRT",formData, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          // commit("GET_DATA_ALL_RT", response.data?.data);
          // console.log(response.data?.data);
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async updateRW({ commit }, data) {
    try {
      const formData = new FormData();
      formData.append("rw_id", data.rw_id);
      formData.append("nama", data.nama);
      formData.append("no", data.no);
      formData.append("tanggal", data.tanggal);
      formData.append("kota", data.kota);
      formData.append("wakil_ketua_rt", data.wakil_ketua_rt);
      formData.append("alamat", data.alamat);
      formData.append("alamat_lengkap", data.alamat_lengkap);
      formData.append("ketua_rw", data.ketua_rw);
      formData.append("wakil_rw", data.wakil_rw);
      await this.$axios
        .post("/updateRW",formData, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          // commit("GET_DATA_ALL_RT", response.data?.data);
          // console.log(response.data?.data);
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async deleteRT({ commit }, data) {
    try {
      await this.$axios
        .delete("/deleteRT/"+data?.rt_id??null, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          // commit("GET_DATA_ALL_RT", response.data?.data);
          // console.log(response.data?.data);
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async fetchADminRolesData({ commit }, data) {
    try {
      await this.$axios
        .get("/getADminRolesData" + "/" + (data ?? ""), {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          commit("GET_ADMIN_DATA_ROLES", response.data?.data);
          // console.log(response.data?.data);
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },

  async deleteDataAdminControl({ commit }, data) {
    try {
      await this.$axios
        .delete("/deleteDataAdmiControl/" + data, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          commit("DELETE_ADMIN_DATA_CONTROL", response.data?.data);
          this.$toast.success("Berhasil menghapus akun admin", {
            duration: 3000,
          });
        });
    } catch (error) {
      this.$toast.error("Terjadi kesalahan saat menghapus", {
        duration: 3000,
      });
      console.error("Error fetching data:", error);
    }
  },
  async changeUserPassword({ commit }, data) {
    try {
      await this.$axios
        .post("/changePasswordAdminControl", data, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          this.$toast.success("Berhasil mengubah password", {
            duration: 3000,
          });
          console.log(response);
        });
    } catch (error) {
      this.$toast.error("Terjadi kesalahan saat mengubah password", {
        duration: 3000,
      });
      console.error("Error fetching data:", error);
    }
  },
  async tambahDataAdmin({ commit }, payload) {
    try {
      const { data, detail_alamat } = payload;
      const formData = new FormData();
      // formData.append("user_id", data.user_id);
      formData.append("admin_role_id", data.admin_role_id);
      formData.append("nama", data.nama);
      formData.append("no_telp", data.no_telp);
      formData.append("alamat_id", detail_alamat.alamat_id);
      formData.append(
        "detail_alamat_id",
        detail_alamat.detail_alamat_id
      );
      await this.$axios
        .post("/tambahDataAdmin", formData, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          this.$toast.success("Berhasil menambah password", {
            duration: 3000,
          });
          console.log(response);
        });
    } catch (error) {
      this.$toast.error("Terjadi kesalahan saat menambah password", {
        duration: 3000,
      });
      console.error("Error fetching data:", error);
    }
  },
  async getAllJenisIurans({ commit }, payload) {
    try {
      await this.$axios
        .get("/getAllJenisIurans", {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          commit("DATA_ALL_JENIS_IURAN", response.data?.data);
          // this.$toast.success("Berhasil mengambil data", {
          //   duration: 3000,
          // });
          console.log(response);
        });
    } catch (error) {
      this.$toast.error("Terjadi kesalahan ", {
        duration: 3000,
      });
      console.error("Error fetching data:", error);
    }
  },
  async getAllBulan({ commit }, payload) {
    try {
      await this.$axios
        .get("/getAllBulan", {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          commit("DATA_ALL_BULAN", response.data?.data);
          this.$toast.success("Berhasil mengambil data", {
            duration: 3000,
          });
          console.log(response);
        });
    } catch (error) {
      this.$toast.error("Terjadi kesalahan ", {
        duration: 3000,
      });
      console.error("Error fetching data:", error);
    }
  },
  async createJenisIuran({ commit }, data) {
    try {
      const formData = new FormData();
      formData.append("nama", data.nama);
      formData.append("deskripsi", data.deskripsi);
      formData.append("jumlah", data.jumlah??null);
      formData.append("tahun_id", data.tahun_id??null);
      formData.append("bulan_id", data.bulan_id??1);
      formData.append("withtagihan", data.withtagihan??false);
      formData.append("semuabulan", data.semuabulan??false);
      await this.$axios
        .post("/createJenisIuran", formData, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          this.$toast.success("Berhasil menambah data", {
            duration: 3000,
          });
          console.log(response);
        });
    } catch (error) {
      this.$toast.error("Terjadi kesalahan ", {
        duration: 3000,
      });
      console.error("Error fetching data:", error);
    }
  },
  async updateJenisIuran({ commit }, data) {
    try {
      const formData = new FormData();
      formData.append("jenis_iuran_id", data.jenis_iuran_id);
      formData.append("nama", data.nama);
      formData.append("deskripsi", data.deskripsi);
      formData.append("jumlah", data.jumlah??null);
      await this.$axios
        .post("/updateJenisIuran", formData, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          this.$toast.success("Berhasil mengubah data", {
            duration: 3000,
          });
          console.log(response);
        });
    } catch (error) {
      this.$toast.error("Terjadi kesalahan ", {
        duration: 3000,
      });
      console.error("Error fetching data:", error);
    }
  },
  async deleteJenisIuran({ commit }, payload) {
    try {
      await this.$axios
        .delete("/deleteJenisIuran/"+payload.jenis_iuran_id, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          this.$toast.success("Berhasil menghapus data", {
            duration: 3000,
          });
          console.log(response);
        });
    } catch (error) {
      this.$toast.error("Terjadi kesalahan ", {
        duration: 3000,
      });
      console.error("Error fetching data:", error);
    }
  },

  async getAllTahun({ commit }, payload) {
    try {
      await this.$axios
        .get("/getAllTahun", {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          commit("DATA_ALL_YEARS", response.data?.data);
          // this.$toast.success("Berhasil mengambil data", {
          //   duration: 3000,
          // });
          console.log(response);
        });
    } catch (error) {
      this.$toast.error("Terjadi kesalahan ", {
        duration: 3000,
      });
      console.error("Error fetching data:", error);
    }
  },
  async createNewYear({ commit }, data) {
    try {
      const formData = new FormData();
      formData.append("tahun", data.tahun);
      formData.append("jenis_iuran_id", data.jenis_iuran_id??null);
      formData.append("yearwithtagihan", data.checkyearwithtagihan??false);
      await this.$axios
        .post("/createNewYear", formData, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          this.$toast.success("Berhasil menambah data", {
            duration: 3000,
          });
          console.log(response);
        });
    } catch (error) {
      this.$toast.error("Terjadi kesalahan ", {
        duration: 3000,
      });
      console.error("Error fetching data:", error);
    }
  },
  async updateTahun({ commit }, payload) {
    try {
      const data = payload;
      const formData = new FormData();
      // formData.append("user_id", data.user_id);
      formData.append("tahun_id", data.tahun_id);
      formData.append("tahun", data.tahun);
      formData.append("jenis_iuran_id", data.jenis_iuran_id??null);
      await this.$axios
        .post("/updateTahun", formData, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          this.$toast.success("Berhasil mengubah data", {
            duration: 3000,
          });
          console.log(response);
        });
    } catch (error) {
      this.$toast.error("Terjadi kesalahan ", {
        duration: 3000,
      });
      console.error("Error fetching data:", error);
    }
  },
  async deleteYear({ commit }, payload) {
    try {
      await this.$axios
        .delete("/deleteYear/"+payload.tahun_id, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          this.$toast.success("Berhasil menghapus data", {
            duration: 3000,
          });
          console.log(response);
        });
    } catch (error) {
      this.$toast.error("Terjadi kesalahan ", {
        duration: 3000,
      });
      console.error("Error fetching data:", error);
    }
  },
};
