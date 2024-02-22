export default function ({ store, redirect, $cookies }) {
  store.dispatch("user/fetchdatacookie");
  const adminbagiancheck = $cookies.get("dataUser")?.data;
  if (store.state.user.authenticated && adminbagiancheck.role === "User") {
    return redirect("/beranda");
  }
  if(store.state.user.authenticated && adminbagiancheck.role === "Admin"){
    return redirect("/admin/beranda");
  }
}
