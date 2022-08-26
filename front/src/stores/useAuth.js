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
      axios.get('findUser').then(res => {
        this.userId = res.data.data.id;
        this.userEmail = res.data.data.email;
        console.log('fetched data!!!');
        console.log(res.data.data);
        this.user = res.data.data;
      })
      console.log("not wait");
    },
    logout(value){
      document.cookie = `${value}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
      axios.get('/logout')
    }
    
  },
})