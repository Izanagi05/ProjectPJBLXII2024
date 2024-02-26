<template>
  <div>
    <v-dialog
      persistent
      v-model="dialogtambahTahun"
      class="rounded-xl"
      max-width="800"
    >
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
    <v-dialog
      persistent
      v-model="dialogEditTahun"
      class="rounded-xl"
      max-width="800"
    >
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
    <v-data-table
      class="rounded-xl"
      :headers="headers"
      :items="getdataAllYears"
    >
      <template v-slot:[`item.aksi`]="{ item }">
        <div class="d-flex">
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

    <v-dialog
      persistent
      v-model="dialogtambahJenisIuran"
      class="rounded-xl"
      max-width="800"
    >
      <v-card class="pa-4 rounded-xl">
        <div class="d-flex justify-end">
          <v-icon
            @click="closeTambahJenisIuran"
            class="text-1 white rounded-xl mb-3"
            >mdi-close</v-icon
          >
        </div>
        <v-row>
          <v-col cols="6">
            <v-checkbox
              v-model="inputTambahJenisIuran.withtagihan"
              label="Tambahkan ke data tagihan semua warga"
              :value="true"
            ></v-checkbox>
          </v-col>
          <v-col cols="6">
            <v-checkbox
              :disabled="!inputTambahJenisIuran.withtagihan"
              v-model="inputTambahJenisIuran.semuabulan"
              label="Terapkan ke semu Bulan?"
              :value="true"
            ></v-checkbox>
          </v-col>

          <v-col cols="6">
            <v-autocomplete
              :disabled="!inputTambahJenisIuran.withtagihan"
              class="rounded-xl"
              v-model="inputTambahJenisIuran.tahun_id"
              :items="getdataAllYears"
              item-text="tahun"
              item-value="tahun_id"
              label="Masukan untuk Tahun berapa"
              clearable
            ></v-autocomplete>
          </v-col>
          <v-col cols="6">
            <v-autocomplete
              :disabled="
                !inputTambahJenisIuran.withtagihan ||
                inputTambahJenisIuran.semuabulan
              "
              class="rounded-xl"
              v-model="inputTambahJenisIuran.bulan_id"
              :items="getdataAlldataAllBulan"
              item-text="nama"
              item-value="bulan_id"
              label="Masukan untuk Bulan apa"
              clearable
            ></v-autocomplete>
          </v-col>
          <v-col cols="6">
            <v-text-field
              clearable
              :rules="[required]"
              label="Masukan Nama Iuran"
              v-model="inputTambahJenisIuran.nama"
            ></v-text-field>
          </v-col>
          <v-col cols="6">
            <v-text-field
              clearable
              :rules="[required]"
              label="Masukan deskripsi Iuran"
              v-model="inputTambahJenisIuran.deskripsi"
            ></v-text-field>
          </v-col>
          <v-col cols="12">
            <v-text-field
              clearable
              :rules="[required]"
              label="Masukan terbilang Iuran"
              type="number"
              v-model="inputTambahJenisIuran.jumlah"
            ></v-text-field>
          </v-col>
        </v-row>

        <div class="d-flex align-center justify-end mt-8">
          <v-btn
            class="rounded-xl px-8 text-capitalize white--text bgbrd-2"
            @click="konfirmTambahJenisIuran"
            >Tambah</v-btn
          >
        </div>
      </v-card>
    </v-dialog>
    <v-dialog
      persistent
      v-model="dialogEditJenisIuran"
      class="rounded-xl"
      max-width="800"
    >
      <v-card class="pa-4 rounded-xl">
        <div class="d-flex justify-end">
          <v-icon
            @click="closeEditJenisIuran"
            class="text-1 white rounded-xl mb-3"
            >mdi-close</v-icon
          >
        </div>
        <v-row>
          <v-col cols="6">
            <v-text-field
              clearable
              :rules="[required]"
              label="Masukan Nama Iuran"
              v-model="inputEditJenisIuran.nama"
            ></v-text-field>
          </v-col>
          <v-col cols="6">
            <v-text-field
              clearable
              :rules="[required]"
              label="Masukan deskripsi Iuran"
              v-model="inputEditJenisIuran.deskripsi"
            ></v-text-field>
          </v-col>
          <v-col cols="12">
            <v-text-field
              clearable
              :rules="[required]"
              label="Masukan terbilang Iuran"
              type="number"
              v-model="inputEditJenisIuran.jumlah"
            ></v-text-field>
          </v-col>
        </v-row>

        <div class="d-flex align-center justify-end mt-8">
          <v-btn
            class="rounded-xl px-8 text-capitalize white--text bgbrd-2"
            @click="konfirmEditJenisIuran"
            >Ubah</v-btn
          >
        </div>
      </v-card>
    </v-dialog>
    <dialoghapusUser
      :dialogVisible="dialogHapusJenisIuran"
      :closehapus="closeHapusJenisIuran"
      :konfrimdelete="konfirmHapusJenisIuran"
    />
    <v-btn
      class="rounded-xl bgbrd-2 text-capitalize my-4 d-flex white--text"
      @click="tambahJenisIuran"
      :disabled="loadingData"
    >
      Tambah Data Jenis Iuran</v-btn
    >
    <v-data-table
      class="rounded-xl"
      :headers="headersIuran"
      :items="getdataAllJenisIurans"
    >
      <template v-slot:[`item.aksi`]="{ item }">
        <div class="d-flex">
          <v-btn
            icon
            @click="EditJenisIuran(item)"
            :disabled="loadingData"
            class="mr-2"
          >
            <v-icon class="green--text">mdi-pencil</v-icon></v-btn
          >
          <v-btn icon @click="HapusJenisIuran(item)" :disabled="loadingData">
            <v-icon class="red--text">mdi-delete</v-icon></v-btn
          >
        </div>
      </template>
    </v-data-table>
  </div>
</template>
<script src="./js/index.js"></script>
