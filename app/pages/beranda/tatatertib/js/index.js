export default{
  layout: "UserSideBar",
  middleware:['guestmiddleware','adminrolemiddleware'],
  data() {
    return {
      tatibs: [
        {
          time: 'Baru saja',
          icon: 'mdi-flag-outline',
          title: 'Awikwokwik',
          description: 'Lorem ipsum nndolor sit amet consectetur adipisicing elit. Laborum, quis in neque facilis excepturi dignissimos molestias doloremque explicabo voluptatum eos.'
        },
        {
          time: '2 jam yang lalu',
          icon: 'mdi-flag-outline',
          title: 'Contoh Judul 2',
          description: 'Deskripsi kedua'
        },
        {
          time: '3 jam yang lalu',
          icon: 'mdi-flag-outline',
          title: 'Contoh Judul 3',
          description: 'Deskripsi ketiga'
        },
        {
          time: '4 jam yang lalu',
          icon: 'mdi-flag-outline',
          title: 'Contoh Judul 4',
          description: 'Deskripsi keempat'
        },
        {
          time: '5 jam yang lalu',
          icon: 'mdi-flag-outline',
          title: 'Contoh Judul 5',
          description: 'Deskripsi kelima'
        }
      ]
    }
  },
}
