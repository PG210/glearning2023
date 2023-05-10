<template>

<div class="panel panel-default" style="margin-top: 5%; margin-bottom: 5%;">
    <div class="panel-heading">Tipo de Reto</div>
    <div class="panel-body">
        <div class="col-md-5">
            <div class="form-group">
                <select class="form-control" name="challenge_type_id" v-model="key">
                    <option>Seleccione un Tipo Reto</option>                
                    <option v-for="tiposreto in tiposretos" :value="tiposreto.id" v-bind:key="tiposreto.id">{{ tiposreto.name }}</option>        
                </select>        
            </div>
        </div>
        <div class="col-md-12">
        </div>

        <!-- QUICCESS -->
        <div v-if="key==1">
            <div class="col-md-3">
                <div class="form-group">             
                    <label for="encuestas">Encuestas</label>
                    <select class="form-control" name="encuestaelegida">                        
                        <option value="">Seleccione Encuesta</option>
                        <option v-for="encuesta in encuestas" :value="encuesta.id" v-bind:key="encuesta.id">{{ encuesta.name }}</option>                    
                    </select>
                    <a href="http://evolucion.website/quizzes"> Ir a: Crear Quizzes</a>
                    
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group"> 
                    <label for="time">Tiempo - Minutos</label>
                    <input type="number" class="form-control" name="time" id="time" min="1" v-model="tiempo">
                </div>
            </div>
        </div>

        <!-- AHORCADO -->
        <div v-if="key==2">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="Ahorcado">Palabra para ahorcado</label>
                    <input type="text" class="form-control" name="ahorcado" maxlength="10" v-model="palabra">
                </div>
            </div>               
            <div class="col-md-3">        
                <div class="form-group" >
                    <label for="dificultad">Dificultad</label>
                    <select class="form-control" name="dificultad">
                        <option value="0">Facil</option>
                        <option value="1">Dificil</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group" > 
                    <label for="time">Tiempo - Minutos</label>
                    <input type="number" class="form-control" name="time" id="time" min="1" v-model="tiempo">
                </div> 
            </div>
        </div>

        <!-- VER VIDEOS -->
        <div v-if="key==5" >
            <div class="col-md-3">
                <div class="form-group">
                  <!---<label for="urlvideo">URL Video</label>
                    <input type="text" class="form-control" name="urlvideo" id="urlvideo" v-model="urlmaterial" placeholder="video ayuda para Reto">
                  -->
                  <label for="urlvideo">Video MP4</label>
                  <input type="file" class="form-control" name="video" id="video" placeholder="video ayuda para Reto" accept="video/mp4,video/x-m4v,video/*">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group" >
                    <label for="dificultad">Dificultad</label>
                    <select class="form-control" name="dificultad">
                        <option value="0">Facil</option>
                        <option value="1">Dificil</option>
                    </select>
                </div>
            </div>  
            <div class="col-md-3">
                <div class="form-group" > 
                    <label for="time">Tiempo - Minutos</label>
                    <input type="number" class="form-control" name="time" id="time" min="1" v-model="tiempo">
                </div> 
            </div>
            <div class="col-md-3">
                <div class="panel panel-primary"> 
                    <div class="panel-heading"> 
                        <h3 class="panel-title">Recomendacion Videos.</h3> 
                    </div> 
                    <div class="panel-body"> Recuerda: La URL del video debe ser la que entrega el sistema de etiquetas de youtube, copiar la URL del navegador no funcionara.</div> 
                </div>
            </div>
        </div>

        <!-- SUBIR FOTOS -->
        <div v-if="key==6" >
            <div class="col-md-3">
                <div class="form-group" >
                    <label for="dificultad">Dificultad</label>
                    <select class="form-control" name="dificultad">
                        <option value="0">Facil</option>
                        <option value="1">Dificil</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group" > 
                    <label for="time">Tiempo - Minutos</label>
                    <input type="number" class="form-control" name="time" id="time" min="1" v-model="tiempo">
                </div> 
            </div>
        </div>


        <!-- LECTURA -->
        <div v-if="key==7" >
            <div class="col-md-3">
                <div class="form-group">
                    <label for="urlvideo">URL Video</label>
                    <input type="text" class="form-control" name="urlvideo" id="urlvideo" v-model="urlmaterial" placeholder="video ayuda para Reto">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="material">Recursos</label>
                    <input type="file" class="form-control" name="material" id="material" placeholder="Recursos del Reto">
                </div>
            </div>  
            <div class="col-md-3">
                <div class="form-group" >
                    <label for="dificultad">Dificultad</label>
                    <select class="form-control" name="dificultad">
                        <option value="0">Facil</option>
                        <option value="1">Dificil</option>
                    </select>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group" > 
                    <label for="time">Tiempo - Minutos</label>
                    <input type="number" class="form-control" name="time" id="time" min="1" v-model="tiempo">
                </div> 
            </div>
        </div>

        <!-- ROMPECABEZAS Y SALIR A HACER -->
        <div v-if="key==4 || key==8" >
            <div class="col-md-3">
                <div class="form-group">
                    <label for="material">Recursos</label>
                    <input type="file" class="form-control" name="material" id="material" placeholder="Recursos del Reto">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group" >
                    <label for="dificultad">Dificultad</label>
                    <select class="form-control" name="dificultad">
                        <option value="0">Facil</option>
                        <option value="1">Dificil</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group" > 
                    <label for="time">Tiempo - Minutos</label>
                    <input type="number" class="form-control" name="time" id="time" min="1" v-model="tiempo">
                </div> 
            </div>
        </div>

        <!-- SOPA DE LETRAS -->
        <div v-if="key==3" class="margin">   
            <div class="col-md-12">
            <p>Palabras Actuales: {{palabra}}</p>               
            </div>
            <div class="col-md-12">
                <div class="col-md-5">
                    <div class="panel panel-primary"> 
                        <div class="panel-heading"> 
                            <h3 class="panel-title">NOTA IMPORTANTE.</h3> 
                        </div> 
                        <div class="panel-body"> Recuerda: No Ingresar palabras de mas de 10 caracteres en modo facil y palabraas de mas de 12 caracteres en modo dificil.</div> 
                    </div>
                </div> 
                <a type="submit" class="btn btn-success" @click="addQuestion"> + Palabras </a>
                <div class="row form-row" v-for="row in rows" v-bind:key="row.id">
                    <div class="col-xs-9">
                        <!-- palabras sopa de letras -->
                        <div class="row">
                            <div class="col-xs-12">                            
                                <div class="col-xs-4">
                                    <input type="text" name="sopaletras[]" class="form-control" maxlength="10" v-model="row.name">
                                </div>
                                <div class="col-xs-1">
                                    <a class="btn btn-danger" @click="deleteRow(row)"> X </a>
                                </div>
                            </div>
                        </div>
                    </div> 
                                    
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group" >
                    <label for="dificultad">Dificultad</label>
                    <select class="form-control" name="dificultad">
                        <option value="0">Facil</option>
                        <option value="1">Dificil</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group" > 
                    <label for="time">Tiempo - Minutos</label>
                    <input type="number" class="form-control" name="time" id="time" min="1" v-model="tiempo">
                </div> 
            </div>

        </div>
    </div>
