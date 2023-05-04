<template>  
    <div v-if="capitulos">
        <div>
            <div class="flex lineaCapitulos" style="z-index:11111111; margin: -20% 0% 0% 31%; position:absolute;">
                <div v-for="capitulo in capitulos" v-bind:key="capitulo.id" class="flex lineaCapitulos">
                    <div v-if="capitulo.RETOS_CAPITULO_REQUERIDO != 0">
                        <div class="numCap btn" v-on:click="verdatos(capitulo.id)">
                            <a href="#" v-bind:id="capitulo.order" :ref="capitulo.order" style="color:#ffffff;">{{ capitulo.order }}</a>
                        </div>
                        <div class="separador">-</div>
                    </div>         
                </div>
            </div>

            <div v-for="capitulo in capitulos" v-bind:key="capitulo.id" >
                <!-- {{chapter}} - {{capitulo.id}} -->
                <div v-if="capitulo.id == chapter">
                    <div style="position:absolute; margin: -18% 0% 0% 4%; padding: 0% 1% 0% 1%; z-index:111; text-align:center; width:60%;">
                        <div class="numCapitulo">
                            <span style="font-family: effortless;color: #ffb612;font-size: 1.6rem;">{{ capitulo.name }} </span>
                        </div>
                        <div class="tituloCapitulo">
                            <h2>{{ capitulo.capitulotitle }}</h2>
                        </div>
                        <div class="descCapitulo">
                            <span>{{ capitulo.description }}</span>
                        </div>
                        <div class="row" style="margin:4% 0% 0% 0%;text-align: -webkit-center;">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a type="button" style="width:40%;" class="btn btn-block btn-primary" v-bind:href="'http://127.0.0.1:8000/playerchapter/'+capitulo.id" >Ir al Capitulo</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img v-bind:src="capitulo.imgintro" style="position:absolute; margin: -21% 0% 0% 3%; width: 62%; border-radius:12px;"/>
                </div>                                            
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                capitulos: [],
                chapter:1,
            }
        },
        created: function () {
            
        },    
        mounted() { 
            axios
            .get('http://127.0.0.1:8000/playerchapters') //hace peticion de la secuencia a PlayerChapersController
            .then(response => {
                this.capitulos = response.data;   
                //http://evolucion.website/playerchapters este debe cambiar cuando este a produccion

                //array temporal para poder encontrar el ultimo capitulo, este abstrae solo los capitulos del jugador hasta el actual
                var array_capitulos = [];

                // recorrer la lista de capitulos del jugador para encontrar el ultimo capitulo que debe jugar
                this.capitulos.forEach( function(val, index) {   
                    if (val.RETOS_CAPITULO_REQUERIDO != 0) {     
                        var ultimo_id = val.order;                    
                        array_capitulos.push(ultimo_id);
                    }            
                });

                // hallar el ultimo order elmento del array de capitulos
                var elref = array_capitulos[array_capitulos.length-1];

                console.log(elref);

                //elegir el ultimo capitulo actual para que aparezca elegido por default                
                this.verdatos(elref);

                // document.getElementById(elref).addEventListener('click');
                
            })
            .catch(error => {
                console.log(error)
            });
            

       

        },
        methods: {
            verdatos: function(idcapitulo){
                this.chapter=idcapitulo;
                // console.log(this.chapter);
            },
       
        }
    }
</script>
