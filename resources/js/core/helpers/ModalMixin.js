export default {
    props: {
        value: {
            required: true
        },
        tableId: {}
    },
    data() {
        return {
            showModal: false
        }
    },
    created() {
        this.showModal = this.value;
    },
    watch: {
        showModal: function (value) {
            if (!value) {
                this.$emit('input', value)
            }
        }
    },
}
