import NavbarLanding from "~/components/NavbarLanding.vue";
import Footer from "~/components/Footer.vue";
import BottomNavigation from "~/components/BottomNavigation.vue";
import NavbarBeranda from'~/components/NavbarBeranda.vue'
export default{
  layout: "default",
  components: {
    NavbarLanding,
    BottomNavigation,
    NavbarBeranda,
    Footer
  },
  data() {
    return {
      dataCookies:null,
      cardData: [
        {
          icon: 'mdi-gamepad-circle',
          col:'6',
          iconColor: '#0E6AE3',
          title: 'Bagaimana cara memmbuat akun warga?',
          description: 'Anda dapat mendaftar akun warga dengan mendaftar pada bot Whatsapp kami dan mengisi formulir pendaftaran dengan data yang diperlukan dengan format yang ada.',
        },
        {
          icon: 'mdi-gamepad-circle',
          col:'6',
          iconColor: '#0E6AE3',
          title: 'Bagaimana cara melihat data warga',
          description: 'Untuk melihat data warga, Anda dapat masuk ke akun warga Anda dan navigasi ke bagian "Data Warga". Di sana Anda akan menemukan informasi yang Anda cari.',
        },
        {
          icon: 'mdi-gamepad-circle',
          col:'6',
          iconColor: '#0E6AE3',
          title: 'Bagaimana cara melihat data iuran warga?',
          description: 'Anda dapat melihat data iuran warga dengan masuk ke akun warga Anda dan menavigasi ke bagian "Data IPL". Di sana Anda akan menemukan rincian iuran warga',
        },
        {
          icon: 'mdi-gamepad-circle',
          col:'6',
          iconColor: '#0E6AE3',
          title: 'Bagaimana cara memberikan umpan balik?',
          description: 'Anda dapat memberikan umpan balik dengan mengunjungi halaman "Kontak kami" dalam aplikasi kami dan mengisi formulir umpan balik dengan saran Anda.',
        },
        {
          icon: 'mdi-gamepad-circle',
          col:'12',
          iconColor: '#0E6AE3',
          title: 'Bagaimana cara membuat surat pengantar?',
          description: 'Anda dapat membuat surat pengantar dengan mengunjungi halaman "Surat Pengantar" dalam aplikasi kami. Kemudian, isi formulir surat pengantar dengan data yang diperlukan, dan setelah itu Anda dapat menyimpannya. Surat pengantar yang sudah dibuat dapat diunduh melalui tabel riwayat laporan.',
        },
      ],
      expansionPanelData: [
        {
          header: 'Apa itu layanan kami?',
          content: 'Layanan kami mencakup berbagai hal seperti pendaftaran akun warga, informasi tentang data warga, dan pembayaran iuran warga.'
        },
        {
          header: 'Kenapa layanan ini penting?',
          content: 'Layanan ini penting karena memudahkan warga untuk mengakses informasi dan melakukan transaksi terkait administrasi mereka dengan lebih mudah dan efisien.'
        },
        {
          header: 'Bagaimana cara mendaftar akun warga?',
          content: 'Anda dapat mendaftar akun warga dengan mengklik tombol "Mendaftar" pada halaman utama kami dan mengisi formulir pendaftaran yang tersedia.'
        },
        {
          header: 'Kenapa penting untuk melihat data warga?',
          content: 'Melihat data warga penting untuk memahami komposisi dan kebutuhan masyarakat serta memastikan penyediaan layanan yang sesuai.'
        },
        {
          header: 'Bagaimana cara melihat data iuran warga?',
          content: 'Anda dapat melihat data iuran warga dengan masuk ke akun Anda dan mengunjungi bagian "Data IPL" yang tersedia di menu.'
        },
        {
          header: 'Kenapa penting untuk memantau data iuran warga?',
          content: 'Memantau data iuran warga membantu dalam mengelola ipl dan merencanakan penggunaan dana secara efektif untuk kepentingan komunitas.'
        },
        {
          header: 'Bagaimana jika saya memiliki pertanyaan lain?',
          content: 'Jika Anda memiliki pertanyaan lain yang tidak tercantum di sini, jangan ragu untuk menghubungi tim dukungan kami melalui formulir pada halaman kontak kami yang tersedia.'
        }
      ],
      datacontact:[
        {
          image:'uun.jpeg',
          name:'Uun Sakinah Aeni',
          mail:'uunsakinahaeni@Gmail.com'
        },
        {
          image:'akmal.jpeg',
          name:'Akmal Abrisal Rizki',
          mail:'akmalabrisalrizki@Gmail.com'
        },
        {
          image:'iza.jpeg',
          name:'Izanagi Faris Aslam',
          mail:'izanagifarisaslam5@Gmail.com'
        }
      ]
    }
  },
  created() {
    this.dataCookies= this.$cookies.get("dataUser")?.data??null
  },
}
