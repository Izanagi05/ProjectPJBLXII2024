import NavbarLanding from "~/components/NavbarLanding.vue";
import Footer from "~/components/Footer.vue";
import axios from 'axios'
export default{
  layout: "default",
  components: {
    NavbarLanding,
    Footer
  },
  data() {
    return {
      name: null,
      sub: null,
      mes: null,
      intervalku: 0,
      dataku: {
        email: null,
        message: null,
      },
      truekondisi:false
    }
  },
  methods: {
    buat() {

      try {
        this.dataku.message =
          "Name: " +
          this.name +
          "\n" +
          "Subject: " +
          this.sub +
          "\n" +
          "Message: " +
          this.mes;
        console.log(this.dataku.message + this.dataku.email);
        if (
          (this.name === null || this.name === "") &&
          (this.sub === null || this.sub === "") &&
          (this.mes === null || this.mes === "") &&
          (this.dataku.email === null || this.dataku.message === "")
        ) {
          this.$toast.error("Gagal mengirim isi, data dengan lengkap", {
            duration: 3000,
          });
        } else {
          this.truekondisi=true

          if(this.intervalku>=1){
            this.$toast.error("Anda sudah melakukan pengiriman mohon jangan melakukan spam", {
                    duration: 3000,
                  });
          }else{
            this.intervalku =4
            this.timerawalcoy = setInterval(() => {
              if (this.intervalku >= 1) {
              this.intervalku--;
            } else {
              this.intervalku = 0;
              clearInterval(this.timerawalcoy);
              console.log("p")
              axios
                .post("https://formspree.io/f/mdorzkzp", this.dataku)
                .then((res) => {
                  console.log(res);
                  this.$toast.success("Berhasil mengirim", {
                    duration: 3000,
                  });
                  window.location.reload()
                })
                .catch((err) => {
                  this.$toast.error("Isi input email dengan benar", {
                    duration: 3000,
                  });
                });
              }
          }, 1000);
          this.$toast.error("Tunggu " + this.intervalku+" Detik", {
            duration: 4000,
          });
        }
        }
      } catch (error) {
        console.log(error)
        this.$toast.error("Isi input email dengan benar", {
          duration: 3000,
        });
      }
    },
  },
}
