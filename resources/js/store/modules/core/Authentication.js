import {axiosGet} from "../../../core/helpers/AxiosHelper";

const state = {
    user: {}
};

const getters = {
    getUserInformation: state => {
        return state.user
    }
};

const actions = {
    getUserInformation({commit, state}) {
        axiosGet(`app/authenticate-user`).then(({data}) => {
            commit('PROFILE_PERSONAL_INFO', data)
        })
    },
};

const mutations = {
    PROFILE_PERSONAL_INFO(state, data) {
        state.user = data;
    }
};


export default {
    state,
    getters,
    actions,
    mutations
}
