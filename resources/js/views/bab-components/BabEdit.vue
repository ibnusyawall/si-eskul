<template>
  <div>
    <b-card class="mb-4" no-body>
      <b-card-body>
        <h4 class="card-title">Edit Bab</h4>
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
    props: ['id_bab', 'id_eskul'],
  data() {
    return {
      form: {
          nama_bab: null,
      },
    };
  },
  methods: {
      update() {
          this.$emit('updateBab', { id: this.id_bab, form: {eskul_id: this.eskul, ...this.form }})
      },
      loadBab() {
          console.log('id bab: ', this.id_bab)
          this.$store.dispatch('bab/bab', this.id_bab)
            .then(result => {
                this.form.nama_bab = result.nama_bab
                console.log('buku:', result)
                //this.data.buku = result
            })
            .catch(e => console.log(e))
      },
      close() {
          this.$emit('closeUpdateForm')
      }
  },
  beforeMount() {
      this.loadBab()
  },
  components: {
    //
  },
};
</script>
