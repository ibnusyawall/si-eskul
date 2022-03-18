<template>
  <div>
    <b-card class="mb-4" no-body>
      <b-card-body>
        <h4 class="card-title">Tambah Data Eskul</h4>
        <form ref="form" enctype="multipart/form-data">
          <b-row>
            <b-col>
              <b-form-group label="Nama Eskul" label-for="nama_eskul">
                <input
                  id="nama_eskul"
                  v-model="form.nama_eskul"
                  type="text"
                  :class="'form-control'"
                  autofocus
                  required
                />
              </b-form-group>
            </b-col>
            <b-col>
              <b-form-group label="Deskripsi" label-for="deskripsi">
                <input
                  id="deskripsi"
                  v-model="form.deskrispi"
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
          nama_eskul: null,
          deskrispi: null,
      },
    };
  },
  methods: {
      add() {
           axios
            .post("/api/v1/eskul", this.form)
            .then(() => {
                this.modalSuccess();
            })
            .catch((e) => {
                console.log("e:", e);
                console.log(this.form)
                this.modalFailed();
            });
      },
      close() {
          this.$emit('closeUpdateForm')
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
                   // this.$emit('successAdd', { status: true })
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
