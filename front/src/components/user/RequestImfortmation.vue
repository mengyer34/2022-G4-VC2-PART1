<template>
  <div>
    <button class="w-[100%]" type="button" v-on:click="toggleModal()">
      <slot name="allow"></slot>
    </button>
    <div v-if="showModal"
      class="  overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex ">
      <div class="relative my-6 mx-auto max-w-3xl w-[40%]">
        <!--content-->
        <div
          class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
          <!--header-->
          <div class="p-2">
            <h3 class="text-2xl font-semibold text-center">
              Request Imformation
            </h3>
            <!-- <button
              class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none "
              v-on:click="toggleModal()">
              <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                ×
              </span>
            </button> -->
          </div>
          <!--body-->
          <div class="m-auto">
            <table class="border-collapse border bg-white w-96 ">
              <tbody>
                <tr class="hover:bg-[#F5F5F5]">
                  <td class="border p-3 text-center text-[13px] text-[#6E6E6E]">Reason</td>
                  <td class="border  p-3 text-center w-[96%] text-[13px] font-bold">Headache</td>
                </tr>
                <tr class="hover:bg-[#F5F5F5]">
                  <td class="border text-center p-3 text-[13px] text-[#6E6E6E]">Leave Type</td>
                  <td class="border text-center p-3 w-[96%]  text-[13px] text-[#FF6B00]">Sick Leave</td>
                </tr>
                <tr class="hover:bg-[#F5F5F5]">
                  <td class="border text-center p-3 text-[13px] text-[#6E6E6E]">Start Date</td>
                  <td class="border text-center p-3 w-[96%]  text-[13px] text-[#6E6E6E]">February 21, 2022(morning)</td>
                </tr>
                <tr class="hover:bg-[#F5F5F5]">
                  <td class="border text-center p-3 text-[13px] text-[#6E6E6E]">End Date</td>
                  <td class="border text-center p-3 w-[96%]  text-[13px] text-[#6E6E6E]">February 21, 2022(Afternoon)
                  </td>
                </tr>
                <tr class="hover:bg-[#F5F5F5]">
                  <td class="border text-center p-3 text-[13px] text-[#6E6E6E]">Status</td>
                  <td class="border text-center p-3 w-[96%]  text-[13px] text-[#6E6E6E] text-[#FF6B00]">Panding</td>
                </tr>
                <tr class="hover:bg-[#F5F5F5]">
                  <td class="border text-center p-3 text-[13px] text-[#6E6E6E]">Duration</td>
                  <td class="border text-center p-3 w-[96%]  text-[13px] text-[#6E6E6E] text-[#FF6B00]">0.5</td>
                </tr>
                <tr class="hover:bg-[#F5F5F5]">
                  <td class="border text-center p-3 text-[13px] text-[#6E6E6E]">Requestoin</td>
                  <td class="border text-center p-3 w-[96%]  text-[13px] text-[#6E6E6E]">February 20, 2022 6:30 pm</td>
                </tr>
              </tbody>
            </table>
            <!-- <p class="my-4 text-slate-500 text-lg leading-relaxed">
              I always felt like I could do anything. That’s the main
              thing people are controlled by! Thoughts- their perception
              of themselves! They're slowed down by their perception of
              themselves. If you're taught you can’t do anything, you
              won’t do anything. I was taught I could do everything.
            </p> -->
          </div>
          <!--footer-->
          <div class="flex items-center justify-end p-6 ">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 hover:text-white w-10 m-2 hover:bg-[#FF6B00] hover:rounded-full p-2 text-[#0081CA]" fill="none" viewBox="0 0 24 24"
              stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 hover:text-white w-10 m-2 hover:bg-[#FF6B00] hover:rounded-full p-2 text-[#0081CA]" fill="none" viewBox="0 0 24 24"
              stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>
            <button
              class="t bg-transparent border border-solid bg-[#D9D9D9] hover:bg-[#FF6B00] hover:text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
              type="button" v-on:click="toggleModal()">
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
    <div v-if="showModal" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
  </div>
</template>

<script>
export default {
  name: "regular-modal",
  data() {
    return {
      showModal: false
    }
  },
  methods: {
    toggleModal: function(){
      this.showModal = !this.showModal;
    }
  }
}
</script>