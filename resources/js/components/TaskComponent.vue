<template>
    <div>
        <button @click="createModal" class="btn btn-primary btn-block">Add a new task</button>

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
                <tr v-for="task in tasks" v-bind:key="task">
                    <td>{{task.id}}</td>
                    <td>{{task.name}}</td>
                    <td>{{task.body}}</td>
                    <td><button type="button" class="btn btn-info btn-sm">Edit</button></td>
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

                uri: 'http://localhost:8000/tasks/'
            }
        },

        methods: {

            createModal(){
                $('#createModal').modal("show");
            },

          /*   createTask(){
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
 */

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
