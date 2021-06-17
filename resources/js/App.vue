<template>
    <div>
        <Menu />
        <router-view />
    </div>
</template>

<script>
import Menu from './components/layout/Menu.vue';
export default {
    name: 'app',
    components: {
        Menu
    }
    
}
</script>