<template>
    <div class="modal fade" :id="modalId" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div v-if="$slots.header" :key="modalId+'header'" class="modal-header">
                    <slot name="header"></slot>
                </div>

                <div v-if="$slots.body" :key="modalId+'body'" class="modal-body custom-scrollbar" :class="modalBodyClass">
                    <slot name="body"></slot>
                </div>

                <div v-if="$slots.footer" :key="modalId+'footer'" class="modal-footer">
                    <slot name="footer"></slot>
                </div>
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "basicModal",
    props: {
        modalId: {}
    },
    mounted() {
        $('.modal').on('shown.bs.modal', (e) => {
            $('html').css('overflow-y', 'hidden');
        })

        $('#' + this.modalId).on('hidden.bs.modal', (e) => {
            $('html').css('overflow-y', 'auto');
            this.$emit('close-modal', false);
        });

        $('#' + this.modalId).modal('show');
    }
}
</script>

<style scoped>

</style>
