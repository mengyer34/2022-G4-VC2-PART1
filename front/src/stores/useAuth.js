import { defineStore } from 'pinia'
import axios from '../axios-http'
import getCookie from '../helper/getCookie'


export const useAuth = defineStore({
  id: 'auth',
  state: () => ({
    token: getCookie('slms'),
    userId: null,
    userEmail: null,
  }),
  actions:{
    setToken(token){
      this.token = token
    },
    getUserInfo(){
      axios.get('findUser').then(res => {
        let user = res.data.data;
        if(user!==null){
          this.userId = res.data.data.id;
          this.userEmail = res.data.data.email;
        }else{
          console.log('not load yet')
        }
      })
    },
    logout(value){
      document.cookie = `${value}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
      axios.get('/logout')
    }
    
  },
})