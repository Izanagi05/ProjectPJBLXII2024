

export default{
  middleware:['guestmiddleware','adminrolemiddleware'],
  layout:'UserSideBar',

  data() {
    return {
      cardData: [
        {
          judul: "Data Keluarga",
          deskripsi:"Lihat data keluarga",
          rute: "/beranda/datakeluarga",
          icon: "icon1",
          bgClass:'#FF74A0'
        },
        {
          judul: "Buat Surat Pengantar",
          deskripsi:"Buat Surat Pengantar Anda",
          rute: "/beranda/pengajuansk",
          icon: "icon2",
          bgClass:'#FEC746'
        },
        {
          judul: "Data IPL",
          deskripsi:"Lihat riwayat data IPL anda",
          rute: "/beranda/dataipl",
          icon: "icon3",
          bgClass:'#40E6C0'
        },
        {
          judul: "Event",
          deskripsi:"Lihat Event sedang berlangsung",
          rute: "/beranda/event",
          icon: "icon4",
          bgClass:'#FF9065'
        },
      ],
    }
  },
}
