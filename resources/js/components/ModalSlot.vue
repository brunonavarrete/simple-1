<template>
    <b-modal id="modal-1" :title="modalData.action == 'post' ? 'Nueva cita' : 'Editar Cita'">
        <p class="my-4">Llena los siguientes campos:</p>
        <div class="form-group">
            <label>Empleado:</label>
            <input class="form-control" v-model="formData.employee" />
        </div>
        <autocomplete :source="[{id:1,name:'abc'},{id:2,name:'def'}]"></autocomplete>
    </b-modal>
</template>

<script>
    import { BModal } from 'bootstrap-vue'
    export default {
        components: {
            'b-modal': BModal,

        },
        data() {
            return {
                modalData: {}
            }
        },
        computed: {
            formData() {
                let data = this.modalData.data
                return {
                    time: data.time ? data.time : '',
                    employee: data.employee ? data.employee.id : 0,
                    client: data.client ? data.client.id : 0
                }
            }
        },
        mounted() {
            Event.$on('modalData', obj => { this.modalData = obj })
        }
    }
</script>
