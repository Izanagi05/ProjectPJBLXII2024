<template>
  <div>
    <div
      class="d-inline-flex"
      style="width: 100%; overflow-x: scroll; overflow-y: hidden"
    >
      <v-card
        v-for="(item, index) in getjumlahWargaAndTransaksiAndLaporan"
        :key="index"
        width="300"
        :class="['pa-6 mr-4 bgbrd-2  rounded-xl', item.bgClass]"
      >
        <div class="d-flex align-center justify-space-between">
          <div class="mr">
            <p class="text-h4 font-weight-medium mb-2 white--text">
              {{ item.count }}
            </p>
            <p class="text-body-1 white--text mb-0">{{ item.key }}</p>
          </div>
          <div style="width: 80px">
            <v-img :src="require(`~/assets/icon/${item.icon}.svg`)"></v-img>
          </div>
        </div>
      </v-card>
    </div>
    <div class="mt-6" v-if="dataCookies === 'Admin RW'">
      <p class="text-h6 ">Data Alamat</p>
      <v-dialog v-model="dialogTambahAlamat" max-width="800">
        <v-card class="pa-4 rounded-xl">
          <div class="d-flex justify-end">
            <v-icon
              @click="closetambahAlamat"
              class="text-1 white rounded-xl mb-3"
              >mdi-close</v-icon
            >
          </div>
          <v-text-field
            clearable
            :rules="[required]"
            v-model="inputTambahAlamat.nama"
            label="Masukan Nama Alamat"
          ></v-text-field>
          <v-autocomplete
            class="rounded-xl"
            v-model="inputTambahAlamat.rt_id"
            :items="getdataAllRt"
            item-text="rt"
            item-value="rt_id"
            label="Masukan RT"
            clearable
          ></v-autocomplete>
          <div class="d-flex pt-4 justify-space-between mt-8 align-center">
            <v-btn
              class="rounded-xl text-capitalize black--text"
              @click="closetambahAlamat"
            >
              Batal</v-btn
            >
            <v-btn
              class="rounded-xl px-8 text-capitalize white--text bgbrd-2"
              @click="konfirmtambahAlamat"
              >Tambah</v-btn
            >
          </div>
        </v-card>
      </v-dialog>
      <v-dialog v-model="dialogUpdateAlamat" max-width="800">
        <v-card class="pa-4 rounded-xl">
          <div class="d-flex justify-end">
            <v-icon
              @click="closeEditAlamat"
              class="text-1 white rounded-xl mb-3"
              >mdi-close</v-icon
            >
          </div>
          <v-text-field
            clearable
            :rules="[required]"
            v-model="inputEditAlamat.nama"
            label="Masukan Nama Alamat"
          ></v-text-field>
          <v-autocomplete
            class="rounded-xl"
            v-model="inputEditAlamat.rt_id"
            :items="getdataAllRt"
            item-text="rt"
            item-value="rt_id"
            label="Masukan RT"
            clearable
          ></v-autocomplete>
          <div class="d-flex pt-4 justify-space-between mt-8 align-center">
            <v-btn
              class="rounded-xl text-capitalize black--text"
              @click="closeEditAlamat"
            >
              Batal</v-btn
            >
            <v-btn
              class="rounded-xl px-8 text-capitalize white--text bgbrd-2"
              @click="konfirmEditAlamat"
              >Ubah</v-btn
            >
          </div>
        </v-card>
      </v-dialog>
      <dialoghapusUser
        :dialogVisible="dialogHapusAlamat"
        :closehapus="closeHapusAlamat"
        :konfrimdelete="konfirmHapusAlamat"
      />
      <v-btn
        v-if="dataCookies === 'Admin RW'"
        class="rounded-xl bgbrd-2 text-capitalize my-4 d-flex white--text"
        @click="tambahAlamat"
        :disabled="loadingData"
      >
        Tambah Data Alamat</v-btn
      >
      <v-data-table
        class="rounded-xl"
        :headers="headerAlamat"
        :items="getdataAllAlamat"
      >
        <template v-slot:[`item.aksi`]="{ item }">
          <div class="d-flex">
            <v-btn
              icon
              @click="EditAlamat(item)"
              :disabled="loadingData"
              class="mr-2"
            >
              <v-icon class="green--text">mdi-pencil</v-icon></v-btn
            >
            <v-btn icon @click="HapusAlamat(item)" :disabled="loadingData">
              <v-icon class="red--text">mdi-delete</v-icon></v-btn
            >
          </div>
        </template>
      </v-data-table>
    </div>
    <div class="mt-6 "  v-if="dataCookies === 'Admin RW'">
      <p class="text-h6 ">Data Detail Alamat</p>
      <v-dialog v-model="dialogTambahDetailAlamat" max-width="800">
        <v-card class="pa-4 rounded-xl">
          <div class="d-flex justify-end">
            <v-icon
              @click="closetambahDetailAlamat"
              class="text-1 white rounded-xl mb-3"
              >mdi-close</v-icon
            >
          </div>
          <v-text-field
            clearable
            :rules="[required]"
            v-model="inputTambahDetailAlamat.nama"
            label="Masukan Nama Detail Alamat"
          ></v-text-field>
          <v-autocomplete
            class="rounded-xl"
            v-model="inputTambahDetailAlamat.alamat_id"
            :items="getdataAllAlamat"
            item-text="nama"
            item-value="alamat_id"
            label="Masukan Alamat"
            clearable
          ></v-autocomplete>
          <div class="d-flex pt-4 justify-space-between mt-8 align-center">
            <v-btn
              class="rounded-xl text-capitalize black--text"
              @click="closetambahDetailAlamat"
            >
              Batal</v-btn
            >
            <v-btn
              class="rounded-xl px-8 text-capitalize white--text bgbrd-2"
              @click="konfirmtambahDetailAlamat"
              >Tambah</v-btn
            >
          </div>
        </v-card>
      </v-dialog>
      <v-dialog v-model="dialogUpdateDetailAlamat" max-width="800">
        <v-card class="pa-4 rounded-xl">
          <div class="d-flex justify-end">
            <v-icon
              @click="closeEditDetailAlamat"
              class="text-1 white rounded-xl mb-3"
              >mdi-close</v-icon
            >
          </div>
          <v-text-field
            clearable
            :rules="[required]"
            v-model="inputEditDetailAlamat.nama"
            label="Masukan Nama Detail Alamat"
          ></v-text-field>
          <v-autocomplete
            class="rounded-xl"
            v-model="inputEditDetailAlamat.alamat_id"
            :items="getdataAllAlamat"
            item-text="nama"
            item-value="alamat_id"
            label="Masukan Alamat"
            clearable
          ></v-autocomplete>
          <div class="d-flex pt-4 justify-space-between mt-8 align-center">
            <v-btn
              class="rounded-xl text-capitalize black--text"
              @click="closeEditDetailAlamat"
            >
              Batal</v-btn
            >
            <v-btn
              class="rounded-xl px-8 text-capitalize white--text bgbrd-2"
              @click="konfirmEditDetailAlamat"
              >Ubah</v-btn
            >
          </div>
        </v-card>
      </v-dialog>
      <dialoghapusUser
        :dialogVisible="dialogHapusDetailAlamat"
        :closehapus="closeHapusDetailAlamat"
        :konfrimdelete="konfirmHapusDetailAlamat"
      />
      <v-btn
        v-if="dataCookies === 'Admin RW'"
        class="rounded-xl bgbrd-2 text-capitalize my-4 d-flex white--text"
        @click="tambahDetailAlamat"
        :disabled="loadingData"
      >
        Tambah Data Detail Alamat</v-btn
      >
      <v-data-table
        class="rounded-xl"
        :headers="headerDetailAlamat"
        :items="getdataAllDetailAlamat"
      >
        <template v-slot:[`item.aksi`]="{ item }">
          <div class="d-flex">
            <v-btn
              icon
              @click="EditDetailAlamat(item)"
              :disabled="loadingData"
              class="mr-2"
            >
              <v-icon class="green--text">mdi-pencil</v-icon></v-btn
            >
            <v-btn
              icon
              @click="HapusDetailAlamat(item)"
              :disabled="loadingData"
            >
              <v-icon class="red--text">mdi-delete</v-icon></v-btn
            >
          </div>
        </template>
      </v-data-table>
    </div>
  </div>
</template>
<script src="./js/index.js"></script>
