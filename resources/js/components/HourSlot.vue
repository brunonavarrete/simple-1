<template>
    <div class="slot border border-info" 
    :style="{
        top: `${ elemTop }px`,
        height: `${ elemHeight }px`
    }">
        {{ s.begins_at }}
    </div>
</template>

<script>
    export default {
        props: ['headerHeight','rowHeight','s'],
        computed: {
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
        }
    };
</script>

<style lang="scss" scoped>
    .slot {
        position: absolute;
        left: 0;
    }
</style>