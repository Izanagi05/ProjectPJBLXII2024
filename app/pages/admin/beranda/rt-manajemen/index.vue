<template>
  <div>
    <dialoghapusUser
      :dialogVisible="dialogHapus"
      :closehapus="closeHapusRt"
      :konfrimdelete="konfirmHapusRt"
    />
    <v-dialog v-model="dialogTambah" max-width="800">
<v-card class="pa-4 rounded-xl">
  <div class="d-flex justify-end">
          <v-icon @click="closetambahRt" class="text-1 white rounded-xl mb-3"
            >mdi-close</v-icon
          >
        </div>
        <p class="text-body-1 font-weight-medium">Tambah RT</p>
        <v-text-field
          clearable
          :rules="[required]"
          v-model="inputTambah.rt"
          label="Masukan RT"
        ></v-text-field>
        <v-text-field
          clearable
          :rules="[required]"
          v-model="inputTambah.ketua_rt"
          label="Masukan Ketua RT"
        ></v-text-field>
        <v-text-field
          clearable
          :rules="[required]"
          v-model="inputTambah.wakil_ketua_rt"
          label="Masukan Wakil Ketua RT"
        ></v-text-field>
        <div class="d-flex align-center justify-end mt-8">
          <v-btn
            class="rounded-xl px-8 text-capitalize white--text bgbrd-2"
            @click="konfirmtambahRt"
            >Tambah</v-btn
          >
        </div>
</v-card>
    </v-dialog>
    <v-dialog v-model="dialogEdit" max-width="800">
<v-card class="pa-4 rounded-xl">
  <div class="d-flex justify-end">
          <v-icon @click="closeEditRt" class="text-1 white rounded-xl mb-3"
            >mdi-close</v-icon
          >
        </div>
        <p class="text-body-1 font-weight-medium">Edit RT</p>
        <v-text-field
          clearable
          :rules="[required]"
          v-model="inputEdit.rt"
          label="Masukan RT"
        ></v-text-field>
        <v-text-field
          clearable
          :rules="[required]"
          v-model="inputEdit.ketua_rt"
          label="Masukan Ketua RT"
        ></v-text-field>
        <v-text-field
          clearable
          :rules="[required]"
          v-model="inputEdit.wakil_ketua_rt"
          label="Masukan Wakil Ketua RT"
        ></v-text-field>
        <div class="d-flex align-center justify-end mt-8">
          <v-btn
            class="rounded-xl px-8 text-capitalize white--text bgbrd-2"
            @click="konfirmEditRt"
            >Simpan</v-btn
          >
        </div>
</v-card>
    </v-dialog>
    <v-btn v-if="dataCookies==='Admin RW'"
      class="rounded-xl bgbrd-2 text-capitalize my-4 d-flex white--text"
      @click="tambahRt"
      :disabled="loadingData"
    >
      Tambah Data</v-btn
    >
    <v-data-table :headers="header" :items="getdataAllRt">
      <template  v-slot:[`item.aksi`]="{ item }">
        <div class="d-flex">
          <v-btn
            icon
            @click="EditRt(item)"
            :disabled="loadingData"
            class="mr-2"
          >
            <v-icon class="green--text">mdi-pencil</v-icon></v-btn
          >
        <v-btn icon @click="HapusRt(item)" :disabled="loadingData">
            <v-icon class="red--text">mdi-delete</v-icon></v-btn
          >
        </div>
      </template>
    </v-data-table>
  </div>
</template>
<script src="./js/index.js"></script>
