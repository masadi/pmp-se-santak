<template>
    <div class="page">
        <nav class='navbar navbar-dark bg-dark'>
            <div class='container'>
                <router-link :to="{ name: 'home' }" class="navbar-brand">SmartEDS Khusus Korwil Timur</router-link>
                <span class="top-right links navbar-brand">Versi 1.0.1</span>
            </div>
        </nav>
        <router-view></router-view>
    </div>
</template>