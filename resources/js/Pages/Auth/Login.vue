<template>
   <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6 mt-4">
                <h4>Login</h4>

                <form @submit.prevent="login">
                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email" v-model="form.email">
                    </div>
                    <div class="mb-3">
                        <label for="pwd" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="pwd" placeholder="Enter password" v-model="form.password">
                    </div>
                    <p class="text-danger" v-if="error">{{ error }}</p>

                    <button type="submit" class="btn btn-dark">Submit</button>
                </form>
            </div>
        </div>
   </div>
</template>
<script>
    import { reactive, ref } from 'vue';
    import { useRouter } from 'vue-router';
    import { useStore } from 'vuex';
    export default{
        setup(){
            const router = useRouter();
            const store = useStore();

            let form = reactive({
                email: '',
                password: '',
            });

            let error = ref('');
            const login = async () => {
                await axios.post('/api/auth/login', form).then(res => {
                    error.value='';
                    store.dispatch('setToken', res.data.token);
                    router.push({name: 'Home'});
                }).catch(err => {
                    console.log(err);
                    if(err?.response?.status === 401){
                        error.value = err?.response?.data?.message;
                    }
                });
            }
            return {
                form,
                login,
                error
            };
        },

    }
</script>