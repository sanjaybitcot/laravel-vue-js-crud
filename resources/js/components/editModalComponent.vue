<template>
	<!-- The Modal -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Record</h4>
                    <button type="button" class="close" data-dismiss="modal" @click="clearModel">&times;</button>
                </div>
                <div class="col-md-12">
                    <div v-if="validationMessages.name">
                        <p v-for="err of validationMessages.name" class="alert alert-danger">
                            {{ err }}
                        </p>
                    </div>
                    <div class="alert alert-success" v-if="successMessage.length > 0">{{ successMessage }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>    
                <!-- Modal body -->
                <div class="modal-body">
                    <label for="name">Add New</label>
                    <textarea name="name" id="name" class="form-control" v-model="rec.name"></textarea>
                    <p v-for="err of validationMessages.name" style="color:red;">
                        {{ err }}
                    </p>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" @click="updateRecord">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="clearModel">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    export default{
        props:['rec'],
        mounted() {
            console.log('Edit model Component mounted.')
        },
        data(){
            return{
                record:"",
                successMessage:"",
                validationMessages:[],
            }
        },
        methods:{
            updateRecord(){
                axios.post("https://localhost/project/learning/laravel_vue/public/tasks/"+this.rec.id,{
                    'name':this.rec.name,
                    '_method':'PUT'
                })
                //.then(response => this.display = response.data)
                .then(data => { 
                    this.$emit('recordUpdated',data);
                    this.successMessage = "Record updateds sucessfully";
                    this.record = "";
                    setTimeout(function(){
                      $('#editModal').modal('hide')
                    }, 2000);
                })
                .catch(error => {
                    this.validationMessages = error.response.data.errors;
                });
                this.successMessage="";
            },
            clearModel(){
                this.successMessage="";
                this.validationMessages=[];
            }
        }
    }
</script>

<style type="text/css" scoped></style>