<template>
  <div>
    <button class="w-[100%]" type="button" v-on:click="toggleModal()">
      <slot name="allow"></slot>
    </button>
    <div v-if="showModal"
      class="  overflow-x-hidden bg-[#00000080] overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex ">
      <div class="relative my-6 mx-auto max-w-3xl w-full rounded bg-white z-50" >
          <div id="print-information" class="bg-white p-2 rounded w-full">
            <!--content-->
            <div id="element-to-convert"
              class="relative flex flex-col w-full outline-none focus:outline-none ">
              <!--header-->
              <div class="p-2">
                <h3 class="text-2xl font-semibold text-center text-[#0081CA] uppercase">
                  Request Information
                </h3>
              </div>
              <!--body-->
              <div class="m-auto w-[90%] mt-2 mb-2">
                <table class="border-collapse border w-full">
                  <tbody>
                    <tr class="hover:bg-[#F5F5F5]">
                      <td class="border p-3 text-center text-[16px] text-[#6E6E6E]">Reason</td>
                      <td class="border  p-3 text-center w-[96%] text-[16px] font-bold">{{ datas.reason }}</td>
                    </tr>
                    <tr class="hover:bg-[#F5F5F5]">
                      <td class="border text-center p-3 text-[16px] text-[#6E6E6E]">Leave Type</td>
                      <td class="border text-center p-3 w-[96%]  text-[16px] text-[#FF6B00]">{{ datas.leave_type }} </td>
                    </tr>
                    <tr class="hover:bg-[#F5F5F5]">
                      <td class="border text-center p-3 text-[16px] text-[#6E6E6E]">Start Date</td>
                      <td class="border text-center p-3 w-[96%]  text-[16px] text-[#6E6E6E]">{{ datas.start_date }}
                        {{ datas.start_time }}</td>
                    </tr>
                    <tr class="hover:bg-[#F5F5F5]">
                      <td class="border text-center p-3 text-[16px] text-[#6E6E6E]">End Date</td>
                      <td class="border text-center p-3 w-[96%]  text-[16px] text-[#6E6E6E]">{{ datas.end_date }}
                        {{ datas.end_time }}
                      </td>
                    </tr>
                    <tr class="hover:bg-[#F5F5F5]">
                      <td class="border text-center p-3 text-[16px] text-[#6E6E6E]">Status</td>
                      <td class="border text-center p-3 w-[96%]  text-[16px]   "
                        :class="datas.status === 'Approved' ? 'text-[#0081CA]' : 'text-[#FF0000]'">{{ datas.status }} </td>
                    </tr>
                    <tr class="hover:bg-[#F5F5F5]">
                      <td class="border text-center p-3 text-[16px] text-[#6E6E6E]">Duration</td>
                      <td class="border text-center p-3 w-[96%]  text-[16px]  text-[#FF6B00]">{{ datas.duration }} <span v-if="datas.duration < 2">day</span> <span v-else>days</span></td>
                    </tr>
                    <tr class="hover:bg-[#F5F5F5]">
                      <td class="border text-center p-3 text-[16px] text-[#6E6E6E]">Requestion</td>
                      <td class="border text-center p-3 w-[96%]  text-[16px] text-[#6E6E6E]">{{ datas.created_at }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!--footer-->
            </div>
          </div>
        <div class="flex items-center justify-end p-6 border-0 relative  w-full outline-none focus:outline-none">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 hover:text-white cursor-pointer w-10 m-2 hover:bg-[#FF6B00] hover:rounded-full p-2 text-[#0081CA]" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2" onclick="window.print()">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 hover:text-white w-10 m-2 hover:bg-[#FF6B00] hover:rounded-full p-2 text-[#0081CA] cursor-pointer" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2" @click="exportToPDF">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
          </svg>
          <button
            class=" bg-transparent border border-solid bg-[#D9D9D9] hover:bg-[#FF6B00] hover:text-white active:bg-red-600 font-bold uppercase text-sm p-2 px-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
            type="button" v-on:click="toggleModal()">
            Close
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import html2pdf from "html2pdf.js";
export default {
  name: "regular-modal",
  props: {
    'datas': Object
  },
  data() {
    return {
      showModal: false
    }
  },
  methods: {
    toggleModal: function () {
      this.showModal = !this.showModal;
    },
    exportToPDF() {
      html2pdf(document.getElementById("element-to-convert"),
        {
          margin: 5,
          filename: "information.pdf",
        });
    },
  }
}
</script>

<style >
  @media print {
    body{
      visibility: hidden;
    }
    #print-information , #print-information * {
      visibility: visible
    }
    #print-information {
      width: 100%;
      height: 100%;
    }
  }
</style>