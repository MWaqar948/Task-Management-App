<script>
    import { useRouter } from 'vue-router';
    import { useStore } from 'vuex';

    export default {
        setup(){
            const router = useRouter();
            const store = useStore();

            function logout(){
                const config = {
                    headers: {
                        Authorization: 'Bearer ' + this.$store.getters.getToken,
                    }
                };
                this.axios.post('/api/auth/logout',this.task, config).then(response=>{
                }).catch(error=>{
                    console.log(error);
                })
                store.dispatch('removeToken');
                router.push({name:'Login'});
            }

            return {
                logout
            }
        },
        mounted: function(){
            this.logout();
        }
    }
</script>