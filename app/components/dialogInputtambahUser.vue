<template>
  <div>
    <v-dialog
      persistent
      class="rounded-xl dialog-event"
      v-model="dialogVisible"
      style="box-shadow: 0px"
      max-width="800"
    >
      <v-card
        style="box-shadow: none"
        class="rounded-xl bg-whiteblur-card1 pa-4"
      >
        <div class="d-flex justify-end">
          <v-icon @click="closeaction" class="text-1 white rounded-xl mb-3"
            >mdi-close</v-icon
          >
        </div>
        <v-row>
          <v-col lg="4" md="4" sm="12" xs="12">
            <v-img
              v-if="dataTambah?.foto_profil"
              :max-width="$vuetify.breakpoint.smAndDown ?'200':'300'"
              :src="'http://127.0.0.1:8000/storage/' + dataTambah?.foto_profil"
              class="rounded-xl mx-auto"
            ></v-img>
            <v-img
              v-else
              :max-width="$vuetify.breakpoint.smAndDown ?'200':'300'"
              :src="require('~/assets/img/profil.jpg')"
              class="rounded-xl mx-auto"
            ></v-img>
            <v-file-input
              clearable
              accept="image/*"
              v-model="inputFileTambah.foto_profil"
              label="Masukan foto profil "
            ></v-file-input>
          </v-col>
          <v-col lg="8" md="8">
            <p class="text-center text-h6 mb-0 mb-4 font-weight-medium">
              Tambah data
            </p>
            <div style="overflow-y: scroll; overflow-x: hidden; height: 400px">
              <v-text-field
                clearable
                :rules="[required]"
                v-model="dataTambah.nama"
                label="Masukan Nama"
              ></v-text-field>
              <v-row>
                <v-col cols="12">
                  <v-text-field
                    clearable
                    :rules="[required]"
                    label="Masukan Nik"
                    type="number"
                    v-model="dataTambah.nik"
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-autocomplete
                    class="rounded-xl"
                    v-model="dataTambah.detail_alamat_id_and_alamat_id"
                    :items="detail_alamat_pilihan"
                    label="Masukan alamat "
                    item-text="concetdatalamat"
                    item-value="detail_alamat_id_and_alamat_id"
                    clearable
                  ></v-autocomplete>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    clearable
                    :rules="[required]"
                    label="Masukan No KK"
                    type="number"
                    v-model="dataTambah.no_kk"
                  ></v-text-field>
                </v-col>

                <v-col lg="6" cols="12">
                  <v-autocomplete
                    class="rounded-xl"
                    v-model="dataTambah.status_berktp"
                    :items="statusBerKtpOptions"
                    label="Masukan Status Berktp"
                    item-text="text"
                    item-value="value"
                    clearable
                  ></v-autocomplete>
                </v-col>
                <v-col lg="6" cols="12">
                  <v-file-input
                    clearable
                    accept="image/*"
                    v-model="inputFileTambah.foto_ktp"
                    label="Masukan foto KTP "
                  ></v-file-input>
                </v-col>
                <v-col lg="6" cols="12">
                  <v-file-input
                    clearable
                    accept="image/*"
                    v-model="inputFileTambah.foto_kk"
                    label="Masukan foto KK"
                  ></v-file-input>
                </v-col>
                <v-col lg="5" cols="12">
                  <v-autocomplete
                    class="rounded-xl"
                    v-model="dataTambah.provinsi_lahir_id"
                    :items="getDataProvinsi"
                    label="Masukan Tempat Lahir"
                    item-text="provinsi"
                    :disabled="checktmptlahir"
                    item-value="provinsi_id"
                    clearable
                  ></v-autocomplete>
                </v-col>
                <v-col lg="7" cols="12">
                  <v-menu
                    ref="menu"
                    v-model="menu"
                    :close-on-content-click="false"
                    transition="scale-transition"
                    offset-y
                    min-width="auto"
                  >
                    <template v-slot:activator="{ on, attrs }">
                      <v-text-field
                        v-model="dataTambah.tgl_lahir"
                        label="Tanggal Lahir"
                        prepend-icon="mdi-calendar"
                        readonly
                        v-bind="attrs"
                        v-on="on"
                      ></v-text-field>
                    </template>
                    <v-date-picker
                      v-model="dataTambah.tgl_lahir"
                      :active-picker.sync="activePicker"
                      :max="
                        new Date(
                          Date.now() - new Date().getTimezoneOffset() * 60000
                        )
                          .toISOString()
                          .substring(0, 10)
                      "
                      min="1950-01-01"
                      @change="save"
                    ></v-date-picker>
                  </v-menu>
                </v-col>
                <v-col cols="12">
                  <v-checkbox
                    v-model="checktmptlahir"
                    label="Tempat lahir tidak ada didaftar?"
                    :value="true"
                  ></v-checkbox>
                  <v-text-field
                    v-if="checktmptlahir"
                    clearable
                    :rules="[required]"
                    label="Masukan Tempat Lahir lainnya"
                    v-model="dataTambah.tempat_lahir_lainnya"
                  ></v-text-field>
                </v-col>
                <v-col cols="7">
                  <v-text-field
                    label="Telepon"
                    clearable
                    :rules="[required]"
                    type="number"
                    v-model="dataTambah.no_telp"
                  ></v-text-field>
                </v-col>
                <v-col cols="5">
                  <v-autocomplete
                    class="rounded-xl"
                    v-model="dataTambah.jenis_kelamin"
                    :items="jenisKelaminOptions"
                    label="Jenis Kelamin"
                    item-text="text"
                    item-value="value"
                    clearable
                  ></v-autocomplete>
                </v-col>

                <v-col cols="5">
                  <v-autocomplete
                    class="rounded-xl"
                    v-model="dataTambah.hubungan"
                    :items="hubunganOptions"
                    label="Hubungan"
                    item-text="text"
                    item-value="value"
                    clearable
                  ></v-autocomplete>
                </v-col>
                <v-col cols="7">
                  <v-autocomplete
                    class="rounded-xl"
                    v-model="dataTambah.agama_id"
                    :items="getDataAgama"
                    label="Agama"
                    item-text="nama"
                    item-value="agama_id"
                    clearable
                  ></v-autocomplete>
                </v-col>
                <v-col cols="5">
                  <v-autocomplete
                    class="rounded-xl"
                    v-model="dataTambah.status_perkawinan"
                    :items="statusPerkawinanOptions"
                    item-text="text"
                    item-value="value"
                    label="Status Perkawinan"
                    clearable
                  ></v-autocomplete>
                </v-col>
                <v-col cols="7">
                  <v-text-field
                    label="Masukan pekerjaan"
                    clearable
                    :rules="[required]"
                    v-model="dataTambah.pekerjaan"
                  ></v-text-field>
                </v-col>
              </v-row>
            </div>
            <div class="d-flex pt-4 justify-space-between align-center">
              <v-btn
                class="rounded-xl  text-capitalize   black--text"
                @click="closeaction"
                >
                Batal</v-btn
              >
              <v-btn
                class="rounded-xl bg-2 text-capitalize d-flex white--text"
                @click="konfrimdataTambah"
              >
                Tambah</v-btn
              >
            </div>
          </v-col>
        </v-row>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  props: [
    "dialogVisible",
    "tambahMode",
    "dataTambah",
    "closeaction",
    "konfrimdataTambah",
    "inputFileTambah",
    "detailAlamat",
  ],
  data() {
    return {
      Tambahdialog: false,
      modal: false,
      datePickerFormat: "YYYY-MM-DD",
      hubunganOptions: [
        { text: "Kepala Keluarga", value: "Kepala Keluarga" },
        { text: "Istri", value: "Istri" },
        { text: "Anak", value: "Anak" },
        { text: "Lainnya", value: "Lainnya" },
      ],
      statusBerKtpOptions: [
        { text: "Sudah", value: "Sudah" },
        { text: "Belum", value: "Belum" },
      ],
      jenisKelaminOptions: [
        { text: "Laki-laki", value: "Laki-laki" },
        { text: "Perempuan", value: "Perempuan" },
      ],
      statusPerkawinanOptions: [
        { text: "Belum Menikah", value: "Belum Menikah" },
        { text: "Menikah", value: "Menikah" },
        { text: "Duda", value: "duda" },
        { text: "Janda", value: "Janda" },
        { text: "Lainnya", value: "Lainnya" },
      ],
      activePicker: null,
      date: null,
      menu: false,
      checktmptlahir: false,

      detail_alamat: null,
      detail_alamat_pilihan: [],
    };
  },
  computed: {
    detailalamatt() {
      this.getDataUser?.detail_alamats.map((detailAlamat) => {
        return {
          nama_alamat: detailAlamat.nama,
          nama_blok: detailAlamat.alamat.nama,
        };
      });
    },
    ...mapGetters({
      getDataAgama: "user/getDataAgama",
      getDataProvinsi: "user/getDataProvinsi",
      getDataUser: "user/getDataUser",
    }),
  },
  watch: {
    menu(val) {
      val && setTimeout(() => (this.activePicker = "YEAR"));
    },
  },
  methods: {
    parseDate(date) {
      if (!date) return null;

      const [month, day, year] = date.split("/");
      return `${year}-${month.padStart(2, "0")}-${day.padStart(2, "0")}`;
    },
    save(date) {
      this.$refs.menu.save(date);
      // this.dataTambah.tgl_lahir = date.toISOString().substring(0, 10);
    },

    required(v) {
      return !!v || "Input tidak boleh kosong";
    },
  },
  async created() {
    await this.$store.dispatch("user/fetchUserLogin");
    this.detail_alamat_pilihan = this.getDataUser?.detail_alamats.map(
      (detailAlamat, i) => {
        return {
          alamat_id: detailAlamat?.alamat?.alamat_id,
          nama_alamat: detailAlamat.nama,
          nama_blok: detailAlamat?.alamat.nama,
          detail_alamat_id: detailAlamat.detail_alamat_id,
          concetdatalamat: detailAlamat.nama + ", " + detailAlamat?.alamat.nama,
          detail_alamat_id_and_alamat_id: [
            detailAlamat.detail_alamat_id,
            detailAlamat?.alamat?.alamat_id,
          ],
        };
      }
    );
    // console.log("ojm", this.detail_alamat_pilihan);
    // this.inputTambah=Object
    await this.$store.dispatch("user/fetchDataAgama");
    await this.$store.dispatch("user/fetchDataProvinsi");
  },
};
</script>
