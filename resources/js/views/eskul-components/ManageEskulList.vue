<template>
<div>
    <b-modal
      id="modalHapusEskul"
      ref="hapus-data"
      title="Hapus Data Eskul"
      :header-bg-variant="'danger'"
      :header-text-variant="'white'"
      :ok-title="'Hapus'"
      :okVariant="'danger'"
      @ok="handleHapus"
    >
      <p>
        <b>{{ hapus.nama_eskul }}</b> akan di hapus, apakah yakin ingin
        menghapusnya?
      </p>
    </b-modal>
  <div class="table-responsive">
    <table class="table v-middle text-nowrap bg-transparent">
      <thead class="bg-light">
        <tr class>
          <th class="border-0">Nama Eskul</th>
          <th class="border-0">Deskripsi</th>
          <th class="border-0">Jumlah Anggota</th>
          <th class="border-0 text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="v in data.eskul" :key="v.id">
            <td>{{ v.nama_eskul }}</td>
            <td>{{ v.deskrispi || '-' }}</td>
            <td>{{ v.anggota.length }}</td>
            <td class="text-center">
                <router-link :to="{ name: 'eskul-anggota', query: { eskul_id: v.id }}">Anggota</router-link> |
                <router-link :to="{ name: 'eskul-pokja', query: { eskul_id: v.id }}">Pokja</router-link> |
                <a href="#" @click="edit(v.id)">Edit</a> |
                <a href="#" @click="hapus_(v.id, v.nama_eskul)">Hapus</a>
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
            hapus: {
                id: null,
                nama_eskul: null
            },
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
        edit(id) {
            this.$emit('editDataEskul', { id: id})
            console.log('id', id)
        },
        hapus_(id, nama_eskul) {
            console.log('id h', id)

            this.hapus.id = id
            this.hapus.nama_eskul = nama_eskul

            this.$bvModal.show("modalHapusEskul");
        },
        async handleHapus(e) {
            e.preventDefault();
            try {
                let hapus_data = await axios.delete(`/api/v1/eskul/${this.hapus.id}`);
            } catch (e) {
                this.$nextTick(() => {
                this.$bvModal.hide("modalHapusEskul");
                this._alert("Hapus Data Anggota", "Data gagal dihapus.");
                });
            } finally {
                this.$nextTick(() => {
                    this.loadEskul();
                    this.$bvModal.hide("modalHapusEskul");
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
    },
    watch: {
        reload: function(v, o) {
            if (v) {
                console.log('new: ', v, 'old:', o)
                this.loadEskul()
            }
        }
    }
}
</script>
