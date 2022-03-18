import axios from 'axios'

export default {
    strict: true,
    namespaced: true,
    mutations: {},
    actions: {
        anggotas({ commit }) {
            return new Promise(async (resolve, reject) => {
                try {
                    let { data } = await axios('/api/v1/anggota')
                    resolve(data?.result)
                } catch (e) {
                    reject(e)
                }
            })
        },

        anggota({ commit }, id) {
            return new Promise(async (resolve, reject) => {
                try {
                    let { data } = await axios(`/api/v1/anggota/${id}`)
                    resolve(data?.result)
                } catch (e) {
                    reject(e)
                }
            })
        },
    },
}
