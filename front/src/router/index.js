import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/user/HomeView.vue'
import HistoryView from '../views/user/history/HistoryView.vue'
import NotificatonView from '../views/user/notification/NotificationView.vue'
import ProfileView from '../views/user/profile/ProfileView.vue'
import Dashboard from '../views/admin/Dashboard/DashboardView.vue'
import Students from '../views/admin/Student/StudentView.vue'
import LeaveList from '../views/admin/LeaveList/LeaveView.vue'
import AdminProfile from '../views/admin/profile/AdminProfile.vue'
import LoginView from '../views/login&signout/LoginView.vue'
import ForgotPassword from '../views/login&signout/ForgotPasswordView.vue'
import { useAuth } from '../stores/useAuth';
import user from '../middleware/user'
import admin from '../middleware/admin'



const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView,
    meta:{ middleware: [user] }

  },
  {
    path: '/histories',
    name: 'histories',
    component: HistoryView,
    meta:{ middleware: [user] }
  },
  {
    path: '/notifications',
    name: 'notifications',
    component: NotificatonView,
    meta:{ middleware: [user] }
  },
  {
    path: '/profile',
    name: 'profile',
    component: ProfileView,
    meta:{ middleware: [user] }
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard,
    meta:{ middleware: [admin] }
    
  },
  {
    path: '/students',
    name: 'students',
    component: Students,
    meta:{ middleware: [admin] }
  },
  {
    path: '/leaves',
    name: 'leaves',
    component: LeaveList,
    meta:{ middleware: [admin] }
  },
  {
    path: '/login',
    name: 'login',
    component: LoginView
  },
  {
    path: '/admin',
    name: 'admin',
    component: AdminProfile,
    meta:{ middleware: [admin] }
  },
  {
    path: '/forgot',
    name: 'forgotPassword',
    component: ForgotPassword
  },
  { path: '/:pathMatch(.*)*', redirect: '/' }

]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach(async (to) => {
  const publicPages = ['/login', '/forgot'];
  const authRequired = !publicPages.includes(to.path);
  const auth = useAuth();
  if (authRequired && !auth.token) {
    return '/login';
  }
});


export default router