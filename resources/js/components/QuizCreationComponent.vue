<template>

    <div class="box box-default">
        <div class="box-header with-border">
            <div class="box-tools pull-right">
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-10">

                    <div class="row">
                        <div class="col-md-2" >
                        </div>
                    </div>

                        <form method="POST" @submit.prevent="addQuiz()">
                        <div v-for="dato in datos" v-bind:key="dato.id">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" class="form-control" name="name" id="name" v-model="dato.name" placeholder="Nombre">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" style="width: 22%;">
                                    <label for="dificultad">Dificultad</label>
                                    <select name="dificultad" class="form-control" id="dificultad" v-model="dato.dificult">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                    <h3 class="panel-title">Quizzes.</h3>
                                    </div> 
                                    <div class="panel-body"> 
                                        Registra aqui el Nombre, Descripcion y TIEMPO que durara la ejecucion del quizz, este podras editarlo en la creaciono del reto,                                         
                                    </div>
                                </div>
                            </div>                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="descripcion">Descripcion</label>
                                    <textarea class="form-control" rows="5" name="description" id="description" v-model="dato.description" placeholder="Descripcion"></textarea>
                                </div>
                            </div>
                        </div>
                            <div>        
                                <div class="col-xs-12">
                                    <h2>PREGUNTAS Y RESPUESTAS</h2>
                                    <div>
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <a type="submit" class="btn btn-success" @click="addQuestion()">Agregar Pregunta</a>
                                            </div>
                                            <div class="col-xs-10"></div>
                                        </div>
                                    </div>
                                    <div class="row  form-row" v-for="(question, index) in questions" v-bind:key="index">
                                        <div class="col-xs-12">
                                            <!-- preguntas -->
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="col-xs-2"></div>
                                                    <div class="col-xs-9">
                                                        <input type="textarea"
                                                            name="preguntas[]"
                                                            class="form-control"
                                                            id="searchinput"
                                                            v-model="question.description"
                                                            placeholder="Digite el Enunciado de la Pregunta">
                                                    </div>
                                                    <div class="col-xs-1">
                                                        <a class="btn btn-danger" @click.prevent="deleteQuestion(index)"> X </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End preguntas -->

                                            <!-- Respuestas -->
                                            <div class="row">
                                                <div class="row subrow" v-for="(answer, index) in question.answers" v-bind:key="index">
                                                    <div class="col-xs-12">
                                                        <div class="col-xs-2"></div>
                                                        <div class="col-xs-7">
                                                            <input type="text"
                                                                name="respuestas[]"
                                                                class="form-control" 
                                                                v-model="answer.description"
                                                                placeholder="Digite la Opcion de Respuesta"
                                                            >
                                                        </div>
                                                        <div class="col-xs-2">   
                                                            <div class="radio">
                                                                <label>
                                                                <input type="radio" 
                                                                    style="margin-left: 30%;"
                                                                    v-model="question.response"
                                                                    :value="answer.description"
                                                                    :name="question.description">
                                                                    Correcta
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-1">
                                                            <a class="btn btn-danger" @click.prevent="deleteAnswer(question, index)">X</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <a class="btn btn-success center-block" style="width: 24%; margin-top: 1%; margin-left: 20%;" @click="addAnswer(question)">Agregar Respuesta</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Respuestas -->
                                        </div>
                                    </div>            
                                </div>
                            </div>              
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>      
                    </form>

                </div>
                <!-- /.col -->                                
            </div>
        </div>
        <!-- /.box-body -->
    </div>

</template>
<style>
    .form-row {
        border:  1px solid #e2e2e2;
        margin:  10px;
        padding: 20px;
        background: #f2f2f2;
    }
    .subrow {
        margin: 5px;
        padding:  5px;
    }
</style>
<script>
    export default {
        data(){
            return{
                questions: [
                    {
                        code: 1,
                        description: '',
                        response: null,
                        answers: []
                    }
                ],
                datos: [
                    { 'name': '', 'description': '', 'dificult': ''}
                ]                          
            }
        },
        mounted() {
        },
        methods: {
            addQuestion: function () {
                let code = this.questions.length + 1;
                this.questions.push({code: code, description: '', response: null, answers: []});
            },
            deleteQuestion: function (index) {
                this.questions.splice(index, 1);
            },
            addAnswer: function (question) {
                let value = question.answers.length + 1;
                question.answers.push({value: value, description: ''});
            },
            deleteAnswer: function (question, index) {
                question.answers.splice(index, 1);
            },
            addQuiz(){
                axios.post(('http://127.0.0.1:8000/quizzes'), {filas:this.questions, datos:this.datos} )
                .then(function (response) {
                    if (response.data == "") {                        
                        window.location = 'http://127.0.0.1:8000/quizzes';
                    } else {
                        alert(response.data);                        
                    }

                });                
            },
        }
    }
</script>