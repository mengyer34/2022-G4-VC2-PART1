import axios from "axios";
import getCookie from "./helper/getCookie";
import decryptData from "./helper/dencryptData";

export default axios.create({
  // baseURL: "http://localhost:8000/api",
  // baseURL: "http://192.168.22.29:8000/api",
  baseURL: "http://192.168.43.176:8000/api",
  headers: {
    "Content-type": "application/json",
    'Authorization': 'Bearer ' +  decryptData(getCookie('slms'), 'my_token')
  }
});




