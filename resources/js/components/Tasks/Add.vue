<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Task</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create">
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
                            <!-- <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" v-model="task.status">
                                        <option disabled value="">Please select status</option>
                                        <option value="pending">Pending</option>
                                        <option value="in-progress">In Progress</option>
                                        <option value="completed">Completed</option>
                                    </select>
                                    <span v-if="errors.status" class="error">{{ errors.status[0] }}</span>
                                </div>
                            </div> -->
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Due Date</label>
                                    <input type="date" class="form-control" v-model="task.due_date">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save</button>
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
    name:"add-task",
    data(){
        return {
            task:{
                title:"",
                description:"",
                // status:"",
                due_date:"",
            },
            errors: {},
        }
    },
    methods:{
        async create(){
            await this.axios.post('/api/tasks',this.task).then(response=>{
                this.$router.push({name:"taskList"})
            }).catch(error=>{
                console.log(error)
                if (error.response.status === 422){
                  this.errors = error.response.data.errors;
                }
            })
        }
    },
}
</script>