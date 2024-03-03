import { mapGetters } from "vuex";
export default {
  layout: "AdminSideBar",
  middleware: ["guestmiddleware", "rolecheckmiddleware"],
  data() {
    return {
      tahunterpilih: "",
      headers: [
        { text: "Nama", value: "nama" },
        { text: "Data Tagihan", value: "tagihan_bulanans" },
        { text: "Aksi", value: "aksi" },
      ],
      headersdua: [{ text: "Status Pembayaran", value: "status_pembayaran" }],
      dialoginputPembayaranIuran: false,
      loadingData: true,
      inputPembayaranIuran: [],
      dataCookies: null,
      dialogTambahTagihan: false,
      inputTambahTagihan: {
        semuabulan: null,
        user_id: null,
        tahun_id: null,
        bulan_id: null,
        jenis_iuran_id: null,
        user_id: null,
      },
      isDisable:false,
      // inputPembayaranIuran: {
      //   tagihan_bulanan_id: null,
      //   user_id: null,
      //   tanggal_pembayaran: null,
      //   jumlah_pembayaran: null,
      // },
    };
  },
  computed: {
    ...mapGetters({
      getDataAllUserTagihan: "admindata/getDataAllUserTagihan",
      getAllDataAlamatByIdAlamat: "admindata/getAllDataAlamatByIdAlamat",
      getdataAllYears: "adminrw/getdataAllYears",
      getdataAllJenisIurans: "adminrw/getdataAllJenisIurans",
      getdataAlldataAllBulan: "adminrw/getdataAlldataAllBulan",
      getAllDataDetailAlamatByIdAlamat:
        "admindata/getAllDataDetailAlamatByIdAlamat",
    }),
  },
  methods: {
    async nohit() {},
    tambahTagihan(item) {
      this.dialogTambahTagihan = true;
      this.inputTambahTagihan.user_id = item?.user_id;
    },
    async konfirmBuatPesanWa() {
      this.isDisable=true
      await this.$store.dispatch(
        "admindata/postMessageNotifIplUser",
        this.inputPembayaranIuran
        )
        setTimeout(() => {
          this.isDisable = false;
        }, 3000);
    },
    closetambahTagihan(){
      this.dialogTambahTagihan = false;
      this.inputTambahTagihan=Object.assign({}, null)
    },
    async konfirmTambahTagihan() {
      this.dialogTambahTagihan = false;
      await this.$store.dispatch(
        "admindata/createTagihanByUserIdIPL",
        this.inputTambahTagihan
        )
        await this.$store.dispatch(
          "admindata/fetchDataAllTagihanUserbyTahun",
          this.tahunterpilih
          );
          this.inputTambahTagihan=Object.assign({}, null)
    },
    async tambahPembayaranIuran(item, tagihan) {
      this.inputPembayaranIuran = Object.assign({}, item, tagihan);
      console.log('hitam', this.inputPembayaranIuran);
      this.dialoginputPembayaranIuran = true;
    },

    async inputtahun(item) {
      await this.$store.dispatch(
        "admindata/fetchDataAllTagihanUserbyTahun",
        item
      );
    },
    async sudahlunas() {
      this.$toast.error("Tagihan ini sudah lunas", {
        duration: 3000,
      });
    },
    async closePembayaranIuran() {
      this.dialoginputPembayaranIuran = false;
      this.inputPembayaranIuran = Object.assign({}, null);
    },
    async konfirmPembayaranIuran() {
      this.dialoginputPembayaranIuran = false;
      await this.$store.dispatch(
        "admindata/postTransaksiPembayaranIuran",
        this.inputPembayaranIuran
      );
      await this.$store.dispatch(
        "admindata/fetchDataAllTagihanUserbyTahun",
        this.tahunterpilih
      );
      this.inputPembayaranIuran = Object.assign({}, null);
    },
    edittagihan(item) {},
    hapustagihan(item) {},
  },
  async created() {
    this.dataCookies = this.$cookies.get("dataUser").data.role;
    await this.$store.dispatch("adminrw/getAllTahun");
    await this.$store.dispatch(
      "admindata/fetchDataAllTagihanUserbyTahun",
      this.tahunterpilih
    );

    await this.$store.dispatch("adminrw/getAllJenisIurans");
    await this.$store.dispatch("adminrw/getAllBulan");
    await this.$store.dispatch("adminrw/getAllTahun");
  },
};
