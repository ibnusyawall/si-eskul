<template>
  <div>
    <b-row>
      <b-col cols="12" md="6" lg="6">
        <b-card class="mb-4">
          <h4 class="card-title mb-1">{{ length.eskul }}</h4>
          <b-card-text class="mb-2">Eskul</b-card-text>
          <b-progress :value="length.eskul" max="50"></b-progress>
        </b-card>
      </b-col>
      <b-col cols="12" md="6" lg="6">
        <b-card class="mb-4">
          <h4 class="card-title mb-1">{{ length.anggota }}</h4>
          <b-card-text class="mb-2">Anggota</b-card-text>
          <b-progress
            variant="danger"
            :value="length.anggota"
            max="50"
          ></b-progress>
        </b-card>
      </b-col>
    </b-row>
  </div>
</template>
<script>

export default {
    data() {
        return {
            data: {
                eskul: null,
                anggota: null,
                bab: null,
            },
            length: {
                eskul: null,
                anggota: null,
                bab: null,
            }
        }
    },
    beforeMount() {
        this.loadAllData()
    },
    methods: {
        loadAllData() {
            this.loadEskul()
            this.loadAnggota()
            this.loadBab()
        },
        loadEskul() {
            this.$store.dispatch('eskul/eskuls')
                .then(result => {
                    this.data.eskul = []
                    this.length.eskul = result.length || 0
                    console.log('kamars:', result)
                    this.data.eskul = result
                })
                .catch(e => console.log(e))
        },
        loadAnggota() {
            this.$store.dispatch('anggota/anggotas')
                .then(result => {
                    this.data.anggota = []
                    this.length.anggota = result.length || 0
                    console.log('anggotas:', result)
                    this.data.anggota = result
                })
                .catch(e => console.log(e))
        },
        loadBab() {
            this.$store.dispatch('bab/babs')
                .then(result => {
                    this.data.bab = []
                    this.length.bab = result.length || 0
                    console.log('babs:', result)
                    this.data.bab = result
                })
                .catch(e => console.log(e))
        },
    },

}
</script>

