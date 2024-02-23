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
      ],
      headersdua: [{ text: "Status Pembayaran", value: "status_pembayaran" }],
      dialoginputPembayaranIuran: false,
      loadingData: true,
      inputPembayaranIuran:[],
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
      getAllDataDetailAlamatByIdAlamat: "admindata/getAllDataDetailAlamatByIdAlamat",
    }),
  },
  methods: {
    async tambahPembayaranIuran(item,tagihan) {
      this.inputPembayaranIuran = Object.assign({}, item, tagihan);
      this.dialoginputPembayaranIuran = true;
    },
    async sudahlunas(){
      this.$toast.error("Tagihan ini sudah lunas", {
        duration: 3000
      });
    },
    async closePembayaranIuran() {
      this.dialoginputPembayaranIuran = false;
      this.inputPembayaranIuran = Object.assign({}, null);
    },
    async konfirmPembayaranIuran() {
      await this.$store.dispatch(
        "admindata/postTransaksiPembayaranIuran",
        this.inputPembayaranIuran
        );
        await this.$store.dispatch(
          "admindata/fetchDataAllTagihanUserbyTahun",
          this.tahunterpilih
        );
        this.dialoginputPembayaranIuran = false;
        this.inputPembayaranIuran = Object.assign({}, null);
    },
    edittagihan(item) {},
    hapustagihan(item) {},
  },
  async created() {
    await this.$store.dispatch(
      "admindata/fetchDataAllTagihanUserbyTahun",
      this.tahunterpilih
    );

  },
};
