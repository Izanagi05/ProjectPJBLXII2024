<template>
  <div>
    <dialoghapusUser
      :dialogVisible="dialogDelete"
      :closehapus="closeDelete"
      :konfrimdelete="konfirmDelete"
    />
    <v-dialog v-model="dialogEditGroup" class=" rounded-xl" max-width="800">
      <v-card class="pa-4 rounded-xl">
        <div class="d-flex justify-end">
          <v-icon
            @click="closeEdit"
            class="text-1 white rounded-xl mb-3"
            >mdi-close</v-icon
          >
        </div>
          <v-autocomplete
            class="rounded-xl"
            v-model="inputEdit.izin"
            :items="dataIzin"
            item-text="key"
            item-value="value"
            label="Ubah status Izin "
            clearable
          ></v-autocomplete>
          <v-autocomplete
            class="rounded-xl"
            v-model="inputEdit.rt_id"
            :items="getdataAllRt"
            item-text="rt"
            item-value="rt_id"
            label="Pilih Rt "
            clearable
          ></v-autocomplete>
          <div class="d-flex align-center justify-end mt-8">
          <v-btn
            class="rounded-xl px-8 text-capitalize white--text bgbrd-2"
            @click="konfirmEdit"
            >Ubah</v-btn
          >
        </div>
      </v-card>
    </v-dialog>
    <v-dialog v-model="dialogKirimPesanGroup" class=" rounded-xl" max-width="800">
      <v-card class="pa-4 rounded-xl">
        <div class="d-flex justify-end">
          <v-icon
            @click="closeKirimPesanGroup"
            class="text-1 white rounded-xl mb-3"
            >mdi-close</v-icon
          >
        </div>
          <v-text-field
          clearable
          :rules="[required]"
          v-model="inputKirimPesanGroup.message"
          label="Masukan Pesan"
          ></v-text-field>
          <div class="d-flex align-center justify-end mt-8">
          <v-btn
            class="rounded-xl px-8 text-capitalize white--text bgbrd-2"
            @click="konfirmKirimPesanGroup"
            >Kirim</v-btn
          >
        </div>
      </v-card>
    </v-dialog>
<v-data-table class="rounded-xl" :headers="header" :items="getadminAllGroup">
  <template v-slot:[`item.aksi`]="{ item }">
        <div class="d-flex">
          <v-btn
            icon
            @click="editGroup(item)"
            :disabled="loadingData"
            class="mr-2"
          >
            <v-icon class="green--text">mdi-pencil</v-icon></v-btn
          >
          <v-btn
            icon
            @click="kirimPesanGroup(item)"
            :disabled="loadingData"
            class=""
          >
            <v-icon class="blue--text">mdi-message-text-fast-outline</v-icon></v-btn
          >
          <v-btn
            icon
            @click="deleteGroup(item)"
            :disabled="loadingData"
            class=""
          >
            <v-icon class="red--text">mdi-delete</v-icon></v-btn
          >
        </div>
      </template>
</v-data-table>
  </div>
</template>

<script src="./js/index.js"></script>
