<template>
<div class="container">
   <router-view></router-view>
   <app-footer></app-footer>
</div>
</template>

<script>
import AppFooter from './layouts/Footer.vue'
import AppHeader from './layouts/Header.vue'

export default {
  components: { AppHeader, AppFooter },
}
</script>

<style lang="scss" >
    .html {
    font-size: 62.5% !important;
    }
    .container{
        background-color: rgb(239, 241, 241);
        max-width: 60rem;
        height: 100%;
        position: relative;
    }
    .row{
        margin-right: 0;
        margin-left: 0;
    }
</style>
