<template>
  <div>
    <b-modal
      id="modalAddSubBab"
      ref="modal"
      :title="`Tambah Sub Bab Eskul ${eskul.nama_eskul}`"
      :header-bg-variant="'info'"
      :header-text-variant="'white'"
      okTitle="Tambah"
      cancelTitle="Batal"
      @ok="addFormSubBab"
    >
      <form ref="form">
        <b-row>
          <b-col>
            <b-form-group label="Nama Sub Bab" label-for="nama_subbab">
              <input
                id="nama_subbab"
                v-model="form.nama_subbab"
                type="text"
                :class="'form-control'"
                autofocus
                required
              />
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group label="Pilih Bab" label-for="bab">
              <select
                id="bab"
                class="form-control selectric"
                v-model="form.bab_id"
              >
                <option v-for="v in bab" :key="v.id" :value="v.id">
                  {{ v.nama_bab }} ({{ eskul.nama_eskul }})
                </option>
              </select>
            </b-form-group>
          </b-col>
          <!-- <b-col>
              <b-form-group label="Deskripsi Sub Bab" label-for="isi_subbab">
                <input
                  id="isi_subbab"
                  v-model="form.isi_subbab"
                  type="text"
                  :class="'form-control'"
                  autofocus
                  required
                />
              </b-form-group>
            </b-col> -->
        </b-row>

        <b-row>
          <b-col>
            <b-form-group label="Isi Sub Bab" label-for="isi_subbab">
              <b-form-textarea
                id="isi_subbab"
                v-model="form.isi_subbab"
                debounce="500"
                rows="3"
                max-rows="5"
              >
              </b-form-textarea>
            </b-form-group>
          </b-col>
        </b-row>
      </form>
    </b-modal>
    <b-card class="mb-4" no-body>
      <b-card-body>
        <h4 class="card-title">Pokja Eskul</h4>
        <b-button variant="outline-primary" size="sm" @click="add_bab"
          >Tambah BAB</b-button
        >
        <b-button variant="outline-info" size="sm" @click="add_subbab"
          >Tambah SUB BAB</b-button
        >
        <b-button variant="outline-success" size="sm" @click="add_subbab"
          >Unduh Pokja</b-button
        >
        <h6 class="mt-2 card-subtitle font-weight-normal text-muted">
          Eskul: {{ eskul.nama_eskul }}
        </h6>
      </b-card-body>
      <BabList
        :id_eskul="id_eskul"
        @namaEskul="namaEskul"
        @babList="babList"
        @showEditForm="showEditForm"
      />
    </b-card>
    <template v-if="show_edit">
      <BabEdit :id_bab="id_bab" :id_eskul="id_eskul" @updateBab="updateBab" />
    </template>
    <template v-if="show_add">
      <BabAdd />
    </template>
  </div>
</template>

<script>
import { mapState } from "vuex";
import BabList from "./../bab-components/BabList.vue";
import BabEdit from "./../bab-components/BabEdit.vue";
import BabAdd from "./../bab-components/BabAdd.vue";
import SubBabAdd from "./../subbab-components/SubBabAdd.vue";

export default {
  data() {
    return {
      id_eskul: this.$route.query.eskul_id,
      id_bab: null,
      add_sub: false,
      show_edit: false,
      show_add: false,
      eskul: {
        nama_eskul: null,
      },
      bab: null,
      form: {
        bab_id: null,
        isi_subbab: null,
        nama_subbab: null,
      },
    };
  },
  computed: {
    ...mapState({
      login_success: (state) => state.login_success,
      user: (state) => state.user,
    }),
  },
  beforeMount() {
    console.log("id_eskul", this.id_eskul);
  },
  methods: {
    async addFormSubBab(e) {
      console.log(this.form);

      e.preventDefault();
      try {
        let add_data = await axios.post(`/api/v1/sub-bab/`, this.form);
      } catch (e) {
        this.$nextTick(() => {
          this.$bvModal.hide("modalAddSubBab");
          this._alert("Tambah Data Sub Bab", "Data gagal ditambahkan.");
        });
      } finally {
        this.$nextTick(() => {
          this.$bvModal.hide("modalAddSubBab");
          this._alert("Tambah Data Sub Bab", "Data berhasil ditambahkan.");
        });
      }
    },
    _alert(title, msg) {
      this.$bvModal.msgBoxConfirm(msg, {
        title: title,
        size: "md",
        buttonSize: "md",
        okVariant: "success",
        okTitle: "OK",
        footerClass: "p-2",
        hideHeaderClose: false,
        centered: true,
      }).then(value => {
          this.$router.go();
      }).catch(e => console.log);
    },
    babList({ bab }) {
      this.bab = bab;
      console.log("bab:", bab);
    },
    add_subbab() {
      this.$bvModal.show("modalAddSubBab");
    },
    eskulev({ nama }) {
      this.eskul.nama = nama;
    },
    add_bab() {
      this.show_add = !this.show_add;
    },
    namaEskul({ nama }) {
      this.eskul.nama_eskul = nama;
    },
    showEditForm({ id }) {
      console.log("id form:", id);
      this.show_edit = !this.show_edit;
      this.id_bab = id;
    },
    updateBab({ id, form }) {
      axios
        .put(`/api/v1/bab/${id}`, form)
        .then((result) => {
          console.log("updated success", result);
          this.modalSuccess();
        })
        .catch((e) => {
          this.modalFailed();
          console.log("error:", e);
        });
      console.log("update: ", form, "id:", id);
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
          this.$router.go(0);
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
    console.log("oke");
  },
  components: {
    BabList,
    BabEdit,
    BabAdd,
    SubBabAdd,
  },
};
</script>
