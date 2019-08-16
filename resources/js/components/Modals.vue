<template>
    <modal-slot
    :clients="clients"
    :date="date"
    :employees="employees"></modal-slot>
</template>

<script>
    export default {
        props: ['clients','date','employees'],
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
