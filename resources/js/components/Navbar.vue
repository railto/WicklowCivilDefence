<template>
    <nav class="flex items-center justify-between px-4 lg:px-32 py-2 flex-wrap mb-12 w-full z-10 top-0 bg-gray-600">
        <div class="flex items-center text-white mr-6">
            <a class="flex items-center text-white" href="/">
                <span class="mx-3 text-xl">{{ $appName }}</span>
            </a>
        </div>

        <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto block shadow-3xl">
            <ul class="pt-6 lg:pt-0 mb-0 list-reset lg:flex justify-end flex-1 items-center">
                <li class="mr-3">
                    <RouterLink :to="{name: 'Dashboard'}" class="inline-block py-2 px-4 text-white no-underline">
                        Dashboard
                    </RouterLink>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
import {mapGetters, mapActions} from 'vuex';

export default {
    name: 'Navbar',
    computed: {
        ...mapGetters({
            authenticated: 'auth/authenticated',
        }),
    },
    methods: {
        ...mapActions({
            logoutAction: 'auth/logout',
        }),
        async logout() {
            await this.logoutAction();

            await this.$router.replace({name: 'login'});
        },
    },
};
</script>
