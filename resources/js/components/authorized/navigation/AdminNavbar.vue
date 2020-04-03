<template>
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

