export default{
  layout: "UserSideBar",
  data() {
    return {

      selectedGender: null,
      genderOptions: ['Laki-laki', 'Perempuan'],
      selectedReligion: null,
      religionOptions: ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'],
      selectedOccupation: null,
      occupationOptions: [
        'Mahasiswa',
        'Pegawai Kantoran',
        'Wiraswasta',
        'Guru',
        'Dokter',
        'Polisi',
        'Petani',
        'Nelayan',
        'Buruh',
        'Penyiar',
        'Artis',
        'Atlet'
      ],
      selectRules: [
        value => !!value || 'Input tidak boleh kosong'
      ]

    }
  },
  methods: {
    required(v) {
      return !!v || "Input tidak boleh kosong";
    },
    konfirmpengajuan(){
      console.log('simpan');
    }
  },
}
