<template>

    <!--Create Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update task</h5>
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
                            <input v-model="new_update_task.name" id="name" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="body">Description</label>
                            <input v-model="new_update_task.body" id="body" type="textarea" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button @click="updateTask" type="button" class="btn btn-primary">Update</button>
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
                    id:'',
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

            updateModal(index){
                this.errors = [];
                $("#updateModal").modal("show");
                this.new_update_task = this.tasks[index];
            },

            updateTask(){
                console.log(this.new_update_task.name);
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
