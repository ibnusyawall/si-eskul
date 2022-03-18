<template>
  <header class="topbar">
    <b-navbar
      :type="`${navbarColor == 'white' ? 'light' : 'dark'}`"
      class="p-0"
      :variant="navbarColor"
    >
      <div :class="`navbar-header d-block d-lg-none pl-3`">
        <LogoDark v-if="navbarColor == 'white'" />
        <!-- <LogoLight v-else /> -->
      </div>
      <b-navbar-nav
        ><b-nav-item @click="showMobileSidebar" class="d-block d-lg-none"
          ><i class="mdi mdi-menu fs-3"></i></b-nav-item
      ></b-navbar-nav>
      <!-- <b-navbar-toggle target="nav-collapse" class="mx-2 border-0"
        ><i class="mdi mdi-dots-horizontal"></i
      ></b-navbar-toggle> -->
      <b-collapse id="nav-collapse" is-nav class="">
        <!-- -----------------------------------------------------------
          Right aligned nav items
        ----------------------------------------------------------- -->
        <b-navbar-nav class="ml-auto">
          <b-nav-item-dropdown right no-caret>
            <!-- Using 'button-content' slot -->
            <template #button-content>
                {{ $store.state.user.username }}
            </template>
            <b-dropdown-item :to="{ name: 'profile' }" class="d-flex align-items-center">
              Profile
            </b-dropdown-item>
            <b-dropdown-item href="#" class="d-flex align-items-center">
              Settings
            </b-dropdown-item>
            <b-dropdown-item @click="$store.dispatch('logout')" class="d-flex align-items-center">
              Sign out
            </b-dropdown-item>
          </b-nav-item-dropdown>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
  </header>
</template>

<script>
import { mapState } from "vuex";
import LogoDark from "../logo-dark/LogoDark";
import LogoLight from "../logo-light/LogoLight";

export default {
  name: "vertical-header",
  data: () => ({
    showToggle: false,
  }),
  components: {
    LogoDark,
    LogoLight,
  },
  computed: {
    ...mapState(["navbarColor", "logoColor", "LayoutType"]),
  },
  methods: {
    showMobileSidebar() {
      this.$store.commit("SET_SIDEBAR_DRAWER", true);
    },
  },
};
</script>
