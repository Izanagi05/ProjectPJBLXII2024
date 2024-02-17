export default function ({ store, redirect, $cookies }) {
  store.dispatch("loginuser/fetchdatacookie");
  const adminbagiancheck = $cookies.get("userLogin")?.data;
  if (store.state.loginuser.authenticated && adminbagiancheck.role === "Admin" || adminbagiancheck.role ==="Admin RW") {
  return redirect('/admin/beranda')
}
}
