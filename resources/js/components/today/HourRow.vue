<template>
    <div class="hour px-3 py-2 border-top border-right"
    :style="`height: ${rowHeight}px`" 
    @click="createSlot">
        <span v-if="!employeeIndex"><!-- if is first element -->
            {{ `${ twoDigits(realHour) }:00` }}
        </span>
    </div>
</template>

<script>
    import { VBModal } from 'bootstrap-vue'
    Vue.directive('b-modal', VBModal)

    export default {
        props: ['employee','employeeIndex', 'headerHeight','hour','rowHeight'],
        computed: {
            realHour() {
                return +(this.hour) - 1
            }
        },
        methods: {
            twoDigits(number) {
                return number < 10 ? `0${number}` : number
            },
            createSlot(event) {
                let time = this.calculateTimeClicked(event.pageY - this.headerHeight)
                this.$root.$emit('bv::show::modal', 'modal-slot')
                Event.$emit('modalData', {
                    show: 'slot',
                    action: 'post',
                    data: {
                        begins_at: time,
                        client: false,
                        employee: this.employee,
                        service: false,
                    }
                })
            },
            calculateTimeClicked(coordY) {
                // DOM element height
                    const elemHeight = +(this.rowHeight)
                // limit 15 threshold to be clicked
                    let quarterHeight = elemHeight / 4 
                /*
                 / Calculate where inside the component the user clicked
                 / Do NOT touch
                */
                    let hourClicked = this.realHour * elemHeight
                    let elemClickedY = coordY - hourClicked
                    let quarterClicked = Math.floor(elemClickedY / quarterHeight)
                    let quarterClickedMinutes = quarterClicked * 15
                // Format and return
                    let fullHour = this.twoDigits(this.realHour)
                    let fullMinutes = this.twoDigits(quarterClickedMinutes)
                    let finalTime = `${ fullHour }:${ fullMinutes }:00`

                    return finalTime
            }
        }
    };
</script>