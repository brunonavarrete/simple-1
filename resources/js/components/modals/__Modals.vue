<template>
    <div>
        <modal-client></modal-client>
        
        <modal-employee 
        :stores="stores"></modal-employee>

        <modal-service></modal-service>

        <modal-slot
        :clients="clients"
        :date="date"
        :employees="employees"
        :services="services"
        :stores="stores"></modal-slot>

        <modal-store></modal-store>
    </div>
</template>

<script>
    export default {
        props: ['clients','date','employees','services','stores'],
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
