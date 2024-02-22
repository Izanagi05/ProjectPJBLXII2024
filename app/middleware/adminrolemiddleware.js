export default function ({ store, redirect, $cookies }) {
  store.dispatch("user/fetchdatacookie");
  const adminbagiancheck = $cookies.get("dataUser")?.data;
  if (store.state.user.authenticated && adminbagiancheck.role === "Admin" || adminbagiancheck.role ==="Admin RW") {
  return redirect('/admin/beranda')
}
}
