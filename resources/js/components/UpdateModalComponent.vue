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
                    <button @click="updateTask()" type="button" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { eventBus } from './../app'

    export default {
        data() {
            return {
                task: {
                    name: '',
                    body: ''
                },

                tasks: [],

                uri: 'http://localhost:8000/task/',
                
                errors: [],

                new_update_task: {
                    name : '',
                    body : ''
                }
            }
        },

        methods: {

            /* createModal(){
                $('#createModal').modal("show");
            },
 */
            /* updateModal(index){
                this.errors = [];
                $("#updateModal").modal("show");
                this.new_update_task = this.tasks[index];
            }, */
 
            /* loadTasks() {
                axios.get(this.uri).then(response => {
                    // console.log(response.data)
                    this.tasks = response.data.tasks
                });
            }, */

            loadTask(id){
                axios.get(this.uri + id).then(response => {
                    // console.log(response.data);
                    this.new_update_task.name = response.data.name;
                    this.new_update_task.body = response.data.body;
                });
            },


            updateTask(){
                axios.patch(this.uri + this.new_update_task.id, {
                   name: this.new_update_task.name,
                   body: this.new_update_task.body
               })
               .then(response=>{
                   $('#updateModal').modal("hide");
                    eventBus.$emit('close-modal', id);
               }).catch(error=>{
                   this.errors = [];
                   if(error.response.data.errors.name){
                       this.errors.push(error.response.data.errors.name[0]);
                   }
                   if(error.response.data.errors.body){
                       this.errors.push(error.response.data.errors.body[0]);
                   }
                });
            }
        },  

        created() {
            eventBus.$on('show-modal', (id) => {
               this.loadTask(id);
            });
        } 
    }
    

</script>

<style>

</style>
