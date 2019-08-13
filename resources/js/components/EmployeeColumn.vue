<template>
    <div class="col px-0 position-relative">
        <hour-row v-for="hour in 24" 
        :employee="employee"
        :hour="hour"
        :key="hour"
        :header-height="headerHeight"
        :row-height="rowHeight" />

        <hour-slot v-for="s in employee.slots"
        :s="s"
        :key="s.id"
        :header-height="headerHeight"
        :row-height="rowHeight" />
    </div>
</template>

<script>
    export default {
        props: ['employee','headerHeight','rowHeight']
    }
</script>
