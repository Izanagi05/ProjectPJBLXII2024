export default {
  layout: "AdminSideBar",
  middleware:['guestmiddleware', 'rolecheckmiddleware'],
  data() {
    return {
      cardData: [
        {
          count: 231,
          title: 'Jumlah Warga',
          logo: 'icon1',
          bgClass: 'bgbrd-2',
        },
        {
          count: 231,
          title: 'Sudah Membayar Iuran',
          logo: 'icon2',
          bgClass: 'bgbrd-2',
        },
        {
          count: 231,
          title: 'Belum Membayar Iuran',
          logo: 'icon3',
          bgClass: 'bgbrd-2',
        },
        {
          count: 231,
          title: 'Belum Pernah Membayar IPL',
          logo: 'icon1',
          bgClass: 'bgbrd-2',
        },
        {
          count: 231,
          title: 'Tata Tertib',
          logo: 'icon5',
          bgClass: 'bgbrd-2',
        }
      ],
    }
  },
};
