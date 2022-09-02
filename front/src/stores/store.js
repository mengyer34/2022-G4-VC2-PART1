import { createStore } from 'vuex';
import getCookie from '../helper/getCookie'
import axios from '../axios-http'


export const store = new createStore({
  state: {
    role: getCookie('role'),
    token: getCookie('slms'),
    userId: null,
    userEmail: null,
  },
  actions: {
    logout(){
      document.cookie = `${'slms'}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
      document.cookie = `${'role'}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
      axios.get('/logout')
    }
  }
})
