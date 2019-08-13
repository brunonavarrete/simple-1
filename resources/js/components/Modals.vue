<template>
    <modal-slot v-if="modalData.show == 'slot'"></modal-slot>
</template>

<script>
    export default {
        data() {
            return {
                modalData: {}
            }
        },
        mounted() {
            Event.$on('modalData', obj => { this.modalData = obj })
        }
    }
</script>
