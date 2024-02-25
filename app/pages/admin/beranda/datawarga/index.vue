<template>
  <div>
    <v-dialog v-model="dialogtambah" max-width="800">
      <v-card class="pa-4 rounded-xl">
        <div class="d-flex justify-end">
          <v-icon @click="closetambah" class="text-1 white rounded-xl mb-3"
          >mdi-close</v-icon
          >
        </div>
        <p class="font-weight-medium">Tambah Data Pengeluaran</p>
        <v-row>
          <v-col cols="6">
            <v-text-field
          clearable
          :rules="[required]"
          label="Masukan Nama"
          v-model="inputTambah.nama"
        ></v-text-field>
          </v-col>
          <v-col cols="6">
            <v-text-field
          clearable
          :rules="[required]"
          label="Masukan No Telp"
          type="number"
          v-model="inputTambah.no_telp"
        ></v-text-field>
          </v-col>
          <v-col cols="6">
            <v-autocomplete
          class="rounded-xl"
          @input="inputalamat"
          v-model="data_alamat_by_rt.alamat_id"
          :items="getAllDataAlamatByIdAlamat"
          item-text="nama"
          item-value="alamat_id"
          label="Masukan Alamat"
          clearable
        ></v-autocomplete>
          </v-col>
          <v-col cols="6">
            <v-autocomplete
          class="rounded-xl"
          v-model="data_alamat_by_rt.detail_alamat_id"
          :items="getAllDataDetailAlamatByIdAlamat"
          item-text="nama"
          item-value="detail_alamat_id"
          label="Masukan Detail Alamat"
          clearable
          :disabled="!data_alamat_by_rt.alamat_id"
        ></v-autocomplete>
          </v-col>
        </v-row>

        <div class="d-flex justify-end">
              <v-btn
                class="rounded-xl bgbrd-2 text-capitalize mt-2 d-flex white--text"
                @click="konfirmtambah"
              >
                Tambah</v-btn
              >
            </div>
      </v-card>
    </v-dialog>
    <dialogInputUser
      :dialogVisible="editdialog"
      :editMode="true"
      @close="editdialog = false"
      :dataEdit="inputEdit"
      :closeaction="closeedit"
      :konfrimdataedit="konfrimdataedit"
      :inputFileEdit="inputFileEdit"
    />
    <dialoghapusUser
      :dialogVisible="hapusdialog"
      :closehapus="closehapus"
      :konfrimdelete="konfrimdelete"
    />
    <v-btn
      class="rounded-xl bgbrd-2 text-capitalize my-4 d-flex white--text"
      @click="tambah"
      :disabled="loadingData"
    >
      Tambah Data</v-btn
    >
    <v-data-table :headers="dataCookies==='Admin'?header:header2" :items="getAllUserById">
      <template v-slot:[`item.foto_ktp`]="{ item }">
        <div>
          <div class="image-container d-flex align-center justify-center">
            <v-img
              :src="'http://127.0.0.1:8000/storage/' + item?.foto_ktp"
              width="80%"
              height="80%"
            ></v-img>
          </div>
        </div>
      </template>
      <template v-slot:[`item.foto_kk`]="{ item }">
        <div>
          <div class="image-container d-flex align-center justify-center">
            <v-img
              :src="'http://127.0.0.1:8000/storage/' + item?.foto_kk"
              width="80%"
              height="80%"
            ></v-img>
          </div>
        </div>
      </template>
      <template v-if="dataCookies==='Admin'" v-slot:[`item.aksi`]="{ item }">
        <div class="d-flex" v-if="getDataUser?.user_id !== item?.user_id">
          <v-btn
            icon
            @click="editwarga(item)"
            :disabled="loadingData"
            class="mr-2"
          >
            <v-icon class="green--text">mdi-pencil</v-icon></v-btn
          >
          <v-btn icon @click="hapuswarga(item)" :disabled="loadingData">
            <v-icon class="red--text">mdi-delete</v-icon></v-btn
          >
        </div>
      </template>
    </v-data-table>
  </div>
</template>

<script src="./js/index.js"></script>

<style scoped>
.image-container {
  width: 100px;
  height: 100px;
  overflow: hidden;
}
.image-container img {
  object-fit: cover;
  object-position: center;
}
</style>
