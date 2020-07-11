<template>
	<div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
            	<div id="success_message" class="alert alert-success" v-if="successMessage.length > 0" style="display:none;">{{ successMessage }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card">
                    <div class="card-header">
                    	<h2>All Todo Task
	                    	<span  style="float: right"> 
	                    		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
								Add New
								</button> 
	                    	</span>
                    	</h2> 
                    </div>

                    <div class="card-body">
                    	<input type="search" class="form-control" v-model="search" @keyup="searchRecord()" placeholder="Type title and search">
                        <ul class="list-group pt-4" v-if="display.data">
                        	<li class="list-group-item" v-for="t in display.data">
                        		{{ t.id }} {{ t.name }} 
                        		<span style="float: right">
                    			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#viewModal" @click="getRecord(t.id)">View</button> 
                    			<button class="btn btn-danger" @click="delRecord(t.id)">Delete</button> 
                    			<button class="btn btn-secondary" data-toggle="modal" data-target="#editModal" @click="getRecord(t.id)">Edit</button></span>
                        	</li>
                        </ul>
                        <pagination :data="display" @pagination-change-page="getResults"></pagination>
                    </div>

                    <div class="card-footer text-muted">
                        copyright @2020
                    </div>
                </div>
            </div>
        </div>
        <div id="modal">
        	<add_task @recordAdded="refreshRecord"></add_task>
        	<edit_task :rec="editRec" @recordUpdated="refreshRecord"></edit_task>
        	<view_task :viewRec="editRec"></view_task>
        </div>
    </div>
</template>

<script type="text/javascript">
	//script for pagination
	Vue.component('pagination', require('laravel-vue-pagination'));

	import addTask from './AddModalComponent.vue';
	Vue.component('add_task',addTask);

	import editTask from './editModalComponent.vue';
	Vue.component('edit_task',editTask);

	import viewTask from './viewModalComponent.vue';
	Vue.component('view_task',viewTask);
	export default{
		data(){
			return {
				display:{},
				editRec:{},
				errors:{},
				successMessage:"",
				search:"",
			}
		},
		methods:{
			//use method for pagination
			getResults(page = 1) {
				axios.get('https://localhost/project/learning/laravel_vue/public/tasks?page=' + page)
				.then((response) => this.display = response.data)
				.catch((error) => console.log(error));
			},
			refreshRecord(response){
				this.display = response.data;
			},
			getRecord(id)
			{
				axios.get("https://localhost/project/learning/laravel_vue/public/tasks/"+id+"/edit")
				.then(response=>this.editRec=response.data)
				.catch(error=>this.errors = error.response.data.errors);
			},
			delRecord(id)
			{
				const reply = confirm('Are you confirm, you want to delete this record?');
				if(reply)
				{
					axios.post("https://localhost/project/learning/laravel_vue/public/tasks/"+id,{
                    '_method':'DELETE'
					})
					.then(response=>{
						$('#success_message').show();
						this.refreshRecord(response);
						this.successMessage = "Record deleted sucessfully";
						setTimeout(function(){
                      		$('#success_message').hide();
                    	}, 2000);
					})
					.catch(error=>this.errors = error.response.data.errors);
				}
				else
				{
					return false;
				}
			},
			searchRecord(search){
				if(this.search.length >= 3)
				{
					axios.get("https://localhost/project/learning/laravel_vue/public/tasks/search/"+this.search)
					.then((response)=>this.display = response.data)
					.catch(error=>console.log(error));
				}
				else{
					this.getResults();
				}
			}
		},
		created(){
			axios.get("https://localhost/project/learning/laravel_vue/public/tasks")
			.then((response) => this.display = response.data)
			.catch((error) => console.log(error));
			console.log('Todo component mounted');
		},
	}
</script>

<style type="text/css" scoped></style>

