import { defineStore } from 'pinia'
import axios from '../axios-http'
import getCookie from '../helper/getCookie'


export const useAuth = defineStore({
  id: 'auth',
  state: () => ({
    token: getCookie('slms'),
    userId: null,
    userEmail: null,
    role: null,
  }),
  actions:{
    setToken(token){
      this.token = token
    },
    async getUserInfo(){
      if(getCookie('slms') && this.userId == null){
        await axios.get('/account/find').then(res => {
          this.userId = res.data.data.id;
          this.userEmail = res.data.data.email;
          this.user = res.data.data.data;
          this.role = res.data.data.role;
          console.log(res.data.data);
        })
      }
    },
    logout(value){
      document.cookie = `${value}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
      axios.get('/logout')
    }
    
  },
})