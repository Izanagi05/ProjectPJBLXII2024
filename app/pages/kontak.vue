<template>
  <div>
    <navbar-landing />
    <div class="bg-2" style="height: 100vh">
      <v-container style="height: 100%">
        <div class="d-flex align-center justify-center" style="height: 100%">
          <div class="">
            <p
              :class="[
                'mb-4 font-weight-medium text-center  white--text',
                $vuetify.breakpoint.smAndDown ? 'text-h5' : 'text-h4',
              ]"
            >
              Hubungi Kami
            </p>

            <v-img
              class=""
              :src="require('~/assets/img/landingimage4.png')"
              :max-width="$vuetify.breakpoint.smAndDown ? '250' : '300'"
            />
            <a
              href="https://storyset.com/business"
              target="_blank"
              class="text-caption white--text"
              >Business illustrations by Storyset</a
            >
          </div>
        </div>
      </v-container>
    </div>

    <div class="bg-1 py-10">
      <v-container>
        <v-row>
          <v-col cols="12" lg="6" md="6" sm="12" xs="12">
            <div
              class="d-flex align-center justify-center"
              style="height: 100%"
            >
              <div class="pr-lg-15">
                <p class="font-weight-medium text-body-1">Kontak kami</p>
                <p class="text-h4 font-weight-bold">Kirimkan masukan anda</p>
                <p class="text-body-1">Sky took on a wonderful</p>
                <p class="text-body-2 grey--text text-justify">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia
                  facilis neque dolore quis voluptatum saepe libero non ullam
                  laborum! Reiciendis tempora voluptatem quo! Culpa, incidunt?
                </p>
              </div>
            </div>
          </v-col>
          <v-col
            cols="12"
            lg="6"
            md="6"
            sm="12"
            xs="12"
            style="position: relative"
          >
            <div class="gradient5"></div>
            <v-card
              class="pa-10 rounded-xl py-10 bg-whiteblur mr-8"
              max-width="800px"
            >
              <div class="text-1 text-h6 font-weight-medium">
                Isi data dibawah
              </div>
              <v-text-field label="Masukan Email"></v-text-field>
              <v-text-field label="Masukan Nama"></v-text-field>
              <v-textarea label="Masukan Deskripsi"></v-textarea>
              <v-textarea
                label="Masukan Alamat"
                rows="3"
                row-height="25"
              ></v-textarea>
              <div class="d-flex justify-end">
                <v-btn outlined color="#0E6AE3" class="rounded-xl">Kirim</v-btn>
              </div>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </div>
    <Footer />
  </div>
</template>
<script src="./js/kontak.js"></script>
