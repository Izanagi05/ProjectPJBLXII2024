export default function ({ store, redirect }) {
  store.dispatch('user/fetchdatacookie')?.data
  if(!store.state.user.authenticated){

    return redirect('/login')
  }else{
  }
}

