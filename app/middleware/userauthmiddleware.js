export default function ({ store, redirect, $cookies }) {
  store.dispatch("loginuser/fetchdatacookie");
  const adminbagiancheck = $cookies.get("userLogin")?.data;
  if (store.state.loginuser.authenticated && adminbagiancheck.role === "User") {
    return redirect("/beranda");
  }
  if(store.state.loginuser.authenticated && adminbagiancheck.role === "Admin"){
    return redirect("/admin/beranda");
  }
}
