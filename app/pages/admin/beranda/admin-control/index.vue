<template>
  <div>
    <dialoghapusUser
      :dialogVisible="dialoghapus"
      :closehapus="closehapus"
      :konfrimdelete="konfirmasihapus"
    />
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
          <v-col>
            <v-autocomplete
          class="rounded-xl"
          v-model="inputTambah.admin_role_id"
          :items="getAdminDataRoles"
          item-text="nama"
          item-value="admin_role_id"
          label="Masukan Role Admin"
          clearable
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
    <v-dialog v-model="dialogubahPass" max-width="600px" persistent>
      <v-card class="pa-10 rounded-xl">
        <div class="d-flex justify-end mb-4">
          <v-icon class="text-2" @click="closeUbahPass"> mdi-close </v-icon>
        </div>
        <div class="text-h6 mb-2 font-weight-medium text-2">
          Apakah kamu yakin ingin mengubah?
        </div>
        <div class="text-body-2 grey--text">
          Item ini akan diubah setelah anda masukan password baru
        </div>
        <div class="mt-4">
          <v-text-field
            :readonly="loading"
            :rules="[required]"
            :append-icon="lihat ? 'mdi-eye' : 'mdi-eye-off'"
            :type="lihat ? 'text' : 'password'"
            clearable
            @click:append="lihat = !lihat"
            v-model="adminDataDialog.new_password"
            label="Masukan Password baru"
          ></v-text-field>
          <v-text-field
            :readonly="loading"
            :rules="[required]"
            :append-icon="lihat2 ? 'mdi-eye' : 'mdi-eye-off'"
            :type="lihat2 ? 'text' : 'password'"
            clearable
            @click:append="lihat2 = !lihat2"
            v-model="adminDataDialog.confirm_password"
            label="Konfirmasi password"
          ></v-text-field>
        </div>
        <div class="d-flex align-center justify-end mt-8">
          <v-btn
            class="rounded-xl text-capitalize white px-8 mr-4"
            @click="closeUbahPass"
            >Batal</v-btn
          >
          <v-btn
            class="rounded-xl px-8 text-capitalize white--text bgbrd-2"
            @click="konfirmubah"
            >Ubah</v-btn
          >
        </div>
      </v-card>
    </v-dialog>
    <v-container>
      <v-row>
        <v-col cols="6">
          <v-btn
            class="rounded-xl bgbrd-2 text-capitalize my-4 d-flex white--text"
            @click="tambah"
            :disabled="loadingData"
          >
            Tambah Data</v-btn
          >
        </v-col>
        <v-col cols="6">
          <v-text-field
            v-model="cari"
            @input="debouncingcari"
            label="cari data"
          ></v-text-field>
        </v-col>
      </v-row>
      <v-data-table
        :headers="headers"
        :items="getadminDataControl"
        class="rounded-xl"
      >
        <template v-slot:[`item.user_data.status`]="{ item }">
          <div class="">
            <div
              :class="[
                '',
                item.user_data.status === 'Online'
                  ? 'font-weight-medium green--text'
                  : 'grey--text',
              ]"
            >
              {{ item.user_data.status }}
            </div>
          </div>
        </template>
        <template v-slot:[`item.ubah_pass`]="{ item }">
          <div class="" v-if="getDataUser?.user_id !== item?.user_id">
            <v-btn
              class="bgbrd-2 text-capitalize rounded-xl white--text"
              small
              @click="ubahPass(item)"
              >Ubah Password</v-btn
            >
          </div>
        </template>
        <template v-slot:[`item.action`]="{ item }">
          <div
            class="d-flex align-center justify-center"
            v-if="getDataUser?.user_id !== item?.user_id"
          >
            <v-btn icon small color="#ff5252" @click="hapus(item)"
              ><v-icon>mdi-trash-can-outline</v-icon></v-btn
            >
          </div>
        </template>
      </v-data-table>
    </v-container>
  </div>
</template>
<script src="./js/index.js"></script>
