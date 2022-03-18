<template>
  <b-navbar-brand href="#" class="navbar-brand-center">
       <!-- Logo icon -->
        <b class="text-center mt-1 mr-2">
            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
            <!-- Light Logo icon -->
            <!-- <img :src="logoIcon" alt="homepage" > -->

        </b>
        <!--End Logo icon -->
        <!-- Logo text -->
        <span class="logo-text">
            <!-- Light Logo text -->
            <!-- <img :src="logoText"  alt="homepage"> -->
            {{ $store.state.brand }}
        </span>
  </b-navbar-brand>
</template>

<script>
import logoIcon from "./../../../assets/images/logo-icon.png"
import logoText from "./../../../assets/images/logo-text.png"
export default {
    name: 'LogoDark',
    data: () => ({ logoIcon, logoText }),
    filters: {
        sortened(self) {
            return `${self.split` `[0].charAt(0)}. ${self.split` `.splice(1).join` `}`
        }
    }
}
</script>
<style scoped>
.navbar-brand-center {
     margin-left: auto;
  margin-right: auto;
}
</style>
