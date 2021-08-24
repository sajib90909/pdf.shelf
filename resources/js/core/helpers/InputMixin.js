export default {
    props: {
        data: {},
        value: {}
    },
    data() {
        return {
            fieldValue: ''
        }
    },
    computed: {
        inputFieldId() {
            return this.data.id || this.$parent.name
        },
        listeners() {
            return {
                ...this.$listeners,
                input: event => {
                    if (this.data.type === 'file') {
                        this.fieldValue = event.target.files[0];
                        this.$emit('input', this.fieldValue);
                    } else
                        this.$emit('input', event.target.value);
                }
            }
        }
    },
}
