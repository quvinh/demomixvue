<template>
    Roles...
</template>

<script>
import { useMenu } from '../../../stores/use-menu';
export default {
    setup() {
        useMenu().onSelectKeys(['admin-roles']);
    },
}
</script>
