<template>
  <div >
    <div >
    <v-row class="justify-center">
      <v-col
        cols="6"
        lg="3"
        md="3"
        sm="6"
        xs="6"
        v-for="(item, index) in cardData"
        :key="index"
        ><v-card
          :class="['pa-6 mr-4   rounded-xl bg-whiteblur-card1']"
          :style="{ height: '100%'}"
          :to="item.rute"
        >
          <div class="align-center justify-space-between">
            <div class="d-flex justify-center">
              <div style="width: 80px" class="">
                <v-img
                  :src="require(`~/assets/iconuser/${item.icon}.svg`)"
                ></v-img>
              </div>
            </div>
            <div class="mt-4">
              <p
                class="text-h6 text-center font-weight-medium mb-2"
              >
              <!-- <p
                class="text-h6 text-center font-weight-medium mb-2" :style="{color: item.bgClass + ' !important' }"
              > -->
                {{ item.judul }}
              </p>
              <p class="text-body-1 text-center FF74A0--text mb-0" >
              <!-- <p class="text-body-1 text-center FF74A0--text mb-0" :style="{color: item.bgClass + ' !important' }"> -->
                {{ item.deskripsi }}
              </p>
            </div>
          </div>
        </v-card>
      </v-col>
    </v-row>
  </div>
  </div>
</template>
<script src="./js/index.js"></script>
