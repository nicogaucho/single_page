<template>

    <!--Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" v-if="errors.length > 0">
                        <ul>
                            <li v-for="error in errors" v-bind:key="error">{{error}}</li>
                        </ul>
                    </div>
                    <form>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input v-model="task.name" type="text" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="body">Description</label>
                            <input v-model="task.body" type="textarea" class="form-control" id="body">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button @click="createTask" type="button" class="btn btn-primary">Create</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                task: {
                    name: '',
                    body: ''
                },

                tasks: [],

                uri: 'http://localhost:8000/tasks', 
                errors: [],
                new_update_task: []
            }
        },

        methods: {

            createModal(){
                $('#createModal').modal("show");
            },

            createTask(){
               axios.post(this.uri, {
                   name: this.task.name,
                   body: this.task.body
               }).then(response=>{
                   this.tasks.push(response.data.task);
                   $('#createModal').modal("hide");
                   // emit event close-modal
               }).catch(error=>{
                   this.errors = [];
                   if(error.response.data.errors.name){
                       this.errors.push(error.response.data.errors.name[0]);
                   }
                   if(error.response.data.errors.body){
                       this.errors.push(error.response.data.errors.body[0]);
                   }
               });
            },

            updateModal(index){
                this.errors = [];
                $('#updateModal').modal("show");
                this.new_update_task = this.tasks[index];
            },


           loadTasks() {
                axios.get(this.uri).then(response => {
                    this.tasks = response.data.tasks
                });
            }
        },

        mounted() {
            this.loadTasks();
        } 
    }
    

</script>

<style>

</style>
