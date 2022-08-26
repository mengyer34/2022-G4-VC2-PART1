import axios from "axios";
import getCookie from "./helper/getCookie";

export default axios.create({
  baseURL: "http://localhost:8000/api",
  headers: {
    "Content-type": "application/json",
    'Authorization': 'Bearer ' +  getCookie('slms')
  }
});




