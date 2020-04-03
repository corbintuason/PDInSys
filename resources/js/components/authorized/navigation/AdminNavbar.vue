<template>
<<<<<<< HEAD
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Bars -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu">
          <i class="fas fa-bars"></i>
        </a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">

      <!-- Notification Bell -->
      <notification-bell></notification-bell>
    

      <user-image></user-image>
      <!-- User Profile -->
      
      <user-profile></user-profile>

    </ul>
  </nav>
=======
  <div>
    <nav class="main-header navbar navbar-expand border-bottom bg-navbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu">
            <i class="fas fa-bars"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
            <i class="far fa-bell" style="font-size:24px"></i>
            <span class="badge navbar-badge notification-badge" style="font-size:10px;">
              <strong>0</strong>
            </span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="ml-3">
          <b-img
            :src="user.data.official_photo"
            rounded="circle"
            width="35px"
            height="35px"
            alt="Photo"
            v-if="user.data.official_photo != null"
          ></b-img>
          <b-img
            src="/img/avatar/user.png"
            rounded="circle"
            width="35px"
            height="35px"
            alt="Photo"
            v-else
          ></b-img>
        </li>
        <li class="nav-item dropdown mr-4">
          <b-nav-item-dropdown class="font-weight-bold" :text="user.meta.full_name" right>
            <b-dropdown-item>
              <router-link to="/user-profile">
                <p>My Profile</p>
              </router-link>
            </b-dropdown-item>
            <b-dropdown-item>
              <a href="#" @click="logOut">
                <p>Logout</p>
              </a>
            </b-dropdown-item>
          </b-nav-item-dropdown>
        </li>
      </ul>
    </nav>
  </div>
>>>>>>> 426c8b268e1aada7852d236b30c6f9ab4a4e51a5
</template>

<script>
import notificationBell from "./AdminNavbar/NotificationBell"
import userProfile from "./AdminNavbar/UserProfile"
import userImage from "./AdminNavbar/UserImage"
export default {
    components:{
      "notification-bell": notificationBell,
      "user-profile": userProfile,
      "user-image": userImage
    }
};
</script>

<<<<<<< HEAD
=======
<style lang="scss" scoped>
.bg-navbar {
  margin-right: 20px;
  margin-left: 20px;
  border-radius: 10px;
  transform: translateY(10px);
  box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.11) !important;
}
.notification-badge {
  background: rgba(247, 148, 44, 0.8);
  margin-left: 10px;
}
</style>
>>>>>>> 426c8b268e1aada7852d236b30c6f9ab4a4e51a5
