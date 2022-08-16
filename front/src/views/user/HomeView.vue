<template>
  <div class="home bg-[#ddd] w-full h-[96vh] ">
    <div class="card w-3/5 m-auto   rounded-xl p-10 shadow- bg-[white]">
      <div class="card-header">
        <h1 class="text-4xl m-5 font-bold ">Student Leave Management </h1>
        <h1 class="text-4xl m-5 font-bold ">System (SLMS) </h1>
      </div>
      <div class="card-body pl-3.5">
        <p>
          It is a software that streamlines time off requests for students. Typically managed by social affair team, an
          automated leave management system makes it easy to track, approve, or deny student leave requests.
          Students use their school email address and password to log in. When they log in, they have access to their
          attendance history, create new request, and a list of leave.
        </p>
      </div>
      <div class="footer pt-10 pl-3.5">
        <button class="bg-[#FF6B00] p-1.5 rounded-md text-white ">
          <router-link class="p-2 px-6 flex" to="/newRequest">
            Create new request
          </router-link>
        </button>
      </div>
    </div>
  </div>
</template>
// @ is an alias to /src

