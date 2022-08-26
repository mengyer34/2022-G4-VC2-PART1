import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/user/HomeView.vue'
import HistoryView from '../views/user/history/HistoryView.vue'
import NotificatonView from '../views/user/notification/NotificationView.vue'
import ProfileView from '../views/user/profile/ProfileView.vue'
import Dashboard from '../views/admin/Dashboard/DashboardView.vue'
import Students from '../views/admin/Student/StudentView.vue'
import LeaveList from '../views/admin/LeaveList/LeaveView.vue'
import LoginView from '../views/login&signout/LoginView.vue'
import ForgotPasswordView from '../views/login&signout/ForgotPasswordView.vue'
import { useAuth } from '../stores/useAuth';


const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/histories',
    name: 'histories',
    component: HistoryView
  },
  {
    path: '/notifications',
    name: 'notifications',
    component: NotificatonView
  },
  {
    path: '/profile',
    name: 'profile',
    component: ProfileView
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard
  },
  {
    path: '/students',
    name: 'students',
    component: Students
  },
  {
    path: '/leaves',
    name: 'leaves',
    component: LeaveList
  },
  {
    path: '/login',
    name: 'login',
    component: LoginView
  },
  {
    path: '/forgot',
    name: 'forgot',
    component: ForgotPasswordView
  },
  { path: '/:pathMatch(.*)*', redirect: '/' }

]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach(async (to) => {
  // redirect to login page if not logged in and trying to access a restricted page
  const publicPages = ['/login'];
  const authRequired = !publicPages.includes(to.path);
  const auth = useAuth();
  auth.getUserInfo()
  if (authRequired && !auth.token) {
    return '/login';
  }
});
// router.beforeEach((to) => {
//   const auth = useAuth();
//   auth.getUserInfo();
//   if (!auth.token) return '/login'
// })


export default router