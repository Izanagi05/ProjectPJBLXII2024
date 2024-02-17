<template>
  <div style="padding-bottom: 80px;">
    <div>
    <v-dialog v-model="dialogevent" class="rounded-xl dialog-event" style="box-shadow: 0px;" max-width="800"  >
      <v-card style="box-shadow: none" class="rounded-xl bg-whiteblur-card1 pa-4 pb-8">
        <div class="d-flex justify-end">
          <v-icon @click="closedetailevent" class="text-1 white rounded-xl mb-3"
            >mdi-close</v-icon
          >
        </div>
        <div class=" rounded-xl ">
          <v-row class="text-caption grey--text">
            <v-col cols="4">
              <v-img
                :src="require('~/assets/img/beranda/sample.jpg')"
                class="rounded-xl"
                style="height: 100%;"
              ></v-img>
            </v-col>
            <v-col cols="8" class="">
              <div class="pa-6">
                <p class="text-5 text-body-2">Kegiatan</p>
                <p class="text-h6 text-1">Acara potong tumpeng</p>
                <p class="text-body-1 text-1">
                  Dalam rangka menyambut ....
                </p>
                <v-divider></v-divider>
                <div class="d-flex mt-2">
                  <v-icon>mdi-address</v-icon>
                  <p class="text-caption text-1 mb-0">
                    Jl.Jalak Bali No.4 Blok Z 7
                  </p>
                </div>
              </div>
            </v-col>
          </v-row>
          <p class="text-h5 mt-4 text-1">Detail Event</p>
          <p class="text-1">Tanggal dan waktu</p>
          <v-text-field  hide-details  outlined class="rounded-lg" v-model="event.tanggal" prepend-innder-icon="mdi-calendar-range"></v-text-field>
          <div class="d-flex align-center mt-6">

            <v-text-field hide-details  outlined class="rounded-lg" v-model="event.tanggal" prepend-innder-icon="mdi-clock-time-eight-outline"></v-text-field>
            <v-icon class="text-1 mx-2 pa-4" >mdi-arrow-right</v-icon>
            <v-text-field  hide-details  outlined class="rounded-lg" v-model="event.tanggal" ></v-text-field>
          </div>
        </div>
      </v-card>
    </v-dialog>
      <p class="text-h6 font-weight-medium text-1" style="position: relative;">Event</p>
      <v-card @click="dialogevent=true"
      class="pa-4 bg-whiteblur-card1 rounded-xl d-flex align-center justify-space-between "
    >
      <div class="d-flex  align-center">
        <div class="line-event bg-2 mr-2 rounded-xl"></div>
        <div class="rounded-xl transparent py-4 px-6 mr-4">
          <p class="text-h5 font-weight-medium text-1 mb-0">12</p>
          <p class="text-body-2 text-1 font-weight-medium mb-0">May</p>
        </div>

        <div class="mr-4">
          <p class="text-body-1 font-weight-medium mb-0">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil,
            reiciendis.
          </p>
          <p class="text-body-2 text-1 mb-0">Jl Nks, Blok S No.4</p>
        </div>
      </div>
      <p class="text-body-1 font-weight-medium mb-0 text-5">3 Hari lagi</p>
    </v-card>
  </div>
</div>
</template>
<script src="./js/index.js"></script>
<style >
.line-event {
  height: 100px;
  width: 4px;
  background: #0E6AE3 !important;
}
.dialog-event{
  box-shadow: none;
  background: transparent;
}
</style>
