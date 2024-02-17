<template>
  <div style="padding-bottom: 80px;">
    <v-card :class="['pa-6 mr-4   rounded-xl bg-whiteblur-card1']">
      <p
    class="text-h5 text-1 font-weight-medium"
    style="position: relative; z-index: 8"
    >
    Form Surat Pengantar
  </p>
      <v-row>
        <v-col cols="12">
          <v-text-field
            label="Nama Warga"

            :rules="[required]"
            clearable
          ></v-text-field>
        </v-col>
        <v-col cols="6">
          <v-text-field
            label="Nama Warga"

            :rules="[required]"
            clearable
          ></v-text-field>

        </v-col>

        <v-col cols="6"> <v-select
            :rules="selectRules"
            v-model="selectedGender"
            :items="genderOptions"
            label="Jenis Kelamin"
          ></v-select></v-col>
        <v-col cols="6">
          <v-select
          :rules="selectRules"
            v-model="selectedReligion"
            :items="religionOptions"
            label="Pilih Agama"
          ></v-select>
        </v-col>
        <v-col cols="6">
          <v-select
          :rules="selectRules"
            v-model="selectedOccupation"
            :items="occupationOptions"
            label="Pilih Pekerjaan"
          ></v-select>
        </v-col>
        <v-col cols="12">
          <v-textarea :rules="[required]" label="Keperluan"></v-textarea>
        </v-col>
        <v-col cols="12" class="d-flex justify-end">
          <v-btn
                class="rounded-xl bg-2 text-capitalize mt-2 d-flex white--text"
                @click="konfirmpengajuan"
                >
                Kirim Pengajuan</v-btn
              >
        </v-col>
      </v-row>
    </v-card>
  </div>
</template>
<script src="./js/index.js"></script>