</div>

</template>

<style>
    .form-row {
        border:  1px solid #e2e2e2;
        margin:  10px;
        padding: 20px;
        background: #f2f2f2;
    }
</style>

<script>
    export default {
        props: ['tipodereto', 'palabrasparams', 'urlvideo', 'tiemporeto'],

        data(){
            return{
                tiposretos: [],
                encuestas: [],
                rows: [
                    { 'select': 1, 'name': '',}
                ],
                key: "",
                palabra: "",
                selectedOption:"",
                urlvideo: "",
                tiempo: 0,
            }
        },
        created() {
            this.key = this.tipodereto;
            this.palabra = this.palabrasparams;
            this.urlmaterial = this.urlvideo;
            this.tiempo = this.tiemporeto;
        },
        mounted() {
            axios
            .get('http://127.0.0.1:8000/retos')//http://evolucion.website/retos
            .then(response => (this.tiposretos = response.data)),

            axios
            .get('http://127.0.0.1:8000/quizzesdisponible')//http://evolucion.website/quizzesdisponible
            .then(response => (this.encuestas = response.data))

        },
        
        methods: {
            addQuestion: function() {
                this.rows.push({'select': 1, 'name': '',});
            },
            deleteRow: function(row) {
                this.rows.splice(row, 1);
            },
        },        
    }
</script>

