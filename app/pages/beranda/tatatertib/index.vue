<template>
  <div style="padding-bottom: 80px;">
    <p
    class="text-h5 text-1 font-weight-medium"
    style="position: relative; z-index: 8"
    >
    Tata Tertib
  </p>
  <v-divider></v-divider>
  <v-row>
    <v-col
        v-for="(item, index) in getAllTatib"
        :key="index"
        lg="4"
        md="4"
      >
        <v-card :class="['pa-6 mr-4   rounded-xl bg-whiteblur-card1']">
          <div class="d-flex justify-space-between align-center">
            <v-icon>mdi-flag-outline</v-icon>
          </div>
          <p class="mb-0 text-h6 text-1 font-weight-medium">{{ item.judul }}</p>
          <p class="text-body-1 text-1">{{ item.deskripsi }}</p>
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>
<script src="./js/index.js"></script>
