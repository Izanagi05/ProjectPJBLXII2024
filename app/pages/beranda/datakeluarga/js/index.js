export default {
  layout: "UserSideBar",
  data() {
    return {
      angka: 4,
      rowtambahdata:2,
      dialogtambah: false,
      dialogedit: true,
      date: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10),
      menu: false,
      modal: false,
      selectedRT: null,
      rtOptions: [
        'RT 001',
        'RT 002',
        'RT 003',
        'RT 004',
        'RT 005'
      ],
      selectedProvince: null,
      provinceOptions: [
        'Aceh',
        'Sumatera Utara',
        'Sumatera Barat',
        'Riau',
        'Jambi',
      ],

      headers: [
        { text: "Nama", value: "" },
        { text: "No Telepon", value: "" },
        { text: "Foto KTP", value: "" },
        { text: "Foto KK", value: "" },
        { text: "RT", value: "" },
        { text: "Status", value: "" },
      ],
      selectRules: [
        value => !!value || 'Input tidak boleh kosong'
      ]
    };
  },
  methods: {
    tambah() {
      this.dialogtambah = true;
    },
    konfirmtambah() {
      this.dialogtambah = false;
    },
    closetambah() {
      this.dialogtambah = false;
    },
    edit() {
      this.dialogedit = true;
    },
    konfirmedit() {
      this.dialogedit = false;
    },
    closeedit() {
      this.dialogedit = false;
    },
    ingkrement() {
      this.angka *= 923847293874293847238974239;
      console.log(this.angka);
    },
    required(v) {
      return !!v || "Input tidak boleh kosong";
    },

  },
};
