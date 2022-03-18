<template>
  <div class="table-responsive">
    <table class="table v-middle text-nowrap bg-transparent">
      <thead class="bg-light">
        <tr class>
          <th class="border-0">Nama Eskul</th>
          <th class="border-0">Deskripsi</th>
          <th class="border-0">Jumlah Anggota</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="v in data.eskul" :key="v.id">
            <td>{{ v.nama_eskul }}</td>
            <td>{{ v.deskrispi || '-' }}</td>
            <td>{{ v.anggota.length }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>

export default {
    data() {
        return {
            data: {
                eskul: null
            },
            length: {
                eskul: null
            }
        }
    },
    beforeMount() {
        this.loadEskul()
    },
    methods: {
        loadEskul() {
            this.$store.dispatch('eskul/eskuls')
                .then(result => {
                    console.log('eskuls:', result)
                    this.data.eskul = result
                })
                .catch(e => console.log(e))
        },
    }
}
</script>
