<template>
    <div class="">
        <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between">
			<p class="text-muted text-center text-md-left dir-ltr">COPYRIGHT © 2019 
                <router-link :to="{ name: 'dashboard' }">EVENT MANAGER </router-link> ALL RIGHTS RESERVED.
            </p>
			<p class="text-muted text-center text-md-left mb-0 d-none d-md-block dir-ltr">
                DEVELOPMENT BY <a href="#" target="_blank">AGENCY</a> WITH 
                <i class="mb-1 text-primary mr-1 icon-small"></i>
                <i class="fa fa-heart icon-fixed"></i>
            </p>
		</footer>
    </div>
</template>

<script>
    export default {
        mounted() {
           //
        }
    }
</script>
