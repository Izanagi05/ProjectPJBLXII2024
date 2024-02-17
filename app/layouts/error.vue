<template>
  <v-app dark>
    <div class="box"  @mousemove="onMouseOvver">
    <div>
      <div
        class="circle"
        :style="{ transform: `translate(${mouseXd}px, ${mouseYd}px)` }"
      ></div>
        <div class="box__ghost" style="z-index: 99">
          <div class="symbol"></div>
          <div class="symbol"></div>
          <div class="symbol"></div>
          <div class="symbol"></div>
          <div class="symbol"></div>
          <div class="symbol"></div>

          <div class="box__ghost-container">
            <div class="box__ghost-eyes" ref="boxGhostEyes">
              <div class="box__eye-left"></div>
              <div class="box__eye-right"></div>
            </div>
            <div class="box__ghost-bottom">
              <div></div>
              <div></div>
              <div></div>
              <div></div>
              <div></div>
            </div>
          </div>
          <div class="box__ghost-shadow" style="z-index: 99"></div>
          <div style="z-index: 99">
            <p :class="[' text1 font-weight-medium white--text animet mt-4 text-center', $vuetify.breakpoint.smAndDown?'text-h6':'display-1']">Halaman Ini Tidak Ada</p>
            <div class="d-flex justify-center">

              <v-btn @click="rutepush"
              class="bg-whiteblur white--text btnglow mt-8 btndefaultnshdow text-capitalize  rounded-xl"
              style="z-index: 9"
              >Kembali</v-btn
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </v-app>
</template>

<script>
export default {
  name: "EmptyLayout",
  layout: "empty",
  data() {
    return {
      pageX: 0,
      pageY: 0,
      mouseY: 0,
      mouseX: 0,
      mouseYd: 0,
      mouseXd: 0,
    };
  },
  mounted() {},
  beforeDestroy() {
    document.removeEventListener("mousemove", this.handleMouseMove);
    document.removeEventListener("mousemove", this.handleMouseOverCircle);
  },
  methods: {
    rutepush(){
      this.$router.go(-1);
    },
    handleMouseOverCircle(event) {
      this.mouseXd = event.clientX;
      this.mouseYd = event.clientY;
      console.log(this.mouseXd);
    },

    onMouseOvver(event) {
      this.handleMouseOverCircle(event);
      this.pageX = document.documentElement.clientWidth;
      this.pageY = document.documentElement.clientHeight;

      this.handleMouseMove = this.handleMouseMove.bind(this); // Bind this to the method
      document.addEventListener("mousemove", this.handleMouseMove);
      // console.log(this.pageX);
    },
    handleMouseMove(event) {
      // Fungsi yang memproses pergerakan mouse
      this.mouseY = event.pageY;
      var yAxis = ((this.pageY / 2 - this.mouseY) / this.pageY) * 300;
      this.mouseX = event.pageX / -this.pageX;
      var xAxis = -this.mouseX * 100 - 100;

      // Gunakan refs untuk mengakses elemen HTML di Nuxt.js
      if (this.$refs.boxGhostEyes) {
        this.$refs.boxGhostEyes.style.transform =
          "translate(" + xAxis + "%,-" + yAxis + "%)";
      }
    },
  },
};
</script>
<style src="~/assets/css/error.css">

</style>
