<template>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead v-if="options.showHeader">
            <tr>
                <th>Sr</th>
                <template v-for="column in options.columns">
                    <th>{{ column.title }}</th>
                </template>
                <th v-if="options.showAction">Actions</th>
            </tr>
            </thead>
            <tbody>
            <template v-for="(columnData, index) in columnsData">
                <tr>
                    <td>{{ fromSr + index }}</td>
                    <template v-for="column in options.columns">
                        <td>
                            <span v-if="column.type === 'text'">
                                {{ findColumnData(column.key, columnData) }}
                            </span>
                            <span v-if="column.type === 'custom-html'"
                                v-html="column.modifier(findColumnData(column.key, columnData), columnData)"
                            />
                        </td>
                    </template>
                    <td v-if="options.showAction">
                        <template v-for="action in options.actions">
                            <template v-if="!action.permission || (action.permission && action.permission(columnData))">
                                <button
                                    type="button"
                                    class="btn btn-sm ml-1 mr-1"
                                    :class="`btn-${action.class || 'light'}`"
                                    @click="actionTrigger(action, columnData, options.tableId)"
                                >
                                    <span v-html="action.icon || action.name"></span>
                                </button>
                            </template>
                        </template>
                    </td>
                </tr>
            </template>
            </tbody>
        </table>
    </div>
</template>

<script>
import {findColumnData} from "../../helpers/FindColumnHelper";

export default {
    name: "tableComponent",
    props: {
        fromSr: {
            default: 1
        },
        columnsData: {},
        options:{}
    },
    data() {
        return {
            findColumnData
        }
    },
    methods: {
        actionTrigger(action, row){
            this.$emit('actionTrigger', action, row)
        }
    }
}
</script>

<style scoped>

</style>
