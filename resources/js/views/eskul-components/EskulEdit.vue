<template>
  <div>
    <b-card class="mb-4" no-body>
      <b-card-body>
        <h4 class="card-title">Edit Data Eskul</h4>
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
          <b-button variant="outline-primary" size="sm" @click="update"
            >Update</b-button
          >
        </form>
        <h6 class="card-subtitle font-weight-normal text-muted"></h6>
      </b-card-body>
    </b-card>
  </div>
</template>
<script>
export default {
    props: ['id_eskul'],
  data() {
    return {
      form: {
          nama_eskul: null,
          deskrispi: null,
      },
    };
  },
  methods: {
      update() {
          this.$emit('updateEskul', { id: this.id_eskul, form: {...this.form }})
      },
      loadEskul() {
          this.$store.dispatch('eskul/eskul', this.id_eskul)
            .then(result => {
                this.form.nama_eskul = result.nama_eskul
                this.form.deskrispi = result.deskrispi
                console.log('eskul::', result)
            })
            .catch(e => console.log(e))
      },
      close() {
          this.$emit('closeUpdateForm')
      }
  },
  beforeMount() {
      this.loadEskul()
  },
  components: {
    //
  },
};
</script>
