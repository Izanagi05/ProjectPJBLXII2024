// import axios from 'axios'
export default {
  async postLogout() {
    let remember_token = this.$cookies.get("dataUser")?.data.token;
    await this.$axios
      .post(
        "/logout",
        { data: null },
        {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        }
      )
      .then((reponse) => {
        this.$cookies.remove("dataUser");
        console.log(reponse.data);
        this.$router.push("/login");
      });
  },
  async fetchUserLogin({ commit }, data) {
    try {
      const kondisi =
        this.$cookies.get("dataUser").data?.role === "User"
          ? "/getUserLogin"
          : "/getAdminLogin";
      await this.$axios
        .get(kondisi, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          commit("GET_DATA_USER_LOGIN", response.data?.data);
          console.log(response.data?.data);
          // return response.data?.data
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  fetchdatacookie({ commit }) {
    const cookieku = this.$cookies.get("dataUser");
    commit("GET_DATA_COOKIE", cookieku);
  },
  async deleteLaporanUser({ commit }, data) {
    try {
      await this.$axios
        .delete("/deleteLaporan/" + data, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          commit("DELETE_DATA_LAPORAN", data);
          console.log(response.data?.data);
          // return response.data?.data
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async fetchallwargabyalamat({ commit }, data) {
    try {
      const kondisi =
        // this.$cookies.get("dataUser").data?.role === "User"
        //   ? "getallwargabyalamat"
        //   : "getDataAdmin";
        await this.$axios
          .get("/getallwargabyalamat", {
            headers: {
              Authorization:
                "Bearer " + this.$cookies.get("dataUser").data?.token,
            },
          })
          .then((response) => {
            commit("GET_DATA_ALL_WARGA_ALAMAT", response.data?.data);
            // return response.data?.data
          });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async LoginUser({ commit }, data) {
    try {
      const formData = new FormData();
      formData.append("email", data.email);
      formData.append("password", data.password);
      await this.$axios.post("/login", data).then((response) => {
        // commit("GET_DATA_USER_LOGIN", response.data?.data);
        // console.log(response.data?.data);
        this.$cookies.set("dataUser", response.data);
        const kondisi =
          this.$cookies.get("dataUser").data?.role === "User"
            ? "/beranda"
            : "/admin/beranda";
        this.$router.push(kondisi);
        this.$toast.success("Berhasil Masuk", {
          duration: 3000,
        });
      });
    } catch (error) {
      this.$toast.error("Password atau email tidak sesuai ", {
        duration: 3000,
      });
      console.error("Error fetching data:", error);
    }
  },
  async fetchDataAgama({ commit }, data) {
    try {
      await this.$axios
        .get(
          "/getAgama"
          // {
          //   headers: {
          //     Authorization:
          //       "Bearer " + this.$cookies.get("dataUser").data?.token,
          //   },
          // }
        )
        .then((response) => {
          commit("GET_DATA_AGAMA", response.data?.data);
          console.log(response.data?.data);
          // return response.data?.data
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async fetchDataProvinsi({ commit }, data) {
    try {
      await this.$axios
        .get(
          "/getProvinsi"
          // {
          //   headers: {
          //     Authorization:
          //       "Bearer " + this.$cookies.get("dataUser").data?.token,
          //   },
          // }
        )
        .then((response) => {
          commit("GET_DATA_PROVINSI", response.data?.data);
          // return response.data?.data
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async updateDataUserLogin({ commit }, payload) {
    try {
      const { data, fotobaru } = payload;
      const formData = new FormData();
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

      await this.$axios
        .post("/editUser", formData, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          // this.fetchUserLogin
          commit("UPDATE_DATA_USER_LOGIN", response.data?.data);
          console.log(response.data?.data);
          // return response.data?.data
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async deleteDataUserbyid({ commit }, data) {
    try {
      await this.$axios
        .delete(
          "/deleteUserbyid/" + data
          // {
          //   headers: {
          //     Authorization:
          //       "Bearer " + this.$cookies.get("dataUser").data?.token,
          //   },
          // }
        )
        .then((response) => {
          commit("DELETE_DATA_BY_ID_WARGA_ALAMAT", data);
          // window.location.reload();

          // this.fetchallwargabyalamat;
          console.log(response.data?.data);
          // return response.data?.data
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async updateDataWargabyAlamat({ commit }, payload) {
    try {
      const { data, fotobaru } = payload;
      const formData = new FormData();
      formData.append("user_id", data.user_id);
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

      await this.$axios
        .post("/editUserbyid", formData, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          // this.fetchallwargabyalamat;

          commit("UPDATE_DATA_WARGA_ALAMAT", response.data?.data);
          console.log(response.data?.data);
          // return response.data?.data
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async tambahDataWargabyAlamat({ commit }, payload) {
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
        .post("/tambahUserbyid", formData, {
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
  async fetchAllLaporanUser({ commit }, data) {
    try {
      await this.$axios
        .get("/allLaporan", {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          commit("GET_DATA_ALL_LAPORAN", response.data?.data);
          console.log(response.data?.data);
          // return response.data?.data
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
  async tambahDataLaporan({ commit }, payload) {
    try {
      const { data, detail_alamat } = payload;
      const formData = new FormData();
      // formData.append("user_id", data.user_id);
      formData.append("keperluan", data.keperluan);
      formData.append("alamat_id", data.detail_alamat_id_and_alamat_id[1]);
      formData.append(
        "detail_alamat_id",
        data.detail_alamat_id_and_alamat_id[0]
      );

      await this.$axios
        .post("/createLaporan", formData, {
          headers: {
            Authorization:
              "Bearer " + this.$cookies.get("dataUser").data?.token,
          },
        })
        .then((response) => {
          // this.fetchallwargabyalamat;

          commit("TAMBAH_DATA_LAPORAN", response.data?.data);
          // const blob = new Blob([response.data], { type: "application/pdf" });
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },

  async exportDataLaporan({ commit }, payload) {
    try {
      const formData = new FormData();
      formData.append("laporan_id", payload.laporan_id);
      formData.append("alamat_id", payload.detail_alamat_id_and_alamat_id[1]);
      formData.append(
        "detail_alamat_id",
        payload.detail_alamat_id_and_alamat_id[0]
      );
      await this.$axios
        .get(
          "/exportPDF/" +
            payload.laporan_id +
            "/" +
            payload.detail_alamat_id_and_alamat_id[0] +
            "/" +
            payload.detail_alamat_id_and_alamat_id[1],
          {
            headers: {
              Authorization:
                "Bearer " + this.$cookies.get("dataUser").data?.token,
            },
            responseType: 'blob'
          }
        )
        .then((response) => {
          const blob = new Blob([response.data], { type: "application/pdf" });
          const now = new Date();
          const year = now.getFullYear();
          const month = String(now.getMonth() + 1).padStart(2, "0"); //04
          const day = String(now.getDate()).padStart(2, "0"); //09
          const fileName = `data_${year}-${month}-${day}.pdf`;

          const link = document.createElement("a");
          link.href = window.URL.createObjectURL(blob);
          link.download = fileName;
          link.click();
          this.$toast.success("Berhasil mengambil data pdf", {
            duration: 3000,
          });
          console.log(response.data?.data);
          // return response.data?.data;
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
};
