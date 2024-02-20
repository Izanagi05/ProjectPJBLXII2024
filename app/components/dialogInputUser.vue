<template>
  <div>
    <v-dialog persistent
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
          <v-col lg="4" md="4">
            <v-img
              v-if="dataEdit?.foto_profil"
              :src="'http://127.0.0.1:8000/storage/' + dataEdit?.foto_profil"
            ></v-img>
            <v-img
              v-else
              :src="require('~/assets/img/profil.jpg')"
              class="rounded-xl"
            ></v-img>
            <v-file-input
              clearable
              accept="image/*"
              v-model="inputFileEdit.foto_profil"
              label="Masukan foto profil "
            ></v-file-input>
          </v-col>
          <v-col lg="8" md="8">
            <p class="text-center text-h6 mb-0 mb-4 font-weight-medium">
              Ubah data
            </p>
            <div style="overflow-y: scroll; overflow-x: hidden; height: 400px">
              <v-text-field
                clearable
                :rules="[required]"
                v-model="dataEdit.nama"
                label="Masukan Nama"
              ></v-text-field>
              <v-row>
                <v-col lg="12">
                  <v-text-field
                    clearable
                    :rules="[required]"
                    label="Masukan Nik"
                    type="number"
                    v-model="dataEdit.nik"
                  ></v-text-field>
                </v-col>
                <v-col lg="12">
                  <v-text-field
                    clearable
                    :rules="[required]"
                    label="Masukan No KK"
                    type="number"
                    v-model="dataEdit.no_kk"
                  ></v-text-field>
                </v-col>

                <v-col lg="6">
                  <v-autocomplete
                    class="rounded-xl"
                    v-model="dataEdit.status_berktp"
                    :items="statusBerKtpOptions"
                    label="Masukan Status Berktp"
                    item-text="text"
                    item-value="value"
                    clearable
                  ></v-autocomplete>
                </v-col>
                <v-col lg="6">
                  <v-file-input
                    clearable
                    accept="image/*"
                    v-model="inputFileEdit.foto_ktp"
                    label="Masukan foto KTP "
                  ></v-file-input>
                </v-col>
                <v-col lg="6">
                  <v-file-input
                    clearable
                    accept="image/*"
                    v-model="inputFileEdit.foto_kk"
                    label="Masukan foto KK"
                  ></v-file-input>
                </v-col>
                <v-col lg="5">
                  <v-autocomplete
                    class="rounded-xl"
                    v-model="dataEdit.provinsi_lahir_id"
                    :items="getDataProvinsi"
                    label="Masukan Tempat Lahir"
                    item-text="provinsi"
                    :disabled="checktmptlahir"
                    item-value="provinsi_id"
                    clearable
                  ></v-autocomplete>
                </v-col>
                <v-col lg="7">
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
                        v-model="dataEdit.tgl_lahir"
                        label="Birthday date"
                        prepend-icon="mdi-calendar"
                        readonly
                        v-bind="attrs"
                        v-on="on"
                      ></v-text-field>
                    </template>
                    <v-date-picker
                      v-model="dataEdit.tgl_lahir"
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
                    v-model="dataEdit.tempat_lahir_lainnya"
                  ></v-text-field>
                </v-col>
                <v-col cols="7">
                  <v-text-field
                    label="Telepon"
                    clearable
                    :rules="[required]"
                    type="number"
                    v-model="dataEdit.no_telp"
                  ></v-text-field>
                </v-col>
                <v-col cols="5">
                  <v-autocomplete
                    class="rounded-xl"
                    v-model="dataEdit.jenis_kelamin"
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
                    v-model="dataEdit.hubungan"
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
                    v-model="dataEdit.agama_id"
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
                    v-model="dataEdit.status_perkawinan"
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
                    v-model="dataEdit.pekerjaan"
                  ></v-text-field>
                </v-col>
              </v-row>

              <v-textarea
                :rules="[required]"
                rows="3"
                row-height="25"
                label="Alamat"
              ></v-textarea>
            </div>
            <div class="d-flex justify-end">
              <v-btn
                class="rounded-xl bg-2 text-capitalize mt-2 d-flex white--text"
                @click="konfrimdataedit"
                >
                Ubah</v-btn
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
  // props: {
  //   dialogVisible: Boolean,
  //   editMode: Boolean,
  //   dataEdit: { type: Object },
  // },
  props:[
    'dialogVisible','editMode','dataEdit', 'closeaction' ,'konfrimdataedit', 'inputFileEdit'
],
  data() {
    return {
      editdialog: false,
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
    parseDate (date) {
      if (!date) return null

      const [month, day, year] = date.split('/')
      return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
    },
    save(date) {
      this.$refs.menu.save(date);
      // this.dataEdit.tgl_lahir = date.toISOString().substring(0, 10);
    },

    required(v) {
      return !!v || "Input tidak boleh kosong";
    },
  },
  async created() {
    this.detail_alamat = this.getDataUser?.detail_alamats.map(
      (detailAlamat) => {
        return {
          nama_alamat: detailAlamat.nama,
          nama_blok: detailAlamat.alamat.nama,
        };
      }
    );
      // this.inputEdit=Object
    await this.$store.dispatch("user/fetchDataAgama");
    await this.$store.dispatch("user/fetchDataProvinsi");
  },
};
</script>
