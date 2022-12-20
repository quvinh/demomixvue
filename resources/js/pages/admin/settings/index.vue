<template>
    Settings...
</template>

<script>
import { useMenu } from '../../../stores/use-menu';
export default {
    setup() {
        useMenu().onSelectKeys(['admin-settings']);
    },
}
</script>
