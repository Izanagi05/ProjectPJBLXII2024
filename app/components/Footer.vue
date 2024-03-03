<template>
  <div>
    <v-footer class="pa-4 bg-5 bg-whiteblur2">
      <v-container>
        <v-row>
          <v-col lg="4">
            <div class="text-h6 font-weight-bold text-1">LayananWarga</div>
            <div class="text-body-1 text-2">
              Layanan warga yang mudah dijangkau.
            </div>
          </v-col>
          <v-col lg="8">
            <v-row>
              <v-col lg="4"> </v-col>
              <v-col lg="4">
                <ul
                  class="text-1 list-none pa-0 text-decoration-none"
                  style="list-style: none"
                >
                  <li class="font-weight-bold mb-4 text-2">Kontak kami</li>
                  <li class="mb-2">
                    <nuxt-link to="/kontak" class="text-decoration-none text-1">
                      kontak
                    </nuxt-link>
                  </li>
                </ul>
              </v-col>
              <v-col lg="4">
                <div class="d-flex align-center mb-2">
                  <v-icon class="text-1"> mdi-phone </v-icon>
                  <p class="ma-0 ml-1 text-1">(+62)812-0939-292</p>
                </div>
                <div class="d-flex align-center">
                  <v-icon class="text-1"> mdi-email </v-icon>
                  <p class="ma-0 ml-1 text-1">layananwarga@gmail.com</p>
                </div>
              </v-col>
            </v-row>
          </v-col>
        </v-row>
      </v-container>
    </v-footer>
  </div>
</template>
<script>
export default {};
</script>
