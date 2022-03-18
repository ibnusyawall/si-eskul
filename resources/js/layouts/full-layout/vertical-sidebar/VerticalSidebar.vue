<template>
  <aside
    class="left-sidebar"
    :class="
      Sidebar_drawer ? `show-sidebar bg-${SidebarColor}` : `bg-${SidebarColor}`
    "
  >
    <div :class="`bg-${logoColor} navbar-header`">
      <LogoDark />
      <span
        class="d-block d-lg-none close-sidebar-btn"
        @click="showMobileSidebar"
        ><i class="mdi mdi-close font-18"></i
      ></span>
    </div>

    <div class="scrlbar">
      <ul class="nav flex-column mb-0">
        <template v-for="(route, i) in routes">
          <!---Single Menu -->
          <li class="nav-item" :key="i" v-if="!route.childern && !route.header">
            <router-link :to="`${route.to}`" class="nav-link d-flex">
              <i :class="route.icon"></i>
              <span class="hide-text">{{ route.title }}</span>
            </router-link>
          </li>
        </template>
      </ul>
      <div class="text-center px-3">
        <b-button
          target="_blank"
          variant="info"
          block
          href="https://instagram.com/isywl_"
          >
            <i class="mdi mdi-instagram"></i>
            Follow To Subscribe
        </b-button>
      </div>
    </div>
  </aside>
</template>

<script>
import LogoDark from "../logo-dark/LogoDark";
import { mapState } from "vuex";
import SidebarData from "./SidebarData";

export default {
  name: "VerticalSidebar",
  components: {
    LogoDark,
  },
  data: () => ({
    initialShow: true,
    routes: SidebarData,
    user: JSON.parse(localStorage.getItem('user')),
  }),
  computed: {
    ...mapState(["logoColor", "Sidebar_drawer", "SidebarColor"]),
    check() {
      return console.log(this.$router.history.current);
    },
  },
  methods: {
    showMobileSidebar() {
      this.$store.commit("SET_SIDEBAR_DRAWER", false);
    },
  },
};
</script>

<style>
</style>
