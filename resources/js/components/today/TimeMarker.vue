<template>
    <div id="time-marker" :style="`top: ${top}px`">
        <span>{{ `${ nowText }` }}</span>
    </div>
</template>

<script>
    export default {
        props: ['headerHeight','rowHeight'],
        mounted() {
            setTimeout(() => { this.initialScroll() }, 1000)
        },
        data() {
            return {
                todayDate: new Date
            }
        },
        computed: {
            now() {
                let date = this.todayDate
                let hours = date.getHours()
                let minutes = date.getMinutes()
                
                return { hours: hours, minutes: minutes }
            },
            nowText() {
                let now = this.now
                let hours = now.hours < 10 ? `0${ now.hours }` : now.hours
                let minutes = now.minutes < 10 ? `0${ now.minutes }` : now.minutes

                return `${ hours }: ${ minutes }`
            },
            top() {
                let oneMinute = this.rowHeight / 60
                let minutePixels = oneMinute * this.now.minutes
                let hourPixels = this.now.hours * this.rowHeight
                
                return hourPixels + minutePixels + this.headerHeight
            },
            initialScroll() {
                let offset = window.innerHeight * 0.5
                window.scroll({
                    behavior: 'smooth',
                    left: 0,
                    top: this.top - offset
                })
                setInterval(() => { this.todayDate = new Date }, 1000)
            }
        },
    };
</script>