<template>
  <div>
    <div class="d-inline-flex">
      <v-card
        v-for="(item, index) in cardData"
        :key="index"
        width="300"
        :class="['pa-6 mr-4 bgbrd-2  rounded-xl', item.bgClass]"
      >
        <div class="d-flex align-center justify-space-between">
          <div class="mr">
            <p class="text-h4 font-weight-medium mb-2 white--text">
              {{ item.count }}
            </p>
            <p class="text-body-1 white--text mb-0">{{ item.title }}</p>
          </div>
          <div style="width: 80px">
            <v-img :src="require(`~/assets/icon/${item.logo}.svg`)"></v-img>
          </div>
        </div>
      </v-card>
    </div>
  </div>
</template>
<script src="./js/index.js"></script>
