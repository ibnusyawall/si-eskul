<template>
<div>
  <b-modal
      id="modalHapusAnggota"
      ref="hapus-data"
      title="Hapus Data Anggota"
      :header-bg-variant="'danger'"
      :header-text-variant="'white'"
      :ok-title="'Hapus'"
      :okVariant="'danger'"
      @ok="handleHapus"
    >
      <p>
        <b>{{ hapus.nama_siswa }}</b> akan di hapus, apakah yakin ingin
        menghapusnya?
      </p>
    </b-modal>
  <div class="table-responsive">
    <table class="table v-middle text-nowrap bg-transparent">
      <thead class="bg-light">
        <tr class>
          <th class="border-0">Nama</th>
          <th class="border-0 text-center">Aksi</th>
        </tr>
      </thead>
      
      <tbody v-if="data.eskul.anggota">
        <tr v-for="v in data.eskul.anggota" :key="v.id">
            <td>{{ v.nama_siswa }}</td>
            <td class="text-center">
                <b-button
                    variant="success"
                    size="sm"
                    class="mr-1"
                    @click="edit(v.id)"
                >
                    <i class="fas fa-edit"></i>
                </b-button>
                <b-button
                    variant="danger"
                    size="sm"
                    class="mr-1"
                    @click="hapus_(v.id, v.nama_siswa)"
                >
                    <i class="fas fa-trash"></i>
                </b-button>
            </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</template>

<script>

export default {
    data() {
        return {
            id: this.$route.query.eskul_id,
            data: {
                eskul: null
            },
            length: {
                eskul: null
            },
            hapus: {
                id: null,
                nama_siswa: null
            }
        }
    },
    beforeMount() {
        this.loadAnggota()
    },
    methods: {
        loadAnggota() {
            this.$store.dispatch(`eskul/eskul`, this.id)
                .then(result => {
                    console.log('eskuls:', result)
                    this.$emit('eskul',{ nama: result?.nama_eskul})
                    this.data.eskul = result
                })
                .catch(e => console.log(e))
        },
        edit(id) {
            this.$emit('showEditForm', {id})
            console.log('id anggota: ', id)
        },
        hapus_(id, nama_siswa) {
            console.log('h. id anggota: ', id)
            console.log('h. nama anggota:', nama_siswa)

            this.hapus.id = id
            this.hapus.nama_siswa = nama_siswa

            this.$bvModal.show("modalHapusAnggota");
        },
        async handleHapus(e) {
            e.preventDefault();
            try {
                let hapus_data = await axios.delete(`/api/v1/anggota/${this.hapus.id}`);
            } catch (e) {
                this.$nextTick(() => {
                this.$bvModal.hide("modalHapusAnggota");
                this._alert("Hapus Data Anggota", "Data gagal dihapus.");
                });
            } finally {
                this.$nextTick(() => {
                this.loadAnggota();
                this.$bvModal.hide("modalHapusAnggota");
                this._alert("Hapus Data Anggota", "Data berhasil dihapus.");
                });
            }
        },
        _alert(title, msg) {
            this.$bvModal.msgBoxConfirm(msg, {
                title: title,
                size: "sm",
                buttonSize: "sm",
                okVariant: "danger",
                okTitle: "OK",
                footerClass: "p-2",
                hideHeaderClose: false,
                centered: true,
            });
        },
    }
}
</script>
