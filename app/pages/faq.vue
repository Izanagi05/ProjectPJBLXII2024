<template>
  <div>
    <navbar-beranda   v-if="dataCookies"/>
    <navbar-landing  v-if="!dataCookies"/>
    <div class="bg-2" style="height: 50vh">
      <v-container style="height: 100%;position: relative;">
        <div class="d-flex align-center justify-center" style="height: 100%">
          <div class="">
            <p
              :class="[
                'mb-4 font-weight-medium text-center  white--text',
                $vuetify.breakpoint.smAndDown ? 'text-h5' : 'text-h4',
              ]"
            >
              Bagaimana kami bisa membantu anda?
            </p>
          </div>
        </div>
      </v-container>
    </div>
    <div class="bg-1 py-10">
      <v-container>
        <v-row style="position: relative;">
          <div class="gradient6"></div>
          <v-col

            v-for="(item, index) in cardData"
            :key="index"
            cols="12"

            :lg="item.col" :md="item.col" sm="12" xs="12"
          >
            <v-card class="pa-10 rounded-xl py-10 bg-whiteblur  mr-lg-8 mr-md-8" >
              <div class="d-flex align-center" style="z-index: 9;">
                <v-icon x-large :color="item.iconColor" class="mr-4">{{
                  item.icon
                }}</v-icon>
                <div style="z-index: 9;">
                  <p class="text-body-1 text-1 mb-0 font-weight-medium">
                    {{ item.title }}
                  </p>
                  <p class="text-body-2 text-1">{{ item.description }}</p>
                </div>
              </div>
            </v-card>
          </v-col>
        </v-row>
        <p
          :class="[
            'my-8 font-weight-medium text-center  text-1',
            $vuetify.breakpoint.smAndDown ? 'text-h6' : 'text-h5',
          ]"
        >
          Pertanyaan yang sering ditanyakan
        </p>
        <v-expansion-panels accordion class="mt-4">
          <v-expansion-panel
            v-for="(item, index) in expansionPanelData"
            :key="index"
            class="mt-2 rounded-xl text-1 bg-whiteblur"
          >
            <v-expansion-panel-header class="font-weight-medium">{{
              item.header
            }}</v-expansion-panel-header>
            <v-expansion-panel-content>
              {{ item.content }}
            </v-expansion-panel-content>
          </v-expansion-panel>
        </v-expansion-panels>
        <p
          :class="[
            'mt-8 mb-4 font-weight-medium text-center  text-1',
            $vuetify.breakpoint.smAndDown ? 'text-h6' : 'text-h5',
          ]"
        >
          Belum menemukan jawaban?
        </p>
        <p class="text-body-1 text-center text-1">
          Jangan lupa hubungi tim pengembang kami dibawah ini
        </p>
        <v-row class=" align-center justify-center" >
          <v-col cols="6" lg="auto" v-for="(dt, i) in datacontact" :key="i" class="" style="z-index: 9;">
            <div class="d-flex align-center justify-center">
              <v-avatar size="80" class="">
                <v-img :src="require('~/assets/img/' + dt.image)" style="background-position: top;"></v-img>
              </v-avatar>
            </div>
            <div  class="text-body-2 text-center text-1 font-weight-medium">
              {{ dt.name }}
            </div>
            <div class="text-caption text-center text-1">{{ dt.mail }}</div>
          </v-col>
        </v-row>
        <div class="d-flex justify-center">
          <v-btn style="z-index: 9;"
            class="rounded-xl bg-whiteblur text-1 mt-8 text-capitalize"
            to="/kontak"
            >Kontak kami</v-btn
          >
        </div>
        <div class="gradient7"></div>
      </v-container>
    </div>
    <BottomNavigation v-if="dataCookies" />
    <Footer />
  </div>
</template>
<script src="./js/faq.js"></script>
