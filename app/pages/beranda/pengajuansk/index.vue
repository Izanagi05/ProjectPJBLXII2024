<template>
  <div style="padding-bottom: 80px">
    <dialoghapusUser
      :dialogVisible="dialogHapus"
      :closehapus="closehapus"
      :konfrimdelete="konfirmhapuspengajuan"
    />
    <v-dialog v-model="dialogTambah">
      <v-card :class="['pa-6 mr-4   rounded-xl bg-whiteblur-card1']">
        <div class="d-flex justify-end">
          <v-icon @click="closetambah" class="text-1 white rounded-xl mb-3"
            >mdi-close</v-icon
          >
        </div>
        <p
          class="text-h5 text-1 font-weight-medium"
          style="position: relative; z-index: 8"
        >
          Buat Surat Pengantar
        </p>
        <v-row>
          <v-col cols="6">
            <v-autocomplete
              class="rounded-xl"
              v-model="inputLaporan.detail_alamat_id_and_alamat_id"
              :items="detail_alamat_pilihan"
              label="Masukan alamat "
              item-text="concetdatalamat"
              item-value="detail_alamat_id_and_alamat_id"
              clearable
            ></v-autocomplete
          ></v-col>
          <v-col cols="12">
            <v-textarea
              :rules="[required]"
              v-model="inputLaporan.keperluan"
              label="Keperluan"
            ></v-textarea>
          </v-col>
          <v-col cols="12" class="d-flex justify-end">
            <v-btn
              class="rounded-xl bg-2 text-capitalize mt-2 d-flex white--text"
              @click="konfirmpengajuan"
            >
              Buat Laporan</v-btn
            >
          </v-col>
        </v-row>
      </v-card></v-dialog
    >
    <v-dialog v-model="dialogEdit">
      <v-card :class="['pa-6 mr-4   rounded-xl bg-whiteblur-card1']">
        <div class="d-flex justify-end">
          <v-icon @click="closeedit" class="text-1 white rounded-xl mb-3"
            >mdi-close</v-icon
          >
        </div>
        <p
          class="text-h5 text-1 font-weight-medium"
          style="position: relative; z-index: 8"
        >
          Edit Surat Pengantar
        </p>
        <v-row>
          <v-col cols="6">
            <v-autocomplete
              class="rounded-xl"
              v-model="inputEditLaporan.detail_alamat_id_and_alamat_id"
              :items="detail_alamat_pilihan"
              label="Masukan alamat "
              item-text="concetdatalamat"
              item-value="detail_alamat_id_and_alamat_id"
              clearable
            ></v-autocomplete
          ></v-col>
          <v-col cols="12">
            <v-textarea
              :rules="[required]"
              v-model="inputEditLaporan.keperluan"
              label="Keperluan"
            ></v-textarea>
          </v-col>
          <v-col cols="12" class="d-flex justify-end">
            <v-btn
              class="rounded-xl bg-2 text-capitalize mt-2 d-flex white--text"
              @click="konfirmeditpengajuan"
            >
              Edit Laporan</v-btn
            >
          </v-col>
        </v-row>
      </v-card></v-dialog
    >
    <v-dialog
      class="rounded-xl dialog-event"
      v-model="dialoglaporan"
      persistent
      style="box-shadow: 0px"
      max-width="600"
    >
      <v-card
        style="box-shadow: none"
        class="rounded-xl bg-whiteblur-card1 py-10 px-8"
      >
        <div class="d-flex justify-end">
          <v-icon
            @click="closelaporanexport"
            class="text-1 white rounded-xl mb-3"
            >mdi-close</v-icon
          >
        </div>
        <div class="mt-6 mb-10">
          <div class="text-h5 font-weight-medium">
            Pilih alamat untuk data laporan
          </div>
          <v-autocomplete
            class="rounded-xl"
            v-model="dataLaporanexport.detail_alamat_id_and_alamat_id"
            :items="detail_alamat_pilihan"
            label="Masukan alamat "
            item-text="concetdatalamat"
            item-value="detail_alamat_id_and_alamat_id"
            clearable
          ></v-autocomplete>
        </div>
        <div class="d-flex justify-space-between">
          <v-btn
            class="rounded-xl text-capitalize black--text"
            @click="closelaporanexport"
          >
            Batal</v-btn
          >
          <v-btn
            class="rounded-xl text-capitalize d-flex red white--text"
            @click="konfirmexportlaporan"
            :disabled="
              dataLaporanexport.detail_alamat_id_and_alamat_id ? false : true
            "
          >
            Unduh
          </v-btn>
        </div>
      </v-card>
    </v-dialog>
    <v-btn
      class="rounded-xl bg-2 text-capitalize my-4 d-flex white--text"
      @click="tambahlaporan"
      :disabled="loadingData"
    >
      Tambah Data</v-btn
    >
    <v-data-table
      style="min-width: 100%"
      :headers="headers"
      :items="getDataAllLaporan?.user_laporans"
      class="bg-whiteblur-card1 rounded-xl"
    >
      <template v-slot:[`item.aksi`]="{ item }">
        <div class="d-flex">
          <v-btn
            icon
            @click="editlaporan(item)"
            :disabled="loadingData"
            class="mr-2"
          >
            <v-icon class="green--text">mdi-pencil</v-icon></v-btn
          >
          <v-btn icon @click="hapuslaporan(item)" :disabled="loadingData">
            <v-icon class="red--text">mdi-delete</v-icon></v-btn
          >
          <v-btn
            @click="exportlaporan(item)"
            class="text-capitalize red rounded-xl"
          >
            <v-icon class="white--text mr-1">mdi-file-pdf-box</v-icon>
            Simpan PDF
          </v-btn>
        </div>
      </template>
    </v-data-table>
  </div>
</template>
<script src="./js/index.js"></script>
