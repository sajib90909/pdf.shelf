<template>
    <div>
        <basic-modal
            :modal-id="id"
            @close-modal="$emit('input', false)"
        >
            <slot name="header">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </slot>

            <div class="modal-body">
                <slot></slot>
            </div>

            <slot name="footer">
                <div class="modal-footer">
                    <button v-if="showCloseBtn" type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ closeBtnTitle || 'Close'}}
                    </button>
                    <button v-if="showSubmitBtn" type="button" class="btn btn-primary" @click="$emit('submit')">
                        {{ submitBtnTitle || 'Submit'  }}
                    </button>
                </div>
            </slot>

        </basic-modal>
    </div>
</template>

<script>
import basicModal from "./basicModal";

export default {
    name: "modal",
    components: {basicModal},
    props: {
        id: {},
        title: {},
        showSubmitBtn: {
            default: true
        },
        showCloseBtn: {
            default: true
        },
        submitBtnTitle: '',
        closeBtnTitle: '',
    },
}
</script>

<style scoped>

</style>
