<template>
  <b-navbar-brand >
       <!-- Logo icon -->
        <b class="logo-icon">
            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
            <!-- Dark Logo icon -->
            <img :src="logoIcon" alt="homepage" >

        </b>
        <!--End Logo icon -->
        <!-- Logo text -->
        <span class="logo-text">
            <!-- dark Logo text -->
            <img :src="logoText" alt="homepage" >

        </span>
  </b-navbar-brand>
</template>

<script>
import logoIcon from "./../../../assets/images/logo-light-icon.png"
import logoText from "./../../../assets/images/logo-light-text.png"

export default {
    name: 'LogoLight',
    data: () => ({ logoIcon, logoText }),
}
</script>
