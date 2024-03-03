import NavbarLanding from "~/components/NavbarLanding.vue";
import Footer from "~/components/Footer.vue";
export default {
  layout: "default",
  components: {
    NavbarLanding,
    Footer
  },
  data() {
    return {
      dataItems: [
        {
          icon: 'mdi-id-card',
          iconColor: '#0E6AE3',
          title: ' Pendataan Warga yang Mudah dan Efisien',
          description: 'Dengan fitur pendataan warga kami, Anda dapat dengan mudah mengumpulkan dan mengelola informasi tentang penduduk secara akurat dan efisien.',
        },
        {
          icon: 'mdi-file-document-outline',
          iconColor: '#0E6AE3',
          title: 'Pembuatan Surat Pengantar dalam Sekejap.',
          description: 'Tidak perlu lagi repot membuat surat pengantar satu per satu. Dengan fitur otomatis kami, platform ini dapat menghasilkan surat pengantar secara instan setelah data warga diinput. Hemat waktu, hemat tenaga',
        },
        {
          icon: 'mdi-message-fast-outline',
          iconColor: '#0E6AE3',
          title: 'Komunikasi Langsung dengan Pemerintah Setempat',
          description: 'Kami menyediakan bot WhatsApp yang siap membantu Anda berinteraksi dengan pemerintah setempat secara langsung. Dari memantau data iuran hingga mendaftar sebagai warga baru',
        },
      ],
    }
  },
};
