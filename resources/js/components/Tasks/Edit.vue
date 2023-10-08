<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Task</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="update">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" v-model="task.title">
                                    <span v-if="errors.title" class="error">{{ errors.title[0] }}</span>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" class="form-control" v-model="task.description">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" v-model="task.status">
                                        <option disabled value="">Please select status</option>
                                        <option value="pending">Pending</option>
                                        <option value="in-progress">In Progress</option>
                                        <option value="completed">Completed</option>
                                        <span v-if="errors.status" class="error">{{ errors.status[0] }}</span>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Due Date</label>
                                    <input type="date" class="form-control" v-model="task.due_date">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"update-task",
    data(){
        return {
            task:{
                title:"",
                description:"",
                status:"",
                due_date:"",

                _method:"patch"
            },
            errors: {}
        }
    },
    mounted(){
        this.showtask()
    },
    methods:{
        async showtask(){
            await this.axios.get(`/api/tasks/${this.$route.params.id}`).then(response=>{
                const { title, description, status, due_date } = response.data.task;
                this.task.title = title
                this.task.description = description
                this.task.status = status
                this.task.due_date = due_date
            }).catch(error=>{
                console.log(error)
            })
        },
        async update(){
            await this.axios.post(`/api/tasks/${this.$route.params.id}`,this.task).then(response=>{
                this.$router.push({name:"taskList"})
            }).catch(error=>{
                console.log(error)
                if (error.response.status === 422){
                    this.errors = error.response.data.errors;
                }
            })
        }
    }
}
</script>