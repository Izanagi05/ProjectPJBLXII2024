export default function ({ store, redirect, $cookies }) {
  store.dispatch("loginuser/fetchdatacookie")?.data;
  const adminbagiancheck = $cookies.get("userLogin").data;
  if (
    store.state.loginuser.authenticated &&
    adminbagiancheck.role !== "Admin RW"
  ) {
  }else{
    return redirect("/admin/beranda");
  }
}
