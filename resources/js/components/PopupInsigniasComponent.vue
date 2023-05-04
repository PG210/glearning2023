<template>
<div>
    <div class="modal modal-info fade" id="modal-info" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">FELICITACIONES</h4>
        </div>
        <div class="modal-body">
            <p>EXCELENTE, ACABAS DE GANAR UNA INSIGNIA!!!</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">CERRAR</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
    <a data-toggle="modal" data-target="#modal-info" id="modalpopu">.</a>        
</div>

</template>

<script>
    export default {
        data(){
            return{
                popupinsignias: [],
            }
        },
        created() {
        },
        mounted() {
            axios
            .get('http://127.0.0.1:8000/popupinsignias/1')
            .then(response => { 
                console.log(response);
                if (response.data == 1) {
                    document.getElementById("modalpopu").click();                    
                }
            })
            .catch(error => {
                console.log(error.response);
            });        
        },
        methods: {
            
        },        
    }
</script>

