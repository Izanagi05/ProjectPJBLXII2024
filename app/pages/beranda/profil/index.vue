<template>
  <div style="padding-bottom: 80px">

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
                :disabled="loadingData"
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
            <p class="font-weight-medium" style="position: relative;">Foto Ktp</p>
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
            <p class="font-weight-medium" style="position: relative;">Foto KK</p>
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
