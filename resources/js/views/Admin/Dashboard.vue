<template>
  <div>
    <CardStatistics />
    <b-card class="mb-4" no-body>
      <b-card-body>
        <h4 class="card-title">Daftar Eskul</h4>
        <h6 class="card-subtitle font-weight-normal text-muted">
          Overview of Latest Month
        </h6>
      </b-card-body>
      <EskulList/>
    </b-card>
  </div>
</template>

<script>
import { mapState } from "vuex";
import CardStatistics from "../admin-components/CardStatistics.vue";
import EskulList from "../admin-components/EskulList.vue";

export default {
  data() {
    return {
      //
    };
  },
  computed: {
    ...mapState({
      login_success: (state) => state.login_success,
      user: (state) => state.user,
    }),
  },
  beforeMount() {
    //
  },
  methods: {
    //
  },
  mounted() {
    console.log('oke')
  },
  components: {
    CardStatistics,
    EskulList
  },
};
</script>
