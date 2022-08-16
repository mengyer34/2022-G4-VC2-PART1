<template>
    <h1>Hi</h1>
    <div class="bg-slate-300 w-9/12 p-6 m-auto rounded-md flex shadow-gray-600 shadow-sm">
        <div class="w-4/12">
            <label for="filter-status"><span class="text-red-600">*</span>Filter by status:</label><br>
            <select name="" id="filter-status" class="w-9/12 rounded p-2">
                <option value="">All</option>
                <option value="">Reject</option>
                <option value="">Approve</option>
                <option value="">Cancel</option>
            </select>
        </div>
        <div class="w-4/12">
            <label for="filter-leave-type"><span class="text-red-600">*</span>Filter by leaves type:</label><br>
            <select name="" id="filter-leave-type" class="w-9/12 p-2 rounded">
                <option value="">All</option>
                <option value="">Reject</option>
                <option value="">Approve</option>
                <option value="">Cancel</option>
            </select>
        </div>
    </div>
    <div class="w-9/12 m-auto bg-slate-300 rounded-md mt-3 p-8 shadow-sm shadow-gray-600">
        <p>Total: 3</p>
        <div class="mt-4">
            <div class="bg-slate-200 p-6 rounded-md">
                <p>Reason: <span class="font-bold">Go to hometown</span></p>
                <div class="flex justify-between">
                    <div class="">
                        <p>Leave type: <span class="text-orange-500">Family's event</span></p>
                        <p>From: <span>February 21, 2022 - February 22, 2022 (morning)</span></p>
                    </div>
                    <div class="mr-5">
                        <p>Duration: <span class="font-bold text-red-600">0.5</span></p>
                        <p>Status: <span class="text-orange-500">Panding</span></p>
                    </div>

                </div>
            </div>
            <p class="text-end">Requested: <span class="text-gray-500">February 20, 2022 7:00AM</span></p>
        </div>
        <div class="mt-4">
            <div class="bg-slate-200 p-6 rounded-md">
                <p>Reason: <span class="font-bold">Go to hometown</span></p>
                <div class="flex justify-between">
                    <div class="">
                        <p>Leave type: <span class="text-orange-500">Family's event</span></p>
                        <p>From: <span>February 21, 2022 - February 22, 2022 (morning)</span></p>
                    </div>
                    <div class="mr-5">
                        <p>Duration: <span class="font-bold text-red-600">0.5</span></p>
                        <p>Status: <span class="text-orange-500">Panding</span></p>
                    </div>

                </div>
            </div>
            <p class="text-end">Requested: <span class="text-gray-500">February 20, 2022 7:00AM</span></p>
        </div>
        <div class="mt-4">
            <div class="bg-slate-200 p-6 rounded-md">
                <p>Reason: <span class="font-bold">Go to hometown</span></p>
                <div class="flex justify-between">
                    <div class="">
                        <p>Leave type: <span class="text-orange-500">Family's event</span></p>
                        <p>From: <span>February 21, 2022 - February 22, 2022 (morning)</span></p>
                    </div>
                    <div class="mr-5">
                        <p>Duration: <span class="font-bold text-red-600">0.5</span></p>
                        <p>Status: <span class="text-orange-500">Panding</span></p>
                    </div>

                </div>
            </div>
            <p class="text-end">Requested: <span class="text-gray-500">February 20, 2022 7:00AM</span></p>
        </div>
    </div>
    <h1></h1>
</template>