<template>
  <div>
    <b-card class="mb-4" no-body>
      <b-card-body>
        <h4 class="card-title">Edit Data Anggota</h4>
        <form ref="form" enctype="multipart/form-data">
          <b-row>
            <b-col>
              <b-form-group label="Nama Siswa" label-for="nama_siswa">
                <input
                  id="nama_siswa"
                  v-model="form.nama_siswa"
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
    props: ['id_anggota'],
  data() {
    return {
      form: {
          nama_siswa: null,
      },
    };
  },
  methods: {
      update() {
          this.$emit('updateAnggota', { id: this.id_anggota, form: {...this.form }})
      },
      loadAnggota() {
          this.$store.dispatch('anggota/anggota', this.id_anggota)
            .then(result => {
                this.form.nama_siswa = result.nama_siswa
                console.log('buku::', result)
                this.data.buku = result
            })
            .catch(e => console.log(e))
      },
      close() {
          this.$emit('closeUpdateForm')
      }
  },
  beforeMount() {
      this.loadAnggota()
  },
  components: {
    //
  },
};
</script>
