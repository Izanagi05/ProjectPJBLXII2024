<template>
  <div>
    <v-data-table :headers="header" :items="getAllDataPemasukan"></v-data-table>
    <div class="d-flex justify-end">
      <p class="text-h5 mt-4 font-weight-mmediu">Total Pemasukan: Rp.{{getSumDataPemasukan}}</p>
    </div>
  </div>
</template>
<script src="./js/index.js"></script>
