<template>
   <div>
     <div class="card w-8/12 m-auto mt-24 rounded-xl p-10 bg-white">
      <div class="card-header">
        <h1 class="text-3xl mb-5 font-bold">Student Leave Management System (SLMS)</h1>
      </div>
      <div class="card-body pl-">
        <p class="text-[18px]">
          It is a software that streamlines time off requests for students. Typically managed by social affair team, an
          automated leave management system makes it easy to track, approve, or deny student leave requests.
          Students use their school email address and password to log in. When they log in, they have access to their
          attendance history, create new request, and a list of leave.
        </p>
      </div>
      <div class="footer pt-10">
        <button id="btn_animated" class="items-center flex px-3 py-3 text-lg  rounded-md text-warning uppercase font-semibold " @click="showFormRequest">
            Ask Permission
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </button>
      </div>
    </div>
    <form-requestion v-if="isShow" @closePopup="closePopup" @add-leave="saveChange"/>
    <request-sent v-if="isSentRequest" @addNewRequest="addNewRequest"/>
   </div>
</template>

<script>
  import axios from '../../axios-http'
  import requestForm from "./newRequest/RequestFormView.vue"
  import requestSent from "../../components/user/request/RequestSentSuccess.vue"
  export default{
      components: {
          "form-requestion": requestForm,
          "request-sent":requestSent
      },
      data(){
        return {
          isShow: false,
          isSentRequest: false
        }
      },
      methods: {
        showFormRequest(){
          this.isShow = true;
      },
      closePopup(){
          this.isShow = false;
      },
      // addNewRequest(){
      //   this.isSentRequest = false;
      //   this.$router.push({name: "histories"})
      // },
      saveChange(newRequest){
        // this.isSentRequest = true;
        this.isShow = false;
        axios.post('leaves',newRequest).then((res)=>{
          this.$router.push({name: "histories"})
        })
      }
  }
  }
</script>

<style scoped>
  #btn_animated:hover{
    transition: all 1s ease-in-out;
    background: #FF6B00;
    color: #fff;
    box-shadow: 2px 2px 6px 1px #ddd;
    transform: translateY(-10px);
  }
</style>
