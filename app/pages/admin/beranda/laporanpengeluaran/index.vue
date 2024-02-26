<template>
  <div>
    <v-dialog max-width="800" v-model="dialogTambah">
      <v-card class="pa-4 rounded-xl">
        <div class="d-flex justify-end">
          <v-icon @click="closeTambahPengeluaran" class="text-1 white rounded-xl mb-3"
          >mdi-close</v-icon
          >
        </div>
        <p class="font-weight-medium">Tambah Data Pengeluaran</p>
        <v-text-field
          clearable
          :rules="[required]"
          v-model="inputTambah.nama_pengeluaran"
          label="Nama pengeluaran"
        ></v-text-field>
        <v-text-field
          clearable
          :rules="[required]"
          v-model="inputTambah.deskripsi"
          label="Deskripsi"
        ></v-text-field>
        <v-text-field
          clearable
          :rules="[required]"
          v-model="inputTambah.jumlah"
          type="number"
          label="Terbilang"
        ></v-text-field>
        <div class="d-flex justify-end">
              <v-btn
                class="rounded-xl bgbrd-2 text-capitalize mt-2 d-flex white--text"
                @click="konfirmTambahPengeluaran"
              >
                Tambah</v-btn
              >
            </div>
      </v-card>
    </v-dialog>
    <v-dialog max-width="800" v-model="dialogEdit">
      <v-card class="pa-4 rounded-xl">
        <div class="d-flex justify-end">
          <v-icon @click="closeEditPengeluaran" class="text-1 white rounded-xl mb-3"
          >mdi-close</v-icon
          >
        </div>
        <p class="font-weight-medium">Edit Data Pengeluaran</p>
        <v-text-field
          clearable
          :rules="[required]"
          v-model="inputEdit.nama_pengeluaran"
          label="Nama pengeluaran"
        ></v-text-field>
        <v-text-field
          clearable
          :rules="[required]"
          v-model="inputEdit.deskripsi"
          label="Deskripsi"
        ></v-text-field>
        <v-text-field
          clearable
          :rules="[required]"
          v-model="inputEdit.jumlah"
          type="number"
          label="Jumlah"
        ></v-text-field>
        <div class="d-flex justify-end">
              <v-btn
                class="rounded-xl bgbrd-2 text-capitalize mt-2 d-flex white--text"
                @click="konfirmEditPengeluaran"
              >
                Edit</v-btn
              >
            </div>
      </v-card>
    </v-dialog>
    <dialoghapusUser
      :dialogVisible="dialogHapus"
      :closehapus="closeHapusPengeluaran"
      :konfrimdelete="konfirmHapusPengeluaran"
    />
    <v-btn v-if="dataCookies==='Admin'"
      class="rounded-xl bgbrd-2 text-capitalize my-4 d-flex white--text"
      @click="tambahPengeluaran"
      :disabled="loadingData"
    >
      Tambah Data</v-btn
    >
    <v-data-table :headers="header" :items="getAllDataPengeluarans">
      <template  v-if="dataCookies==='Admin'" v-slot:[`item.aksi`]="{ item }">
        <div class="d-flex">
          <v-btn
            icon
            @click="editPengeluaran(item)"
            :disabled="loadingData"
            class="mr-2"
          >
            <v-icon class="green--text">mdi-pencil</v-icon></v-btn
          >
        <v-btn icon @click="hapusPengeluaran(item)" :disabled="loadingData">
            <v-icon class="red--text">mdi-delete</v-icon></v-btn
          >
        </div>
      </template>
    </v-data-table>
    <div class="d-flex justify-end">
      <p class="text-h5 mt-4 font-weight-mmediu">Total Pengeluaran: Rp.{{getSumDataPengeluarans}}</p>
    </div>
  </div>
</template>
<script src="./js/index.js"></script>
