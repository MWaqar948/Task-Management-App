<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"taskAdd"}' class="btn btn-primary" v-if="$store.getters.getToken !== 0">Create</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Tasks</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="col-1">ID</th>
                                    <th class="col-2">Title</th>
                                    <th class="col-5">Description</th>
                                    <th class="col-1">Status</th>
                                    <th class="col-1">Due Date</th>
                                    <th class="col-3" v-if="$store.getters.getToken !== 0">Actions</th>
                                </tr>
                            </thead>
                            <tbody v-if="tasks?.data?.length > 0">
                                <tr v-for="(task,key) in tasks?.data" :key="key">
                                    <td>{{ task.id }}</td>
                                    <td>{{ task.title }}</td>
                                    <td>{{ task.description }}</td>
                                    <td>{{ task.status }}</td>
                                    <td>{{ task.due_date }}</td>
                                    <td v-if="$store.getters.getToken !== 0">
                                        <router-link :to='{name:"taskEdit",params:{id:task.id}}' class="btn btn-success me-2" >Edit</router-link>
                                        <button type="button" @click="deleteTask(task.id)" class="btn btn-danger" >Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="4" align="center">No tasks Found.</td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                    <Pagination align="center" :data="tasks" @pagination-change-page="getTasks"></Pagination>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Bootstrap5Pagination as Pagination } from 'laravel-vue-pagination';
export default {
    name:"tasks",
    components: {
        Pagination
    },
    data(){
        return {
            tasks:[]
        }
    },
    mounted(){
        this.getTasks()
    },
    methods:{
        getTasks(page=1){
            this.axios.get(`/api/tasks?page=${page}`).then(response=>{
                this.tasks = response.data;
            }).catch(error=>{
                console.log(error);
                this.tasks = [];
            })
        },
        deleteTask(id){
            const config = {
                headers: {
                    Authorization: 'Bearer ' + this.$store.getters.getToken,
                }
            };
            if(confirm("Are you sure to delete this task ?")){
                this.axios.delete(`/api/tasks/${id}`, config).then(response=>{
                    this.getTasks();
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    }
}
</script>