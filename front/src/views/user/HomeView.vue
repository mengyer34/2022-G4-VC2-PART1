<template>
   <div>
     <div class="card w-8/12 m-auto mt-32 rounded-xl p-10 shadow- bg-white">
      <div class="card-header">
        <h1 class="text-4xl m-5 font-bold ">Student Leave Management System (SLMS)</h1>
      </div>
      <div class="card-body pl-3.5">
        <p class="text-[20px]">
          It is a software that streamlines time off requests for students. Typically managed by social affair team, an
          automated leave management system makes it easy to track, approve, or deny student leave requests.
          Students use their school email address and password to log in. When they log in, they have access to their
          attendance history, create new request, and a list of leave.
        </p>
      </div>
      <div class="footer pt-10 pl-3.5">
        <button id="btn_animated" class=" border border-[#FF6B00] px-3 py-3 text-lg  rounded-md text-warning uppercase font-bold " @click="showFormRequest">
            Create new request
        </button>
      </div>
    </div>
    <form-requestion v-if="isShow" @close-popup="closePopup" />
   </div>
</template>

<script>
  import requestForm from "../../components/user/RequestForm.vue"
  export default{
      components: {
          "form-requestion": requestForm
      },
      data(){
        return {
          isShow: false
        }
      },
      methods: {
        showFormRequest(){
          this.isShow = true;
      },
      closePopup(){
          this.isShow = false;
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
