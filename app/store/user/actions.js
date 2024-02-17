// import axios from 'axios'
export default{
  async postLogout() {
    let remember_token = this.$cookies.get("dataUser")?.data.token;
    await this.$axios
      .post("/logout",{data:null},  {
        headers: {
          Authorization:
            "Bearer " + this.$cookies.get("dataUser").data?.token,
        },
      })
      .then((reponse) => {
        this.$cookies.remove("dataUser");
        console.log(reponse.data);
        this.$router.push("/login");
      });
  },
  async fetchUserLogin({commit}, data){
    try {
      const kondisi =
        this.$cookies.get("dataUser").data?.role === "User"
          ? "getUserLogin"
          : "getDataAdmin";
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
  async LoginUser({commit}, data){
    try {
      const formData = new FormData();
      formData.append("email", data.email);
      formData.append("password", data.password);
      await this.$axios
        .post("/login", data)
        .then((response) => {
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
  async fetchDataAgama({commit}, data){
    try {

    await this.$axios
      .get("/getAgama",
      // {
      //   headers: {
      //     Authorization:
      //       "Bearer " + this.$cookies.get("userLogin").data?.token,
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
  async fetchDataProvinsi({commit}, data){
    try {

    await this.$axios
      .get("/getProvinsi",
      // {
      //   headers: {
      //     Authorization:
      //       "Bearer " + this.$cookies.get("userLogin").data?.token,
      //   },
      // }
      )
      .then((response) => {
        commit("GET_DATA_PROVINSI", response.data?.data);
        console.log(response.data?.data);
        // return response.data?.data
      });
  } catch (error) {
    console.error("Error fetching data:", error);
  }
  },
  async updateDataUserLogin({ commit }, data) {
    try {
        const formData = new FormData();
        formData.append("nama", data.nama);
        formData.append("email", data.email);
        formData.append("password", data.password);
        formData.append("jenis_kelamin", data.jenis_kelamin);
        formData.append("nik", data.nik);
        formData.append("no_kk", data.no_kk);
        formData.append("foto_ktp", data.foto_ktp);
        formData.append("foto_kk", data.foto_kk);
        formData.append("provinsi_lahir_id", data.provinsi_lahir_id);
        formData.append("tempat_lahir_lainnya", data.tempat_lahir_lainnya);
        formData.append("tgl_lahir", data.tgl_lahir);
        formData.append("no_telp", data.no_telp);
        formData.append("pekerjaan", data.pekerjaan);
        formData.append("hubungan", data.hubungan);
        formData.append("status_berktp", data.status_berktp);
        formData.append("status_perkawinan", data.status_perkawinan);
        formData.append("agama", data.agama);
        formData.append("status", data.status);

      await this.$axios
        .post("/editUser",formData,
        // {
        //   headers: {
        //     Authorization:
        //       "Bearer " + this.$cookies.get("userLogin").data?.token,
        //   },
        // }
        )
        .then((response) => {
          commit("GET_DATA_USER_LOGIN", response.data?.data);
          console.log(response.data?.data);
          // return response.data?.data
        });
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
}
