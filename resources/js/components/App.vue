<template>
    <main>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <router-link to="/" class="navbar-brand" href="/">Todo App</router-link>
            </div>
        </nav>
        <div class="container mt-5">
            <router-view></router-view>
        </div>
    </main>
</template>
<style>
.error{
    margin-top: 0.25rem;
    font-size: .875em;
    color: #dc3545;

}
</style>
<script>

    export default {}
</script>