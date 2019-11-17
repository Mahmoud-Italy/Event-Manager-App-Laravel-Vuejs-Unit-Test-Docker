<template>
    <div class="">
        
        <div class="main-wrapper">
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">

                <div class="row w-100 mx-0 auth-page">
                    <div class="col-md-8 col-xl-6 mx-auto d-flex flex-column align-items-center">
                        <img src="/assets/images/404.svg" class="img-fluid mb-2" alt="550">
                        <h1 class="font-weight-bold mb-22 mt-2 tx-80 text-muted">550</h1>
                        <h4 class="mb-2">Access Denied</h4>
                        <h6 class="text-muted mb-3 text-center">Oopps!! There was an error. this page could be higher your authority.</h6>
                        <router-link :to="{ name: 'login' }" class="btn btn-primary-muted">Back to home</router-link>
                    </div>
                </div>

            </div>
        </div>
    </div>

    </div>
</template>

<script>
    export default {
        mounted() {
            //
        }
    }
</script>