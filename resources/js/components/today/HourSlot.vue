<template>
    <div class="slot p-1 border border-info" 
    :style="{
        top: `${ elemTop }px`,
        height: `${ elemHeight }px`
    }"
    @click="editSlot()">
        <div class="user-data">
            {{ s.begins_at.substr(0,5) }} - {{ s.ends_at.substr(0,5) }}
        </div>
        <div class="more-data" v-if="s.client">
            {{ fullClientsName }}<br>
            {{ s.service.name }}
        </div>
    </div>
</template>

<script>
    export default {
        props: ['headerHeight','rowHeight','s'],
        computed: {
            fullClientsName() {
                return `${ this.s.client.first_name } ${ this.s.client.last_name }`
            },
            elemTop() {
                let hours = this.s.begins_at.substr(0,2)
                let minutes = this.s.begins_at.substr(3,2)
                let fraction = minutes / 60 // hour's fraction
                
                // multiply by row Height
                    let heightFraction = this.rowHeight * fraction
                    let x = this.rowHeight * hours

                // return
                    return x + heightFraction
            },
            elemHeight() {
                let date = this.s.date.replace(/-/g,'/')
                let start = new Date(`${date} ${this.s.begins_at}`)
                let end = new Date(`${date} ${this.s.ends_at}`)
                let diffMs = end - start
                let diffHours = Math.floor((diffMs % 86400000) / 3600000);
                let diffMins = Math.round(((diffMs % 86400000) % 3600000) / 60000)
                let diffMinsToHours = diffMins / 60
                return (diffHours + diffMinsToHours) * this.rowHeight
            }
        },
        methods: {
            editSlot() {
                this.$root.$emit('bv::show::modal', 'modal-slot')
                Event.$emit('modalData', {
                    show: 'slot',
                    action: 'put',
                    data: this.s
                })
            },
        }
    };
</script>

<style lang="scss" scoped>
</style>