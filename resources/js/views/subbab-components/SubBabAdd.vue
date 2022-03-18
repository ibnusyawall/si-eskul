<template>
  <div>
    <b-modal
      id="modal-prevent-closing"
      ref="modal"
      title="Submit Your Name"
     
    >
    ID ESKUL {{ id_eskul }}
    </b-modal>
  </div>
</template>
<script>
export default {
  props: ['id_eskul', 'add_sub'],
  data() {
    return {
      form: {
          //
      },
    };
  },
  beforeMount() {
      if (this.add_sub) {
          this.$bvModal.show('modal-prevent-closing')
      }
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
