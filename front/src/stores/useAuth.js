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
    async getUserInfo(){
      await axios.get('findUser').then(res => {
        const user = res.data.data;
        console.log(user.id);
        this.userId = user.id;
        this.userEmail = user.email;
      })
    },
    logout(value){
      document.cookie = `${value}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
      axios.get('/logout')
    }
    
  },
})