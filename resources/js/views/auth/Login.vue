<template>
    <div class="mx-auto max-w-lg pt-10">
        <form action="#" @submit.prevent="login" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
                    Email Address
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="email"
                       type="email" placeholder="Email Address" v-model="form.email">
            </div>
            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3"
                       id="password" type="password" placeholder="******************" v-model="form.password">
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded" type="button">
                    Sign In
                </button>
                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
                    New User?
                </a>
            </div>
        </form>
    </div>
</template>

<script>
import {mapActions} from 'vuex'

export default {
    name: 'Login',
    data() {
        return {
            form: {
                email: "",
                password: "",
            }
        }
    },
    methods: {
        ...mapActions({
            loginAction: 'auth/login'
        }),

        async login() {
            await this.loginAction(this.form)

            await this.$router.replace({name: 'dashboard'});
        }
    }
};
</script>
