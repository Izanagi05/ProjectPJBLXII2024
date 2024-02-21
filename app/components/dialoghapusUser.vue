<template>
  <div>
    <v-dialog  class="rounded-xl dialog-event"
      v-model="dialogVisible"
      persistent
      style="box-shadow: 0px"
      max-width="600"
    >
      <v-card
        style="box-shadow: none"
        class="rounded-xl bg-whiteblur-card1 py-10 px-8"
      >
      <div class="mt-6  mb-10">

        <div class="text-h5 font-weight-medium  ">Yakin ingin  menghapus?</div>
        <p class="black--text mt-2 text-body-1">Data yang dihapus tidak bisa dikembalikan lagi</p>
      </div>
      <div class="d-flex justify-space-between">
              <v-btn
                class="rounded-xl  text-capitalize   black--text"
                @click="closehapus"
                >
                Batal</v-btn
              >
              <v-btn
                class="rounded-xl text-capitalize d-flex red white--text"
                @click="konfrimdelete"

                >
               Hapus </v-btn
              >
            </div>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
export default {
  props:[
    'konfrimdelete',
    'closehapus',
    'dialogVisible'
  ]
}
</script>
