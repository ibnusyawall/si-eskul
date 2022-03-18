<template>
  <div :class="`${LayoutType} ${Theme}`">
    <!-- ---------------------------------- -->
    <!--- Vertical Header part -->
    <!-- ---------------------------------- -->
    <VerticalSidebar />
    <aside class="page-wrapper">
      <VerticalHeader />
      <div class="min-height container-fluid p-4">
        <router-view />
      </div>
      <Footer />
    </aside>
  </div>
</template>

<script>
import VerticalHeader from "./vertical-header/VerticalHeader";
import VerticalSidebar from "./vertical-sidebar/VerticalSidebar";
import Footer from "./footer/Footer";
import { mapState } from "vuex";
export default {
  name: "FullLayout",
  components: {
    VerticalHeader,
    VerticalSidebar,
    Footer,
  },
  data: () => ({}),
  computed: {
    ...mapState(["LayoutType", "Theme"]),
  },

  watch: {},
};
</script>

<style>
</style>
