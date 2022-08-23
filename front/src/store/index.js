import { defineStore } from 'pinia'

export const useEmail = defineStore({
  id: 'email',
  state: () => ({
    email: ''
  }),
  actions:{
    setEmail(email){
      this.email = email;
    },
  },
  getters:{
    getEmail:()=>{
      return this.email
    }
  }
})
