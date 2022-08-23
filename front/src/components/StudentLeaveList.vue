<template>
    <table class="w-full whitespace-nowrap">
        <thead>
            <tr tabindex="0" class="focus:outline-none h-16 w-full text-sm leading-none text-gray-800 border-b-2 border-primary">
                <th class="font-bold text-center ">STUDENT NAME</th>
                <th class="font-bold text-center ">LEAVE TYPE</th>
                <th class="font-bold text-center ">REQUEST DATE</th>
                <th class="font-bold text-center ">STATUS</th>
                <th class="font-bold text-center ">ACTION</th>
            </tr>
        </thead>
        <tbody class="w-full">
            <tr v-for="leaveUser of leaveUsers" :key="leaveUser" tabindex="0" class="focus:outline-none h-12 text-sm leading-none text-gray-800 hover:bg-gray-200 border-b border-t border-gray-100" :class="{'bg-white text-stone-600': leaveUser.is_admin_seen, 'bg-slate-300 font-medium': !leaveUser.is_admin_seen}">
                <td class="text-center">
                    {{leaveUser.user.last_name}} {{leaveUser.user.first_name}}
                </td>
                <td class="text-center">
                    {{leaveUser.leave_type}}
                </td>
                <td class="text-center">
                    {{leaveUser.created_at}}
                </td>
                <td class="text-center">
                    <div class="flex justify-center items-center">
                        <span v-if="leaveUser.is_admin_seen" class="px-2 py-[5px] rounded-full text-white" :class="iscolor(leaveUser)">{{leaveUser.status}}</span>
                        <span v-else class="px-2 py-[5px] rounded-full text-white bg-orange-400" >New</span>
                    </div>
                </td>
                <td class="text-center">
                    <button class="bg-blue-500 py-2 px-4 rounded text-white">Details</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: ['leaveUsers'],
    data() {
        return {
        }
    },
    methods: {
        iscolor(leaveuser) {
            if (leaveuser.status == "Approved") {
                return "bg-green-500";
            }else if (leaveuser.status == "Pending") {
                return "bg-yellow-400";
            }else if (leaveuser.status == "Rejected") {
                return "bg-red-500";
            }
        },   
    },
}
</script>