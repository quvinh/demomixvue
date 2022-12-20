<template>
    Users...
</template>

<script>
import { useMenu } from '../../../stores/use-menu';
export default {
    setup() {
        useMenu().onSelectKeys(['admin-users']);
    },
}
</script>
