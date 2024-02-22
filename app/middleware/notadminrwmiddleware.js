export default function ({ store, redirect, $cookies }) {
  store.dispatch("user/fetchdatacookie")?.data;
  const adminbagiancheck = $cookies.get("dataUser").data;
  if (
    store.state.user.authenticated &&
    adminbagiancheck.role !== "Admin RW"
  ) {
  }else{
    return redirect("/admin/beranda");
  }
}
