import axios from 'axios'

export default {
    strict: true,
    namespaced: true,
    state: {
        id: null,
    },
    mutations: {},
    actions: {
        subbabs({ commit }) {
            return new Promise(async (resolve, reject) => {
                try {
                    let { data } = await axios('/api/v1/sub-bab')
                    resolve(data?.result)
                } catch (e) {
                    reject(e)
                }
            })
        },

        subbab({ commit }, id) {
            return new Promise(async (resolve, reject) => {
                try {
                    let { data } = await axios(`/api/v1/sub-bab/${id}`)
                    resolve(data?.result)
                } catch (e) {
                    reject(e)
                }
            })
        },
    },
}
