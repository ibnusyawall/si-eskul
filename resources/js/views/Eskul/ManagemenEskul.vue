<template>
  <div>
    <b-card class="mb-4" no-body>
      <b-card-body>
        <h4 class="card-title">Daftar Eskul</h4>
        <b-button variant="outline-primary" size="sm" @click="add_eskul"
          >Tambah Eskul</b-button>
      </b-card-body>
      <ManageEskulList :reload="reload" @editDataEskul="editEskul"/>
    </b-card>
     <template v-if="show_edit">
      <EskulEdit
        :id_eskul="id_eskul"
        @updateEskul="updateEskul"
      />
    </template>
     <template v-if="show_add">
      <EskulAdd
        @successAdd="successAdd"
      />
    </template>
  </div>
</template>

<script>
import { mapState } from "vuex";
import ManageEskulList from "../eskul-components/ManageEskulList.vue";
import EskulAdd from "../eskul-components/EskulAdd.vue";
import EskulEdit from "../eskul-components/EskulEdit.vue";

export default {
  data() {
    return {
      show_add: false,
      show_edit: false,
      id_eskul: null,
      reload: false
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
     add_eskul() {
      this.show_add = !this.show_add;
     },
     editEskul({ id }) {
         this.id_eskul = id


         this.show_edit = !this.show_edit
         console.log('id: ', id)
     },
     updateEskul({ id, form }) {
         console.log('edit formL:', form)

          axios
            .put(`/api/v1/eskul/${id}`, form)
            .then((result) => {
                console.log('updated success', result)
                this.modalSuccess()
            }).catch(e => {
                this.modalFailed()
                console.log('error:', e)
            })
     },
     successAdd({ status }) {
         this.reload = status
         console.log('success add: ', status)
     },
     modalSuccess() {
      this.$bvModal
        .msgBoxOk("Data berhasil di update", {
          title: "Confirmation",
          size: "sm",
          buttonSize: "sm",
          okVariant: "success",
          headerClass: "p-2 border-bottom-0",
          footerClass: "p-2 border-top-0",
          centered: true,
        })
        .then((value) => {
          this.$router.go(0)
        })
        .catch((err) => {
          // An error occurred
        });
    },
    modalFailed() {
      this.$bvModal
        .msgBoxOk("Data gagal di update", {
          title: "Confirmation",
          size: "sm",
          buttonSize: "sm",
          okVariant: "danger",
          headerClass: "p-2 border-bottom-0",
          footerClass: "p-2 border-top-0",
          centered: true,
        })
        .then((value) => {
          //
        })
        .catch((err) => {
          // An error occurred
        });
    },
  },
  mounted() {
    console.log('oke')
  },
  components: {
    ManageEskulList,
    EskulAdd,
    EskulEdit
  },
};
</script>
