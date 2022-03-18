<template>
<div>
  <b-modal
      id="modalHapusBab"
      ref="hapus-data"
      title="Hapus Data Bab"
      :header-bg-variant="'danger'"
      :header-text-variant="'white'"
      :ok-title="'Hapus'"
      :okVariant="'danger'"
      @ok="handleHapus"
    >
      <p>
        <b>{{ hapus.nama_bab }}</b> akan di hapus, apakah yakin ingin
        menghapusnya?
      </p>
  </b-modal>
   <b-modal id="modal-scrollable" scrollable :title="nama_bab">
         <template v-if="subbab">
            <p class="my-4" v-for="(v, i) in subbab" :key="i">
                {{ bab_id }}.{{ i+1 }} {{ v.nama_subbab }}<br/>
                {{ v.isi_subbab }}
            </p>
         </template>
  </b-modal>

  <div class="table-responsive">
    <table class="table v-middle text-nowrap bg-transparent">
      <thead class="bg-light">
        <tr class>
          <th class="border-0">BAB</th>
          <th class="border-0">Total SUB BAB</th>
          <th class="border-0 text-center">Aksi</th>
        </tr>
      </thead>

      <tbody v-if="data.bab">
        <tr v-for="v in data.bab" :key="v.id">
            <td>{{ v.nama_bab }}</td>
            <td>{{ v.subbab.length }}</td>
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
                    @click="hapus_(v.id, v.nama_bab)"
                >
                    <i class="fas fa-trash"></i>
                </b-button>
                <b-button
                    variant="primary"
                    size="sm"
                    class="mr-1"
                    @click="view(v.id, v.nama_bab)"
                >
                    <i class="fas fa-eye"></i>
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
    props: ['id_eskul'],
    data() {
        return {
            data: {
                 bab: null
            },
            length: {
                bab: null
            },
            hapus: {
                id: null,
                nama_bab: null
            },
            nama_bab: null,
            bab: null,
            bab_id: null,
            subbab: null
        }
    },
    beforeMount() {
        this.loadBab()
    },
    methods: {
        loadBab() {
            console.log('bab id eskul:', this.id_eskul)
            this.$store.dispatch(`eskul/eskul`, this.id_eskul)
                .then(result => {
                    const { bab } = result
                    console.log('eskuls:', result)
                    this.$emit('babList', { bab: bab })
                    this.$emit('namaEskul',{ nama: result?.nama_eskul })
                    this.data.bab = bab
                })
                .catch(e => console.log(e))
        },
        edit(id) {
            this.$emit('showEditForm', {id})
            console.log('id bab: ', id)
        },
        hapus_(id, nama_bab) {
            console.log('h. id bab: ', id)
            console.log('h. nama bab:', nama_bab)

            this.hapus.id = id
            this.hapus.nama_bab = nama_bab

            this.$bvModal.show("modalHapusBab");
        },
        view(id, nama_bab) {
            this.nama_bab = nama_bab
            this.bab_id = this.data.bab.findIndex(v => v.id == id) + 1
            const filter = this.data.bab.filter(v => v.id == id)[0]
            this.subbab = filter.subbab
            console.log('subbab', filter)
            console.log('bab_id:', this.bab_id)
            this.$bvModal.show("modal-scrollable");
        },
        async handleHapus(e) {
            e.preventDefault();
            try {
                let hapus_data = await axios.delete(`/api/v1/bab/${this.hapus.id}`);
            } catch (e) {
                this.$nextTick(() => {
                    this.$bvModal.hide("modalHapusBab");
                    this._alert("Hapus Data Bab", "Data gagal dihapus.");
                });
            } finally {
                this.$nextTick(() => {
                    this.loadBab();
                    this.$bvModal.hide("modalHapusBab");
                    this._alert("Hapus Data Bab", "Data berhasil dihapus.");
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
