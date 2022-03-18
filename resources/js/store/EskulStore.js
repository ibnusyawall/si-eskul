import axios from 'axios'

export default {
    strict: true,
    namespaced: true,
    mutations: {},
    actions: {
        eskuls({ commit }) {
            return new Promise(async (resolve, reject) => {
                try {
                    let { data } = await axios('/api/v1/eskul')
                    resolve(data?.result)
                } catch (e) {
                    reject(e)
                }
            })
        },

        eskul({ commit }, id) {
            return new Promise(async (resolve, reject) => {
                try {
                    let { data } = await axios(`/api/v1/eskul/${id}`)
                    resolve(data?.result)
                } catch (e) {
                    reject(e)
                }
            })
        },
    },
}
