<template>
  <div>
    <v-row class="ma-0">
      <v-col cols="6">
        <v-text-field
          v-model="inputEditRW.nama"
          label="Nama RW"
          clearable
          :disabled="!editActive"
          :rules="[required]"
        ></v-text-field>
      </v-col>
      <v-col cols="6">
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
              :disabled="!editActive"
              v-model="inputEditRW.tanggal"
              label="Tanggal Lantik"
              prepend-icon="mdi-calendar"
              readonly
              v-bind="attrs"
              v-on="on"
            ></v-text-field>
          </template>
          <v-date-picker
            :disabled="!editActive"
            v-model="inputEditRW.tanggal"
            :active-picker.sync="activePicker"
            :max="
              new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
                .toISOString()
                .substring(0, 10)
            "
            min="1950-01-01"
            @change="save"
          ></v-date-picker>
        </v-menu>
      </v-col>
      <v-col cols="8">
        <v-row>
          <v-col cols="6">
            <v-text-field
              v-model="inputEditRW.ketua_rw"
              clearable
              :rules="[required]"
              :disabled="!editActive"
              label="Nama Ketua RW"
            ></v-text-field>
          </v-col>
          <v-col cols="6">
            <v-text-field
              v-model="inputEditRW.wakil_rw"
              clearable
              :disabled="!editActive"
              :rules="[required]"
              label="Nama Wakil Ketua RW"
            ></v-text-field>
          </v-col>
          <v-col cols="6">
            <v-text-field
              v-model="inputEditRW.no"
              clearable
              :disabled="!editActive"
              :rules="[required]"
              label="Nomor Surat"
            ></v-text-field>
          </v-col>
          <v-col cols="6">
            <v-text-field
              v-model="inputEditRW.alamat"
              clearable
              :disabled="!editActive"
              :rules="[required]"
              label="Alamat"
            ></v-text-field>
          </v-col>
          <v-col cols="6">
            <v-text-field
              v-model="inputEditRW.kota"
              clearable
              :disabled="!editActive"
              :rules="[required]"
              label="Nama Kota"
            ></v-text-field>
          </v-col>
          <v-col cols="6">
            <v-textarea
              v-model="inputEditRW.alamat_lengkap"
              clearable
              :disabled="!editActive"
              :rules="[required]"
              label="Alamat Lengkap"
            ></v-textarea>
          </v-col>
        </v-row>
      </v-col>
      <v-col cols="4">
        <v-card class="pa-4 rounded-xl">
          <v-btn
          icon
            class="rounded-xl text-capitalize mr-4 my-4 dblack--text"
            :disabled="loadingData||isRefreshing"
            @click="refreshQrKode"
          ><v-icon>mdi-refresh</v-icon></v-btn
          >

          <v-img
            :src="getdataQRcODE"
            width="300px"
            alt="QR Code"
            v-if="getdataQRcODE"
          />

          <div v-else>
            <v-img
              :src="require('~/assets/img/qrloading.jpg')"
              width="300px"
              alt="QR Code"
            />
          </div>
          <!-- <p v-else>Loading QR Code...</p> -->
        </v-card>
        <div class="d-flex justify-center">

          <v-btn
          v-if="!editActive"
          class="rounded-xl green text-capitalize my-4 d-flex white--text"
          @click="editActive = !editActive"
          :disabled="loadingData"
        >
          Edit Profil Rw</v-btn
        >
        <div class="d-flex">
          <v-btn
            v-if="editActive"
            class="rounded-xl text-capitalize mr-4 my-4 d-flex black--text"
            @click="editActive = !editActive"
            :disabled="loadingData"
          >
            Batal</v-btn
          >
          <v-btn
            v-if="editActive"
            class="rounded-xl bgbrd-2 text-capitalize my-4 d-flex white--text"
            @click="simpanData"
            :disabled="loadingData"
          >
            Simpan</v-btn
          >
        </div>
      </div>
      </v-col>
    </v-row>
  </div>
</template>
<script src="./js/index.js"></script>
