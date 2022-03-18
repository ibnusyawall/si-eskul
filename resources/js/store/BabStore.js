import axios from 'axios'

export default {
    strict: true,
    namespaced: true,
    mutations: {},
    actions: {
        babs({ commit }) {
            return new Promise(async (resolve, reject) => {
                try {
                    let { data } = await axios('/api/v1/bab')
                    resolve(data?.result)
                } catch (e) {
                    reject(e)
                }
            })
        },

        bab({ commit }, id) {
            return new Promise(async (resolve, reject) => {
                try {
                    let { data } = await axios(`/api/v1/bab/${id}`)
                    resolve(data?.result)
                } catch (e) {
                    reject(e)
                }
            })
        },
    },
}
