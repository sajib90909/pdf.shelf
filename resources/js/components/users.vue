<<template>
    <div>
        <app-page-title title="Users"/>

        <app-table
            :options="options"
            :id="tableId"
            @action="actionTrigger"
        />

        <user-update-modal
            id="user-modal"
            :table-id="tableId"
            v-model="isUserUpdateModalActive"
            v-if="isUserUpdateModalActive"
            :selected-url="selectedUrl"
            :from-admin-panel="true"
        />

    </div>
</template>

<script>
import ActionHelperMixin from "../core/helpers/ActionHelperMixin";
import userMixins from "./mixins/userMixins";
import UserUpdateModal from "./components/UserUpdateModal";
import {urlGenerator} from "../core/helpers/AxiosHelper";
export default {
    name: 'users',
    components: {UserUpdateModal},
    mixins: [userMixins, ActionHelperMixin],
    data() {
        return {
            isUserUpdateModalActive: false,
            selectedUrl: ''
        }
    },
    mounted() {

    },
    methods: {
        editAction(row){
            this.selectedUrl = `app/admin-panel/users/${row.id}`
            this.openModal()
        },
        deleteAction(row){
            // axiosDelete(`${this.options.url}/${row.id}`).then((response) => {
            //     this.$hub.$emit('reload-'+this.tableId)
            // })
        },
        viewAction(row){
            window.open(urlGenerator(`profile/${row.id}`), '_blank');
        },
        openModal(){
            this.isUserUpdateModalActive = true;
        }
    }
}
</script>
