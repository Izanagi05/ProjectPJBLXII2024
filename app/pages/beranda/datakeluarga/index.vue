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

    <p
      class="text-h5 text-1 font-weight-medium"
      style="position: relative; z-index: 8"
    >
      Tambah Data
    </p>
    <v-btn
      class="rounded-xl bg-2 text-capitalize my-4 d-flex white--text"
      @click="tambah"  :disabled="loadingData"
    >
      Tambah Data</v-btn
    >
    <div class="d-flex" style="overflow-x: scroll; width: 100%">
      <div
        v-for="(dtlalamat) in getDataAllWargaAlamat?.detail_alamats"
        :key="dtlalamat?.detail_alamat_id"
        style="min-width: 100%"
        class="mr-4"
      >
        <p class="font-weight-medium text-body-1 black--text" style="position: relative;">
          Warga {{ dtlalamat?.nama }}, {{ dtlalamat?.alamat?.nama }}
        </p>
        <v-data-table
          style="min-width: 100%"
          :headers="headers"
          :items="dtlalamat?.wargas"
          class="bg-whiteblur-card1 rounded-xl"
        >
          <template v-slot:[`item.fotoktp`]="{ item }">
            <div>
              <div class="image-container">
                <v-img
                  :src="'http://127.0.0.1:8000/storage/' + item?.foto_ktp"
                  width="80%"
                  height="80%"
                ></v-img>
              </div>
            </div>
          </template>
          <template v-slot:[`item.fotokk`]="{ item }">
            <div>
              <div class="image-container">
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
              <v-btn icon @click="hapuswarga(item)">
                <v-icon class="red--text"  :disabled="loadingData">mdi-delete</v-icon></v-btn
              >
            </div>
          </template>
        </v-data-table>
      </div>
    </div>
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
