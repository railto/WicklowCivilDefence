<template>
    <div class="h-screen bg-gray-100">
        <template v-if="authenticated">
            <Navbar/>

            <div class="w-full mx-auto px-40">
                <RouterView/>
            </div>
        </template>

        <template v-if="!authenticated">
            <RouterView/>
        </template>
    </div>
</template>

<script>
import {mapGetters} from 'vuex';

import Navbar from './components/Navbar';

export default {
    components: {
        Navbar
    },
    computed: {
        ...mapGetters({
            authenticated: 'auth/authenticated',
        }),
    },
};
</script>
