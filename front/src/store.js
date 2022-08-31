import { createStore } from 'vuex';
import getCookie from './helper/getCookie'


export const store = new createStore({
  state: {
    role: getCookie('role')
  },
})
