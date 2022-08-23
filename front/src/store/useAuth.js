import { defineStore } from 'pinia'

export const useAuth = defineStore({
  id: 'auth',
  state: () => ({
    token: '',
    userId: '',
    role: ''
  }),
  actions:{
    setToken(token){
      this.token = token;
    },
  },
})