<template>
  <div>
    <v-bottom-navigation
      flat
      fixed
      v-model="value"
      style="bottom: 20px"
      class="rounded-xl  elevation-0 no-shadow transparent"
      transition="slide-y-reverse-transition"
    >
      <v-card class="rounded-xxl bg-whiteblur d-flex">
        <v-btn
          class="mx-lg-4 mx-md-4 rounded-xxl"
          v-for="(item, i) in url"
          :key="i"
          :to="item.rute"
        >
          <span
            :class="['',getColor(i).textColor]"
            >{{ item.judul }}</span
          >
          <v-icon  :color="getColor(i).color">{{ item.icon }}</v-icon>
        </v-btn>
      </v-card>
    </v-bottom-navigation>
  </div>
</template>
<script>
export default {
  data() {
    return {
      value: 0,
      url: [
        {
          judul: "Beranda",
          rute: "/beranda",
          icon: "mdi-home-variant-outline",
        },
        {
          judul: "Tata Tertib",
          rute: "/beranda/tatatertib",
          icon: "mdi-shield-account-variant-outline",
        },
        {
          judul: "Faqs",
          rute: "/faq",
          icon: "mdi-frequently-asked-questions",
        },
        {
          judul: "Profil",
          rute: "/beranda/profil",
          icon: "mdi-account-outline",
        },
      ],
    };
  },
  computed:{
    // color(){
    //   switch (this.value) {
    //       case 0: return 'yellow'
    //       case 1: return 'teal'
    //       case 2: return 'red'
    //       case 3: return 'green'
    //     }
    // }
  },

  mounted() {
    // this.hanldeColors
  },
  methods: {
    getColor(index) {
      return {   color: this.value === index ? '#0E6AE3' : 'grey',
        textColor: this.value === index ? 'text-5' : 'grey--text',}
    },
    hanldeColors(){
      if(this.$route.path.includes('/beranda','/beranda/datakeluarga','/beranda/pengajuansk','/beranda/event')){
        this.value=0
      }else if(this.$route.path.includes('/beranda/tatatertib')){
        this.value=1
      }else if(this.$route.path.includes('/faq')){
        this.value=2
      }else if(this.$route.path.includes('/beranda/profil')){
        this.value=3
      }
    }
  },
};
</script>
