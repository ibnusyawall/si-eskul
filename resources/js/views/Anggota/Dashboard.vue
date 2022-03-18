<template>
  <div>
    <b-card class="mb-4" no-body>
      <b-card-body>
        <h4 class="card-title">Daftar Anggota Eskul</h4>
        <b-button variant="outline-primary" size="sm" @click="add_anggota"
          >Tambah Anggota</b-button>
        <h6 class="mt-2 card-subtitle font-weight-normal text-muted">
          Daftar anggota eskul {{ eskul.nama }}
        </h6>
      </b-card-body>
      <AnggotaList
        @eskul="eskulev"
        @showEditForm="showEditForm"
        />
    </b-card>
    <template v-if="show_edit">
      <AnggotaEdit
        :id_anggota="id_anggota"
        @closeUpdateForm="close_edit"
        @updateAnggota="updateAnggota"
      />
    </template>
    <template v-if="show_add">
      <AnggotaAdd
        @closeUpdateForm="close_edit"
      />
    </template>
  </div>
</template>

<script>
import { mapState } from "vuex";
import AnggotaList from "./../anggota-components/AnggotaList.vue";
import AnggotaEdit from "./../anggota-components/AnggotaEdit.vue"
import AnggotaAdd from "./../anggota-components/AnggotaAdd.vue"

export default {
  data() {
    return {
      id_anggota: null,
      show_edit: false,
      show_add: false,
      eskul: {
          nama: null
      }
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
    eskulev({ nama }) {
        this.eskul.nama = nama
    },
    add_anggota() {
      this.show_add = !this.show_add;
    },
    updateAnggota({ id, form }) {
        this.id_anggota = id

        axios
            .put(`/api/v1/anggota/${id}`, form)
            .then((result) => {
                console.log('updated success', result)
                this.modalSuccess()
            }).catch(e => {
                this.modalFailed()
                console.log('error:', e)
            })
        console.log('update: ', form, 'id:', id)
    },
    showEditForm({ id }) {
        this.show_edit = true
        this.id_anggota = id
    },
    close_edit() {
      this.show_edit = false;
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
    AnggotaList,
    AnggotaEdit,
    AnggotaAdd,
  },
};
</script>
