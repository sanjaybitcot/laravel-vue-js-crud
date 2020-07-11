<template>
	<!-- The Modal -->
    <div class="modal fade" id="viewModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">View Task</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>   
                <!-- Modal body -->
                <div class="modal-body">
                    <b><label for="name">Title</label></b>
                    <p>{{ viewRec.name }}</p>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    export default{
        props:['viewRec'],
    }
</script>

<style type="text/css" scoped></style>