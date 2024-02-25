<template>
  <div>
    <v-dialog v-model="dialogtambahTahun" class="rounded-xl" max-width="800">
      <v-card class="pa-4 rounded-xl">
        <div class="d-flex justify-end">
          <v-icon @click="closeTambahTahun" class="text-1 white rounded-xl mb-3"
            >mdi-close</v-icon
          >
        </div>
        <v-row>
          <v-col cols="6">
            <v-checkbox
              v-model="inputTambahTahun.checkyearwithtagihan"
              label="Tambahkan ke data tagihan semua warga"
              :value="true"
            ></v-checkbox>
            <v-autocomplete
              :disabled="!inputTambahTahun.checkyearwithtagihan"
              class="rounded-xl"
              v-model="inputTambahTahun.jenis_iuran_id"
              :items="getdataAllJenisIurans"
              item-text="nama"
              item-value="jenis_iuran_id"
              label="Masukan Jenis Iuran"
              clearable
            ></v-autocomplete>
          </v-col>
          <v-col cols="6">
            <v-text-field
              clearable
              :rules="[required]"
              label="Masukan Tahun"
              type="number"
              v-model="inputTambahTahun.tahun"
            ></v-text-field>
          </v-col>
        </v-row>

        <div class="d-flex align-center justify-end mt-8">
          <v-btn
            class="rounded-xl px-8 text-capitalize white--text bgbrd-2"
            @click="konfirmTambahTahun"
            >Tambah</v-btn
          >
        </div>
      </v-card>
    </v-dialog>
    <v-dialog v-model="dialogEditTahun" class="rounded-xl" max-width="800">
      <v-card class="pa-4 rounded-xl">
        <div class="d-flex justify-end">
          <v-icon @click="closeEditTahun" class="text-1 white rounded-xl mb-3"
            >mdi-close</v-icon
          >
        </div>
        <v-row>
          <v-col cols="12">
            <v-text-field
              clearable
              :rules="[required]"
              label="Masukan Tahun"
              type="number"
              v-model="inputEditTahun.tahun"
            ></v-text-field>
          </v-col>
        </v-row>

        <div class="d-flex align-center justify-end mt-8">
          <v-btn
            class="rounded-xl px-8 text-capitalize white--text bgbrd-2"
            @click="konfirmEditTahun"
            >Ubah</v-btn
          >
        </div>
      </v-card>
    </v-dialog>
    <dialoghapusUser
      :dialogVisible="dialogHapusTahun"
      :closehapus="closeHapusTahun"
      :konfrimdelete="konfirmHapusTahun"
    />
    <v-btn
      class="rounded-xl bgbrd-2 text-capitalize my-4 d-flex white--text"
      @click="tambahTahun"
      :disabled="loadingData"
    >
      Tambah Data Tahun</v-btn
    >
    <v-data-table class="rounded-xl" :headers="headers" :items="getdataAllYears">
      <template  v-slot:[`item.aksi`]="{ item }">
        <div class="d-flex" >
          <v-btn
            icon
            @click="EditTahun(item)"
            :disabled="loadingData"
            class="mr-2"
          >
            <v-icon class="green--text">mdi-pencil</v-icon></v-btn
          >
          <v-btn icon @click="HapusTahun(item)" :disabled="loadingData">
            <v-icon class="red--text">mdi-delete</v-icon></v-btn
          >
        </div>
      </template>
   </v-data-table>
  </div>
</template>
<script src="./js/index.js"></script>
