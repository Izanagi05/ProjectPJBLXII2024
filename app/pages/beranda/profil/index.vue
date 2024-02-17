<template>
  <div style="padding-bottom: 80px">

    <v-dialog
      class="rounded-xl dialog-event"
      v-model="editdialog"
      style="box-shadow: 0px"
      max-width="800"
    >
      <v-card
        style="box-shadow: none"
        class="rounded-xl bg-whiteblur-card1 pa-4"
      >
        <div class="d-flex justify-end">
          <v-icon @click="closeprofil" class="text-1 white rounded-xl mb-3"
            >mdi-close</v-icon
          >
        </div>
        <v-row>
          <v-col lg="4" md="4">
            <v-img
              :src="require('~/assets/img/profil.jpg')"
              class="rounded-xl"
            ></v-img>
          </v-col>
          <v-col lg="8" md="8">
            <p class="text-center text-h6 mb-0 mb-4 font-weight-medium">
              Detail Akun
            </p>
            <div style="overflow-y: scroll; overflow-x: hidden; height: 400px">
              <v-text-field
                clearable
                :rules="[required]"
                v-model="inputEdit.nama"
                label="Masukan Nama"
              ></v-text-field>
              <v-row>
                <v-col lg="12">
                  <v-text-field
                    clearable
                    :rules="[required]"
                    label="Masukan Nik"
                    type="number"
                    v-model="inputEdit.nik"
                  ></v-text-field>
                </v-col>
                <v-col lg="6">
                  <v-file-input
                    clearable
                    :rules="[required]"
                    v-model="inputEdit.foto_ktp"
                    label="Masukan foto KTP "
                  ></v-file-input>
                </v-col>
                <v-col lg="6">
                  <v-file-input
                    clearable
                    :rules="[required]"
                    v-model="inputEdit.foto_kk"
                    label="Masukan foto KK"
                  ></v-file-input>
                </v-col>
                <v-col lg="5">
                  <v-select
                    class="rounded-xl"
                    v-model="inputEdit.provinsi_id"
                    :items="getDataProvinsi"
                    label="Masukan Tempat Lahir"
                    item-text="provinsi"
                    :disabled="checktmptlahir"
                    item-value="provinsi_id"
                    clearable
                  ></v-select>
                </v-col>
                <v-col lg="7">
                  <v-dialog
                    ref="dialog"
                    v-model="modal"
                    :return-value.sync="date"
                    persistent
                    width="290px"
                  >
                    <template v-slot:activator="{ on, attrs }">
                      <v-text-field
                        v-model="date"
                        label="Tanggal Lahir"
                        prepend-icon="mdi-calendar"
                        :rules="[required]"
                        clearable
                        v-bind="attrs"
                        v-on="on"
                      ></v-text-field>
                    </template>
                    <v-date-picker v-model="date" scrollable>
                      <v-spacer></v-spacer>
                      <v-btn text color="primary" @click="modal = false">
                        Cancel
                      </v-btn>
                      <v-btn
                        text
                        color="primary"
                        @click="$refs.dialog.save(date)"
                      >
                        OK
                      </v-btn>
                    </v-date-picker>
                  </v-dialog>
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
                    type="number"
                    v-model="inputEdit.tempat_lahir_lainnya"
                  ></v-text-field>
                </v-col>

                <v-col cols="7">
                  <v-text-field
                    label="Telepon"
                    clearable
                    :rules="[required]"
                    type="number"
                    v-model="inputEdit.no_telp"
                  ></v-text-field>
                </v-col>
                <v-col cols="5">
                  <v-select
                    class="rounded-xl"
                    v-model="inputEdit.jenis_kelamin"
                    :items="jenisKelaminOptions"
                    label="Jenis Kelamin"
                    clearable
                  ></v-select>
                </v-col>

                <v-col cols="5">
                  <v-select
                    class="rounded-xl"
                    v-model="inputEdit.hubungan"
                    :items="hubunganOptions"
                    label="Hubungan"
                    clearable
                  ></v-select>
                </v-col>
                <v-col cols="7">
                  <v-select
                    class="rounded-xl"
                    v-model="inputEdit.agama_id"
                    :items="getDataAgama"
                    label="Agama"
                    item-text="nama"
                    item-value="agama_id"
                    clearable
                  ></v-select>
                </v-col>
                <v-col cols="5">
                  <v-select
                    class="rounded-xl"
                    v-model="inputEdit.status_perkawinan"
                    :items="statusPerkawinanOptions"
                    label="Status Perkawinan"
                    clearable
                  ></v-select>
                </v-col>
                <v-col cols="7">
                  <v-text-field
                    label="Masukan pekerjaan"
                    clearable
                    :rules="[required]"
                    v-model="inputEdit.pekerjaan"
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
                @click="konfirmprofil"
                ><v-icon class="white--text mr-1" small>mdi-refresh</v-icon>
                Ubah</v-btn
              >
            </div>
          </v-col>
          <v-col cols="12"> </v-col>
        </v-row>
      </v-card>
    </v-dialog>
    <v-row>
      <v-col lg="3" md="3">
        <v-card class="pa-4 bg-whiteblur-card1 rounded-xl d">
          <v-img
            :src="require('~/assets/img/profil.jpg')"
            class="rounded-xl"
          ></v-img>
          <p class="text-center text-h6 mb-0 mt-4 font-weight-medium">
            NIGGERSS KLALA
          </p>
          <div class="pa-4">
            <div class="d-flex justify-center">
              <v-btn
                class="rounded-xl bg-2 text-capitalize mb-4 white--text"
                @click="editprofil"
                style="width: 100%"
                >Edit Profil</v-btn
              >
            </div>
          </div>
        </v-card>
      </v-col>
      <v-col lg="5" md="5">
        <v-card class="pa-4 bg-whiteblur-card1 rounded-xl d">
          <p class="text-center text-h6 mb-0 mb-4 font-weight-medium">
            Detail Profil
          </p>
          <div class="d-flex justify-space-between">
            <p class="grey--text text-body-2">Nama Lengkap</p>
            <p class="text-1 font-weight-medium text-body-2">{{getDataUser?.nama}}</p>
          </div>
          <div class="d-flex justify-space-between">
            <p class="grey--text text-body-2">TTL</p>
            <p class="text-1 font-weight-medium text-body-2">
              Jakarta, {{getDataUser?.tgl_lahir}}
            </p>
          </div>
          <div class="d-flex justify-space-between">
            <p class="grey--text text-body-2">Gender</p>
            <p class="text-1 font-weight-medium text-body-2">{{getDataUser?.jenis_kelamin}}</p>
          </div>
          <div class="">
            <p class="grey--text text-body-2">Alamat</p>
            <p class="text-1 font-weight-medium mb-0 text-body-2" v-for="(dtlalamat,i) in getDataUser?.detail_alamats" :key="i">
            {{dtlalamat?.nama}}, {{dtlalamat?.alamat?.nama}}
            </p>
          </div>
        </v-card>
        <v-card class="pa-4 mt-6 bg-whiteblur-card1 rounded-xl d">
          <p class="d-flex text-body-2 grey--text">
            <v-icon color="grey" class="mr-2" small
              >mdi-map-marker-outline</v-icon
            >
            Bekasi, Indonesia
          </p>
          <p class="d-flex text-body-2 grey--text">
            <v-icon color="grey" class="mr-2" small>mdi-mail</v-icon>
            emailxample23@gmail.com
          </p>
          <p class="d-flex text-body-2 grey--text">
            <v-icon color="grey" class="mr-2" small>mdi-phone</v-icon> +62 928
            8388 2929
          </p>
        </v-card>
      </v-col>
      <v-col lg="4" md="4">
        <v-card class="pa-4 bg-whiteblur-card1 rounded-xl d">
          <p class="text-center text-h6 mb-0 mb-4 font-weight-medium">
            Detail Keluarga
          </p>
          <p class="text-subtitle mb-0 font-weight-medium">
            Warga Rt 001 RW 008
          </p>
          <div class="d-flex justify-space-between align-center mt-4">
            <div class="d-flex align-center">
              <p class="text-h1 font-weight-bold">4</p>
              <div class="text-body-1 text-1 mb-0 ml-4 font-weight-medium">
                Anggota
              </div>
            </div>
            <div>
              <p class="grey--text mb-0 text-body-2">Pekerjaan</p>
              <p class="text-1 font-weight-medium text-h6">Karyawan Swasta</p>
            </div>
          </div>
          <p class="grey--text mb-0 text-body-2">Sebagai</p>
          <p class="text-1 font-weight-medium text-h6">Kepala Keluarga</p>
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>
<script src="./js/index.js"></script>
<style scoped>
.dialog-event {
  box-shadow: none;
  background: transparent;
}
</style>
