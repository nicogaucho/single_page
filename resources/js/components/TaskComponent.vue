<template>
    <div>
        <button @click="loadCreateModal" class="btn btn-primary btn-block">Add a new task</button>

        <br>

        <table class="table table-borderless">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Body</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(task, index) in tasks" v-bind:key="index">
                    <td>{{index + 1}}</td>
                    <td>{{task.name}}</td>
                    <td>{{task.body}}</td>
                    <td><button @click="loadUpdateModal(index)" type="button" class="btn btn-info btn-sm">Edit</button></td>
                    <td><button type="button" class="btn btn-danger btn-sm">Delete</button></td>
                </tr>
            </tbody>
        </table>
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

            loadCreateModal(){
                $('#createModal').modal("show");
            },

            createTask(){
               axios.post(this.uri, {
                   name: this.task.name,
                   body: this.task.body
               }).then(response=>{
                   this.tasks.push(response.data.task);
                   $('#createModal').modal("hide");
               }).catch(error=>{
                   console.log(error);
               });
            },
        
            
            loadUpdateModal(index){
                this.errors = [];
                this.new_update_task = this.tasks[index];
                $('#updateModal').modal("show");
                
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
