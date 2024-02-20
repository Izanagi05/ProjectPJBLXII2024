<template>
  <div style="padding-bottom: 80px">
    <!-- <v-dialog
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
            v-if="getDataUser?.foto_profil"
            :src="'http://127.0.0.1:8000/storage/' + getDataUser?.foto_profil"
          ></v-img>
          <v-img
            v-else
            :src="require('~/assets/img/profil.jpg')"
            class="rounded-xl"
          ></v-img>
            <v-file-input
              clearable
              v-model="inputFileEdit.foto_profil"
              label="Masukan foto profil "
            ></v-file-input>
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
                <v-col lg="12">
                  <v-text-field
                    clearable
                    :rules="[required]"
                    label="Masukan No KK"
                    type="number"
                    v-model="inputEdit.no_kk"
                  ></v-text-field>
                </v-col>

                <v-col lg="6">
                  <v-autocomplete
                    class="rounded-xl"
                    v-model="inputEdit.status_berktp"
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
                    v-model="inputFileEdit.foto_ktp"
                    label="Masukan foto KTP "
                  ></v-file-input>
                </v-col>
                <v-col lg="6">
                  <v-file-input
                    clearable
                    v-model="inputFileEdit.foto_kk"
                    label="Masukan foto KK"
                  ></v-file-input>
                </v-col>
                <v-col lg="5">
                  <v-autocomplete
                    class="rounded-xl"
                    v-model="inputEdit.provinsi_lahir_id"
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
                        v-model="inputEdit.tgl_lahir"
                        label="Birthday date"
                        prepend-icon="mdi-calendar"
                        readonly
                        v-bind="attrs"
                        v-on="on"
                      ></v-text-field>
                    </template>
                    <v-date-picker
                      v-model="inputEdit.tgl_lahir"
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
                  <v-autocomplete
                    class="rounded-xl"
                    v-model="inputEdit.jenis_kelamin"
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
                    v-model="inputEdit.hubungan"
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
                    v-model="inputEdit.agama_id"
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
                    v-model="inputEdit.status_perkawinan"
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
    </v-dialog> -->
    <dialogInputUser
      :dialogVisible="editdialog"
      :editMode="true"
      @close="editdialog = false"
      :dataEdit="inputEdit"
      :closeaction="closeprofil"
      :konfrimdataedit="konfirmprofil"
      :inputFileEdit="inputFileEdit"
    />
    <v-row>
      <v-col lg="3" md="3">
        <v-card class="pa-4 bg-whiteblur-card1 rounded-xl d">
          <v-img
            v-if="getDataUser?.foto_profil"
            :src="'http://127.0.0.1:8000/storage/' + getDataUser?.foto_profil"
          ></v-img>
          <v-img
            v-else
            :src="require('~/assets/img/profil.jpg')"
            class="rounded-xl"
          ></v-img>
          <p
            class="text-center text-h6 mb-0 mt-4 font-weight-medium text-truncate"
          >
            {{ getDataUser?.nama }}
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
            <p class="text-1 font-weight-medium text-body-2 text-truncate">
              {{ getDataUser?.nama }}
            </p>
          </div>
          <div class="d-flex justify-space-between">
            <p class="grey--text text-body-2">TTL</p>
            <p class="text-1 font-weight-medium text-body-2">
              {{getDataUser?.user_provinsi?.provinsi}}, {{ getDataUser?.tgl_lahir }}
            </p>
          </div>
          <div class="d-flex justify-space-between">
            <p class="grey--text text-body-2">Gender</p>
            <p class="text-1 font-weight-medium text-body-2">
              {{ getDataUser?.jenis_kelamin }}
            </p>
          </div>
          <div class="">
            <p class="grey--text text-body-2">Alamat</p>
            <p
              class="text-1 font-weight-medium mb-0 text-body-2"
              v-for="(dtlalamat, i) in getDataUser?.detail_alamats"
              :key="i"
            >
              {{ dtlalamat?.nama }}, {{ dtlalamat?.alamat?.nama }}
            </p>
          </div>
        </v-card>
        <v-card class="pa-4 mt-6 bg-whiteblur-card1 rounded-xl d">
          <!-- <p class="d-flex text-body-2 grey--text">
            <v-icon color="grey" class="mr-2" small
              >mdi-map-marker-outline</v-icon
            >
            Bekasi, Indonesia
          </p> -->
          <p class="d-flex text-body-2 grey--text">
            <v-icon color="grey" class="mr-2" small>mdi-mail</v-icon>
            {{ getDataUser?.email }}
          </p>
          <p class="d-flex text-body-2 mb-0 grey--text">
            <v-icon color="grey" class="mr-2" small>mdi-phone</v-icon>
            {{ getDataUser?.no_telp }}
          </p>
        </v-card>
      </v-col>
      <v-col lg="4" md="4">
        <div
          class="d-inline-flex rounded-xl"
          style="overflow-x: scroll; width: 100%"
        >
          <v-card
            style="min-width: 100%"
            class="pa-4 mr-4 bg-whiteblur-card1 rounded-xl d"
            v-for="(dtlalamat, i) in getDataUser?.detail_alamats"
            :key="i"
          >
            <p class="text-center text-h6 mb-0 mb-4 font-weight-medium">
              Detail Keluarga
            </p>
            <p class="text-subtitle mb-0 font-weight-medium">
              Warga {{ dtlalamat?.alamat?.r_t?.rt }} - {{ dtlalamat?.nama }}, {{ dtlalamat?.alamat?.nama }}
            </p>
            <div class="d-flex justify-space-between align-center mt-4">
              <div class="d-flex align-center">
                <p class="text-h1 font-weight-bold">
                  {{ dtlalamat?.jumlah_wargas }}
                </p>
                <div class="text-body-1 text-1 mb-0 ml-4 font-weight-medium">
                  Anggota
                </div>
              </div>
              <div>
                <p class="grey--text mb-0 text-body-2">Pekerjaan</p>
                <p class="text-1 font-weight-medium text-h6">
                  {{ getDataUser?.pekerjaan }}
                </p>
              </div>
            </div>
            <p class="grey--text mb-0 text-body-2">Sebagai</p>
            <p class="text-1 font-weight-medium text-h6">
              {{ getDataUser?.hubungan }}
            </p>
          </v-card>
        </div>
        <v-row class="mt-3">
          <v-col cols="6">
            <v-card
              class="pa-4 bg-whiteblur-card1 rounded-xl d"
              style="height: 100%"
            >
              <v-img
                v-if="getDataUser?.foto_ktp"
                :src="'http://127.0.0.1:8000/storage/' + getDataUser?.foto_ktp"
                style="height: 100%; object-fit: cover; object-position: center"
              ></v-img>
              <v-img
                v-else
                :src="require('~/assets/img/profil.jpg')"
                class="rounded-xl"
              ></v-img>
            </v-card>
          </v-col>
          <v-col cols="6">
            <v-card
              class="pa-4 bg-whiteblur-card1 rounded-xl d"
              style="height: 100%"
            >
              <v-img
                v-if="getDataUser?.foto_kk"
                :src="'http://127.0.0.1:8000/storage/' + getDataUser?.foto_kk"
                style="height: 100%; object-fit: cover; object-position: center"
              ></v-img>
              <v-img
                v-else
                :src="require('~/assets/img/profil.jpg')"
                class="rounded-xl"
              ></v-img>
            </v-card>
          </v-col>
        </v-row>
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
