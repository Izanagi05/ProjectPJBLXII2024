<template>
  <div>
    <v-dialog
      persistent
      class="rounded-xl dialog-event"
      v-model="dialogtambah"
      style="box-shadow: 0px"
      max-width="600"
    >
      <v-card
        style="box-shadow: none"
        class="rounded-xl bg-whiteblur-card1 pa-4"
      >
        <div class="d-flex justify-end">
          <v-icon @click="closetambah" class="text-1 white rounded-xl mb-3"
            >mdi-close</v-icon
          >
        </div>
        <v-row>
          <v-col cols="12">
            <v-text-field
              clearable
              :rules="[required]"
              label="Nama"
            ></v-text-field>
          </v-col>
          <v-col lg="5">
            <v-select
              v-model="selectedProvince"
              :items="provinceOptions"
              label="Tempat Lahir"
              :rules="selectRules"
            ></v-select>
          </v-col>
          <v-col lg="7">
            <v-dialog
              ref="dialog"
              v-model="modal"
              :return-value.sync="date"
              persistent
              width="290px"
            >
              <template v-slot:activator="{ on, attrs }">
                <v-text-field
                  v-model="date"
                  label="Tanggal Lahir"
                  prepend-icon="mdi-calendar"
                  readonly
                  :rules="[required]"
                  clearable
                  v-bind="attrs"
                  v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker v-model="date" scrollable>
                <v-spacer></v-spacer>
                <v-btn text color="primary" @click="modal = false">
                  Cancel
                </v-btn>
                <v-btn text color="primary" @click="$refs.dialog.save(date)">
                  OK
                </v-btn>
              </v-date-picker>
            </v-dialog>
          </v-col>
          <v-col cols="12">
            <v-text-field
              clearable
              type="number"
              :rules="[required]"
              label="Nik"
            ></v-text-field>
          </v-col>
          <v-col cols="7">
            <v-text-field
              label="Telepon"
              clearable
              :rules="[required]"
              type="number"
            ></v-text-field>
          </v-col>
          <v-col cols="5">
            <v-select
              :rules="selectRules"
              v-model="selectedGender"
              :items="genderOptions"
              label="Jenis Kelamin"
            ></v-select>
          </v-col>
          <v-col cols="6">
            <v-file-input
              clearble
              label="Foto KK"
              prepend-icon="mdi-image-outline"
            ></v-file-input>
          </v-col>
          <v-col cols="6">
            <v-file-input
              clearble
              label="Foto KTP"
              prepend-icon="mdi-image-outline"
            ></v-file-input>
          </v-col>
        </v-row>

        <div class="d-flex justify-end">
          <v-btn
            class="rounded-xl bg-2 text-capitalize mt-2 d-flex white--text"
            @click="konfirmtambah"
          >
            Simpan</v-btn
          >
        </div>
      </v-card>
    </v-dialog>
    <v-dialog
      persistent
      class="rounded-xl dialog-event"
      v-model="dialogedit"
      style="box-shadow: 0px"
      max-width="600"
    >
      <v-card
        style="box-shadow: none"
        class="rounded-xl bg-whiteblur-card1 pa-4"
      >
        <div class="d-flex justify-end">
          <v-icon @click="closeedit" class="text-1 white rounded-xl mb-3"
            >mdi-close</v-icon
          >
        </div>
        <v-row>
          <v-col cols="12">
            <v-text-field
              clearable
              :rules="[required]"
              label="Nama"
            ></v-text-field>
          </v-col>
          <v-col lg="5">
            <v-select
              v-model="selectedProvince"
              :items="provinceOptions"
              label="Tempat Lahir"
              :rules="selectRules"
            ></v-select>
          </v-col>
          <v-col lg="7">
            <v-dialog
              ref="dialog"
              v-model="modal"
              :return-value.sync="date"
              persistent
              width="290px"
            >
              <template v-slot:activator="{ on, attrs }">
                <v-text-field
                  v-model="date"
                  label="Tanggal Lahir"
                  prepend-icon="mdi-calendar"
                  readonly
                  :rules="[required]"
                  clearable
                  v-bind="attrs"
                  v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker v-model="date" scrollable>
                <v-spacer></v-spacer>
                <v-btn text color="primary" @click="modal = false">
                  Cancel
                </v-btn>
                <v-btn text color="primary" @click="$refs.dialog.save(date)">
                  OK
                </v-btn>
              </v-date-picker>
            </v-dialog>
          </v-col>
          <v-col cols="12">
            <v-text-field
              clearable
              type="number"
              :rules="[required]"
              label="Nik"
            ></v-text-field>
          </v-col>
          <v-col cols="7">
            <v-text-field
              label="Telepon"
              clearable
              :rules="[required]"
              type="number"
            ></v-text-field>
          </v-col>
          <v-col cols="5">
            <v-select
              :rules="selectRules"
              v-model="selectedGender"
              :items="genderOptions"
              label="Jenis Kelamin"
            ></v-select>
          </v-col>
          <v-col cols="6">
            <v-file-input
              clearble
              label="Foto KK"
              prepend-icon="mdi-image-outline"
            ></v-file-input>
          </v-col>
          <v-col cols="6">
            <v-file-input
              clearble
              label="Foto KTP"
              prepend-icon="mdi-image-outline"
            ></v-file-input>
          </v-col>
        </v-row>

        <div class="d-flex justify-end">
          <v-btn
            class="rounded-xl bg-2 text-capitalize mt-2 d-flex white--text"
            @click="konfirmedit"
          >
            Ubah</v-btn
          >
        </div>
      </v-card>
    </v-dialog>
    <p
      class="text-h5 text-1 font-weight-medium"
      style="position: relative; z-index: 8"
    >
      Tambah Data
    </p>
    <v-btn
      class="rounded-xl bg-2 text-capitalize my-4 d-flex white--text"
      @click="tambah"
    >
      Tambah Data</v-btn
    >
    <v-data-table :headers="headers" class="bg-whiteblur-card1"></v-data-table>
  </div>
</template>
<script src="./js/index.js"></script>
