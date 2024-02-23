<template>
  <div>
    <dialogInputUser
      :dialogVisible="editdialog"
      :editMode="true"
      @close="editdialog = false"
      :dataEdit="inputEdit"
      :closeaction="closeedit"
      :konfrimdataedit="konfrimdataedit"
      :inputFileEdit="inputFileEdit"
    />
    <dialogInputtambahUser
    :dialogVisible="dialogtambah"
      :tambahMode="true"
      @close="dialogtambah = false"
      :dataTambah="inputTambah"
      :detailAlamat="detail_alamat"
      :closeaction="closetambah"
      :konfrimdataTambah="konfirmtambah"
      :inputFileTambah="inputFileTambah"
    />
    <dialoghapusUser
      :dialogVisible="hapusdialog"
      :closehapus="closehapus"
      :konfrimdelete="konfrimdelete"
    />
    <v-btn
      class="rounded-xl bg-2 text-capitalize my-4 d-flex white--text"
      @click="tambah"  :disabled="loadingData"
    >
      Tambah Data</v-btn
    >
    <v-data-table :headers="header" :items="getAllUserById">
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
          <template v-slot:[`item.aksi`]="{ item }">
            <div class="d-flex"  v-if="getDataUser?.user_id !==item?.user_id">
              <v-btn icon @click="editwarga(item)"  :disabled="loadingData" class="mr-2">
                <v-icon class="green--text">mdi-pencil</v-icon></v-btn
              >
              <v-btn icon @click="hapuswarga(item)"  :disabled="loadingData">
                <v-icon class="red--text" >mdi-delete</v-icon></v-btn
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
