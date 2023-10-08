<template>
     <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6 mt-4">
                <h4>Register</h4>

                <form @submit.prevent="register">
                    <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter name" v-model="form.name">
                        <span v-if="error.name" class="error">{{ error.name[0] }}</span>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email" v-model="form.email">
                        <span v-if="error.email" class="error">{{ error.email[0] }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="pwd" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="pwd" placeholder="Enter password" v-model="form.password">
                        <span v-if="error.password" class="error">{{ error.password[0] }}</span>
                        <span><strong>Note:</strong> Password should be 8 characters long and it should have atleast an upper and a lower case letter, a number, and a special character.</span>

                    </div>
                    <div class="mb-3">
                        <label for="pwd" class="form-label">Confirm Password:</label>
                        <input type="password" class="form-control" id="pwd" placeholder="Enter confirm password" v-model="form.password_confirmation">
                        <span v-if="error.password_confirmation" class="error">{{ error.password_confirmation[0] }}</span>
                    </div>
                    <button type="submit" class="btn btn-dark">Register</button>
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
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            });

            let error = ref('');
            const register = async () => {
                await axios.post('/api/auth/register', form).then(res => {
                    error.value='';
                    store.dispatch('setToken', res.data.token);
                    router.push({name: 'Home'});
                }).catch(err => {
                    console.log(err);
                    if(err?.response?.status === 401){
                        error.value = err?.response?.data?.message;
                    }else if  (err.response.status === 422){
                        error.value = err.response.data.errors;
                    }
                });
            }
            return {
                form,
                register,
                error
            };
        },

    }
</script>