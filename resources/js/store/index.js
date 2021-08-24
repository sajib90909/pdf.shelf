import Vue from "vue";
import Vuex from "vuex";

import QueryFilter from "./modules/core/QueryFilter";
import Authenticate from "./modules/core/Authentication";

Vue.use(Vuex)

export default {
    modules: {
        QueryFilter,
        Authenticate
    }
}
