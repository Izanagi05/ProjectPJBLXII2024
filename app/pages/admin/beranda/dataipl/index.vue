<template>
  <div>
    <v-dialog
      persistent
      v-model="dialogTambahTagihan"
      class="rounded-xl"
      max-width="800"
    >
      <v-card class="pa-4 rounded-xl">
        <div class="d-flex justify-end">
          <v-icon
            @click="closetambahTagihan"
            class="text-1 white rounded-xl mb-3"
            >mdi-close</v-icon
          >
        </div>
        <v-row>
          <v-col cols="6">
            <v-checkbox
              v-model="inputTambahTagihan.semuabulan"
              label="Terapkan ke semu Bulan?"
              :value="true"
            ></v-checkbox>
          </v-col>

          <v-col cols="6">
            <v-autocomplete
              class="rounded-xl"
              v-model="inputTambahTagihan.jenis_iuran_id"
              :items="getdataAllJenisIurans"
              item-text="nama"
              item-value="jenis_iuran_id"
              label="Masukan untuk Jenis Iuran"
              clearable
            ></v-autocomplete>
          </v-col>
          <v-col cols="6">
            <v-autocomplete
              class="rounded-xl"
              v-model="inputTambahTagihan.tahun_id"
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
                inputTambahTagihan.semuabulan
              "
              class="rounded-xl"
              v-model="inputTambahTagihan.bulan_id"
              :items="getdataAlldataAllBulan"
              item-text="nama"
              item-value="bulan_id"
              label="Masukan untuk Bulan apa"
              clearable
            ></v-autocomplete>
          </v-col>
        </v-row>

        <div class="d-flex align-center justify-end mt-8">
          <v-btn
            class="rounded-xl px-8 text-capitalize white--text bgbrd-2"
            @click="konfirmTambahTagihan"
            >Tambah Tagihan</v-btn
          >
        </div>
      </v-card>
    </v-dialog>
    <v-dialog
      persistent
      class="rounded-xl dialog-event"
      v-model="dialoginputPembayaranIuran"
      style="box-shadow: 0px"
      max-width="800"
    >
      <v-card
        style="box-shadow: none"
        class="rounded-xl pa-4"
      >
        <div class="d-flex justify-end">
          <v-icon
            @click="closePembayaranIuran"
            class="text-1 white rounded-xl mb-3"
            >mdi-close</v-icon
          >
        </div>
        <p>{{ inputPembayaranIuran?.nama }}</p>
        <p>Bulan {{ inputPembayaranIuran?.bulan?.nama }}</p>
        <p>Jenis Tagihan {{ inputPembayaranIuran?.jenis_iuran?.nama }}</p>
        <p>Terbilang: Rp. {{ inputPembayaranIuran?.jenis_iuran?.jumlah }}</p>
        <v-btn  class="rounded-xl text-capitalize d-flex bgbrd-2 white--text" :disabled="isDisable" @click="konfirmBuatPesanWa()">Kirim Pesan Whatsapp</v-btn>
        <v-text-field
          clearable
          type="number"
          v-model="inputPembayaranIuran.jumlah_pembayaran"
          label="Masukan jumlah tagihan "
        ></v-text-field>
        <div class="d-flex justify-space-between">
          <v-btn
            class="rounded-xl text-capitalize black--text"
            @click="closePembayaranIuran"
          >
            Batal</v-btn
          >
          <v-btn
            class="rounded-xl text-capitalize d-flex bgbrd-2 white--text"
            @click="konfirmPembayaranIuran"
            :disabled="
              inputPembayaranIuran.jumlah_pembayaran
                ? inputPembayaranIuran?.jenis_iuran?.jumlah ==
                  inputPembayaranIuran.jumlah_pembayaran
                  ? false
                  : true
                : true
            "
          >
            Tambah
          </v-btn>
        </div>
      </v-card>
    </v-dialog>
    <v-autocomplete
              class="rounded-xl"
              @input="inputtahun"
              :items="getdataAllYears"
              item-text="tahun"
              item-value="tahun"
              label="Masukan data tahun"
              clearable
            ></v-autocomplete>
    <v-data-table :headers="headers" :items="getDataAllUserTagihan">
      <template v-slot:[`item.tagihan_bulanans`]="{ item }">
        <div>
          <div class="d-flex" style="flex-wrap: wrap">
            <v-card
              flat
              v-for="(tagihan, i) in item.tagihan_bulanans"
              :key="i"
              :class="[
                'mr-4  pa-4 rounded-xl my-4',
                tagihan.status_pembayaran === 'Lunas' ? 'bg-green' : 'bg-red',
              ]"
              @click="dataCookies==='Admin'?
                tagihan.status_pembayaran === 'Lunas'
                  ? sudahlunas()
                  : tambahPembayaranIuran(item, tagihan):nohit()
              "
            >
              <p class="font-weight-medium text-body-1">
                {{ tagihan.bulan.nama }}
              </p>
              <p class="text-caption mb-0">
                Iuran: {{ tagihan.jenis_iuran.nama }}
              </p>
              <p class="text-body-2 mb-0">
                Terbilang Rp. {{ tagihan.jenis_iuran.jumlah }}
              </p>
              <p class="text-body-2">
                Pembayaran:
                <span
                  :class="[
                    'font-weight-bold',
                    tagihan.status_pembayaran === 'Lunas'
                      ? 'green--text'
                      : 'red--text',
                  ]"
                >
                  {{ tagihan.status_pembayaran }}
                </span>
              </p>
              <p class="text-body-2"></p>
            </v-card>
          </div>
          <!-- <v-data-table :headers="headersdua" :items="item.tagihan_bulanans">
            <div>

            </div>
          </v-data-table> -->
        </div>
      </template>
      <template v-if="dataCookies==='Admin'" v-slot:[`item.aksi`]="{ item }">
        <div class="d-flex">
          <v-btn @click="tambahTagihan(item)" class="rounded-xl text-capitalize d-flex bgbrd-2 white--text">Tambah Tagihan</v-btn>
          </div>
      </template>
    </v-data-table>
  </div>
</template>
<script src="./js/index.js"></script>
