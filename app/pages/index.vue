<template>
  <div>
    <navbar-landing />
    <div class="bg-1" style="position: relative">
      <v-container>
        <div class="py-4 d-flex align-center" style="height: 100vh">
          <!-- <div class="gradient" style="position: absolute; top: 0; left: 0; height: 100vh; width: 100vw;"></div> -->
          <div class="gradient"></div>
          <!-- <div>tet</div> -->
          <div style="z-index: 2" class="test">
            <v-row>
              <v-col cols="12" lg="6" md="6" sm="12" xs="12">
                <div
                  class="d-flex justify-center align-center"
                  style="height: 100%"
                >
                  <div class="">
                    <p
                      :class="[
                        'mb-4 font-weight-medium  text-1',
                        $vuetify.breakpoint.smAndDown
                          ? 'display-1'
                          : 'display-2',
                      ]"
                    >
                    Solusi Digital untuk Kemudahan
                    </p>

                    <p class="text-1">
                      Selamat datang di Layanan Warga! Kami adalah solusi digital untuk memudahkan interaksi antara warga dan pemerintah tingkat RT dan RW. Dengan platform kami, Anda dapat dengan mudah berkomunikasi dengan pemerintah setempat
                    </p>
                    <v-btn
                      to="/login"
                      depressed
                      text
                      color="#102E46"
                      class="text-1 white text-capitalize rounded-xl"
                    >
                      Get Started
                    </v-btn>
                  </div>
                </div>
              </v-col>
              <v-col cols="12" lg="6" md="6" sm="12" xs="12">
                <div class="d-flex justify-center align-center">
                  <v-img
                    :src="require('~/assets/img/landingimage.png')"
                    :max-width="$vuetify.breakpoint.smAndDown ? '250' : '400'"
                  />
                </div>
              </v-col>
            </v-row>
          </div>
        </div>


        <div class="transparent py-8" style="position: relative">
          <div class="gradient2"></div>
          <v-row>
            <v-col cols="12" lg="4" md="8" sm="12" xs="12">
              <div class="d-flex align-center" style="height: 100%">
                <div>
                  <p class="text-h4">Layanan Kami</p>
                  <div class="text-body-1 black--text">
                    Kami menyediakan solusi yang memudahkan pendataan warga, pembuatan surat pengantar, dan interaksi dengan pemerintah melalui WhatsApp. Dengan fitur-fitur kami yang inovatif
                  </div>
                </div>
              </div>
            </v-col>
            <v-col cols="12" lg="8" md="8" sm="12" xs="12">
              <div class="d-flex pa-4" style="width: 100%; overflow-x: scroll">
                <v-card
                  v-for="(item, index) in dataItems"
                  :key="index"
                  class="pa-10 rounded-xl py-10 bg-whiteblur mr-8"
                  min-width="300px"
                >
                  <v-icon :color="item.iconColor" x-large>{{
                    item.icon
                  }}</v-icon>
                  <p class="mt-4 font-weight-medium text-1 text-body-1">
                    {{ item.title }}
                  </p>
                  <p class="text-body-2 text-1">{{ item.description }}</p>
                </v-card>
              </div>
            </v-col>
          </v-row>
        </div>
      </v-container>
        <div class="bg-2 py-15" style="position: relative;">
          <v-container>
          <p
            :class="[
              'mb-4 font-weight-regular  white--text',
              $vuetify.breakpoint.smAndDown ? 'text-h5' : 'text-h4',
            ]"
          >
          Solusi Terpadu Layanan Warga
          </p>
          <v-row>
            <v-col cols="12" lg="4" md="4" sm="12" xs="12" style="z-index: 9">
              <v-row>
                <v-col cols="6" lg="12" md="12" sm="6" xs="6">
                  <div class="d-flex mt-4">

                    <v-btn :ripple="false" icon class="bg-whiteblur"
                    ><v-icon color="#ffffff" class=""
                        >mdi-arrow-right</v-icon
                      ></v-btn
                    >
                  <div class="ml-4">
                    <p class=" font-weight-medium white--text text-h6">
                      Pendataan Warga yang Efisien
                    </p>
                    <p class="text-body-2 white--text text-1">
                      Dengan platform kami, pendataan warga dapat dilakukan dengan mudah dan cepat. Data yang terstruktur membantu pemerintah dalam mengelola informasi penting tentang penduduk setempat.
                    </p>
                  </div>

                  </div>
                </v-col>

                <v-col cols="6" lg="12" md="12" sm="6" xs="6">
                      <div class="d-flex mt-4">

                    <v-btn :ripple="false" icon class="bg-whiteblur"
                    ><v-icon color="#ffffff" class=""
                        >mdi-arrow-right</v-icon
                      ></v-btn
                    >
                  <div class="ml-4">
                    <p class=" font-weight-medium white--text text-h6">
                      Layanan Surat Pengantar Tanpa Ribet
                    </p>
                    <p class="text-body-2 white--text text-1">
                      Kami menyediakan layanan pembuatan surat pengantar yang otomatis, memudahkan warga untuk mendapatkan dokumen penting seperti surat pindah rumah tanpa harus melalui proses yang rumit
                    </p>
                  </div>

                  </div>
                </v-col>
              </v-row>
            </v-col>
            <v-col cols="12" lg="4" md="4" sm="12" xs="12" style="z-index: 9">
              <div class="d-flex align-center justify-center" style="height:100%;">

                <v-img
                class=""
                :src="require('~/assets/img/landingimage2.png')"
                :max-width="$vuetify.breakpoint.smAndDown ? '250' : '400'"
                />
              </div>
            </v-col>
            <v-col cols="12" lg="4" md="4" sm="12" xs="12" style="z-index: 9">
              <v-row>
                <v-col cols="6" lg="12" md="12" sm="6" xs="6">
                      <div class="d-flex mt-4">

                    <v-btn :ripple="false" icon class="bg-whiteblur"
                    ><v-icon color="#ffffff" class=""
                        >mdi-arrow-right</v-icon
                      ></v-btn
                    >
                  <div class="ml-4">
                    <p class=" font-weight-medium white--text text-h6">
                      Komunikasi Dua Arah dengan Pemerintah
                    </p>
                    <p class="text-body-2 white--text text-1">
                      Dapatkan akses langsung ke pemerintah setempat melalui WhatsApp. Tidak hanya untuk mendapatkan informasi, tetapi juga untuk memberikan masukan dan bertanya tentang kebijakan serta layanan pemerintah.
                    </p>
                  </div>

                  </div>
                </v-col>

                <v-col cols="6" lg="12" md="12" sm="6" xs="6">
                      <div class="d-flex mt-4">

                    <v-btn :ripple="false" icon class="bg-whiteblur"
                    ><v-icon color="#ffffff" class=""
                        >mdi-arrow-right</v-icon
                      ></v-btn
                    >
                  <div class="ml-4">
                    <p class=" font-weight-medium white--text text-h6">
                      Pengelolaan Data Keuangan yang Transparan
                    </p>
                    <p class="text-body-2 white--text text-1">
                      Melalui platform kami, warga dapat memantau dan mengelola data keuangan mereka dengan transparan. Informasi tentang iuran dengan mudah untuk menjaga kejelasan dan keterbukaan.
                    </p>
                  </div>

                  </div>
                </v-col>
              </v-row>
            </v-col>
          </v-row>
        </v-container>
        </div>
        <div class="bg-1 py-15">
          <v-container>
          <v-row>
            <v-col cols="12" lg="6" md="6" sm="12" xs="12" style="z-index: 9">
              <div
                class="d-flex justify-center align-center"
                style="position: relative;height: 100%;"
              >
                <div class="gradient3"></div>
                <v-img
                  class="justify-center"
                  :src="require('~/assets/img/landingimage3.png')" style="transform: scaleX(-1);"
                  :max-width="$vuetify.breakpoint.smAndDown ? '250' : '400'"
                />
              </div>
            </v-col>
            <v-col cols="12" lg="6" md="6" sm="12" xs="12" style="z-index: 9">
              <p
                :class="[
                  'mb-4 font-weight-regular  text-1',
                  $vuetify.breakpoint.smAndDown ? 'text-h5' : 'text-h4',
                ]"
              >
              Mengapa Memilih Aplikasi Kami?
              </p>
              <p class="text-body-1 text-1 text-justify mt-4">
                Dengan aplikasi kami, Anda dapat mengakses berbagai layanan yang memudahkan hidup Anda sehari-hari. Dari pendataan yang cepat hingga pembuatan surat pengantar tanpa ribet, kami hadir untuk memberikan solusi terbaik bagi Anda. Dapatkan kemudahan akses, komunikasi yang efisien dengan pemerintah setempat, dan pengelolaan data keuangan yang transparan, semua dalam satu aplikasi yang mudah digunakan.
              </p>
              <v-btn color="#0E6AE3" class="rounded-xl mt-4" outlined
                >Selengkapnya</v-btn
              >
            </v-col>
          </v-row>
        </v-container>
        </div>


    </div>
    <Footer />
  </div>
</template>

<script src="./js/index.js"></script>
