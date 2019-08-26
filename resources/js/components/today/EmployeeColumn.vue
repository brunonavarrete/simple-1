<template>
    <div class="employee-column col px-0 position-relative" v-if="employee.active">
        <hour-row v-for="hour in 24" 
        :employee="employee"
        :employee-index="index"
        :hour="hour"
        :key="hour"
        :header-height="headerHeight"
        :row-height="rowHeight" />

        <hour-slot v-for="s,index in employee.slots"
        :s="s"
        :key="`s${s.id}`"
        :header-height="headerHeight"
        :row-height="rowHeight"
        :class="`slot--${index}`" />
    </div>
</template>

<script>
    export default {
        props: ['employee','headerHeight','index','rowHeight']
    }
</script>
