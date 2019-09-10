<template>
    <div class="container-fluid">
        <menu-component></menu-component>
        <router-view></router-view>          <!--  hien thi toan bo route -->
        <vue-progress-bar></vue-progress-bar>
    </div>
</template>

<script>
    import Menu from './components/menu.vue';
    export default {
        data(){
            return {

            }
        },components : {
            'menu-component' : Menu,
        }
    }
</script>


