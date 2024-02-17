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
                      Bersuara untuk Perubahan
                    </p>

                    <p class="text-1">
                      tempat di mana suaramu menjadi kekuatan. Kami adalah
                      panggung pengaduan daring yang memberdayakan setiap
                      individu untuk beraksi dan membangun komunitas
                    </p>
                    <v-btn
                      to="/"
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
                  <p class="text-h4">Fitur? Banyak banget coyy</p>
                  <div class="text-caption grey--text">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Error incidunt magnam excepturi eaque eum nesciunt ducimus
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
                  min-width="250px"
                >
                  <v-icon :color="item.iconColor" x-large>{{
                    item.icon
                  }}</v-icon>
                  <p class="mt-4 font-weight-medium text-1 text-body-2">
                    {{ item.title }}
                  </p>
                  <p class="text-caption text-1">{{ item.description }}</p>
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
            Musuh terlihat hati hati didepan
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
                      Lorem ipsum dolor sit amet consectetur adipisicing.
                    </p>
                    <p class="text-body-2 white--text text-1">
                      Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                      Provident voluptas laudantium reiciendis velit
                      necessitatibus. Reprehenderit, odio!
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
                      Lorem ipsum dolor sit amet consectetur adipisicing.
                    </p>
                    <p class="text-body-2 white--text text-1">
                      Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                      Provident voluptas laudantium reiciendis velit
                      necessitatibus. Reprehenderit, odio!
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
                      Lorem ipsum dolor sit amet consectetur adipisicing.
                    </p>
                    <p class="text-body-2 white--text text-1">
                      Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                      Provident voluptas laudantium reiciendis velit
                      necessitatibus. Reprehenderit, odio!
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
                      Lorem ipsum dolor sit amet consectetur adipisicing.
                    </p>
                    <p class="text-body-2 white--text text-1">
                      Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                      Provident voluptas laudantium reiciendis velit
                      necessitatibus. Reprehenderit, odio!
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
                Lihat, semuanya ada disini
              </p>
              <p class="text-body-1 text-1 text-justify mt-4">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Corrupti nulla consequatur voluptatem provident incidunt, ex
                omnis? Velit nobis explicabo temporibus reiciendis. Quas
                consequatur sint dicta recusandae commodi eius aspernatur
                excepturi minima neque. At possimus non accusamus deleniti
                reiciendis dicta rerum. Lorem ipsum dolor sit amet, consectetur
                adipisicing elit. Molestias, distinctio qui sint ea assumenda
                veritatis quaerat molestiae consequatur est ipsum eaque sit eum
                asperiores aliquid doloremque architecto ratione at quis?
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
