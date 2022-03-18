<template>
  <div>
    <b-card class="mb-4" no-body>
      <b-card-body>
        <h4 class="card-title">Tambah Bab</h4>
        <form ref="form" enctype="multipart/form-data">
          <b-row>
            <b-col>
              <b-form-group label="Nama Bab" label-for="nama_bab">
                <input
                  id="nama_bab"
                  v-model="form.nama_bab"
                  type="text"
                  :class="'form-control'"
                  autofocus
                  required
                />
              </b-form-group>
            </b-col>
          </b-row>
          <b-button variant="outline-primary" size="sm" @click="add"
            >Tambah</b-button
          >
        </form>
        <h6 class="card-subtitle font-weight-normal text-muted"></h6>
      </b-card-body>
    </b-card>
  </div>
</template>
<script>
export default {
  data() {
    return {
      form: {
          eskul_id: this.$route.query.eskul_id,
          nama_bab: null,
      },
    };
  },
  methods: {
      add() {
           axios
            .post("/api/v1/bab", this.form)
            .then(() => {
                this.modalSuccess();
            })
            .catch((e) => {
                console.log("e:", e);
                console.log(this.form)
                this.modalFailed();
            });
      },
      modalSuccess() {
        this.$bvModal
            .msgBoxOk("Data berhasil di tambah", {
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
        .msgBoxOk("Data gagal di ditambah", {
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
  components: {
    //
  },
};
</script>
