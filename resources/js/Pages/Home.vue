<template>
    <task-table> </task-table>
</template>
<script>
    import Table from '../components/Tasks/Table.vue';
    export default {
        name: 'Home',
        components: {
            'task-table': Table
        }
    }
</script>