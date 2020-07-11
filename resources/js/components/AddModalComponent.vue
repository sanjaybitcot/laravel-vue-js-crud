<template>
	<!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add New Record</h4>
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
                    <textarea name="name" id="name" class="form-control" v-model="record"></textarea>
                    <p v-for="err of validationMessages.name" style="color:red;">
                        {{ err }}
                    </p>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" @click="addRecord">Add</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="clearModel">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    export default{
        mounted() {
            console.log('Add model Component mounted.')
        },
        data(){
            return{
                record:"",
                successMessage:"",
                validationMessages:[],
            }
        },
        methods:{
            addRecord(){
                axios.post("https://localhost/project/learning/laravel_vue/public/tasks",{
                    name:this.record,
                })
                //.then(response => this.display = response.data)
                .then(data => { 
                    this.$emit('recordAdded',data);
                    this.successMessage = "Record added sucessfully";
                    this.record = "";
                    setTimeout(function(){
                      $('#myModal').modal('hide')
                    }, 2000);
                })
                .catch(error => {
                    this.validationMessages = error.response.data.errors;
                });
                
                this.successMessage="";
            },
            clearModel(){
                this.record="";
                this.successMessage="";
                this.validationMessages=[];
            }
        }
    }
</script>

<style type="text/css" scoped></style>