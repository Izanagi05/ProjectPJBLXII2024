import axios from "axios";
export default {
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
          console.log(response.data?.data);
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
          console.log(response.data?.data);
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
          this.$toast.success("Berhasil mengubah password", {
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
          this.$toast.success("Berhasil mengubah password", {
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
  async createNewYear({ commit }, data) {
    try {
      const formData = new FormData();
      formData.append("tahun", data.tahun);
      formData.append("jenis_iuran_id", data.jenis_iuran_id??null);
      formData.append("yearwithtagihan", data.checkyearwithtagihan);
      await this.$axios
        .post("/createNewYear", formData, {
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
          this.$toast.success("Berhasil mengubah password", {
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
          this.$toast.success("Berhasil mengubah password", {
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
