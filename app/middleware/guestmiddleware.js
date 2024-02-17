export default function ({ store, redirect }) {
  store.dispatch('loginuser/fetchdatacookie')?.data
  if(!store.state.loginuser.authenticated){

    return redirect('/login')
  }else{
  }
}

