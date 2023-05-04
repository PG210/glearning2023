<template>
    <div>
        <input type="hidden" name="" id="startinput" v-model="startTime">
        <input type="hidden" name="" id="endinput" v-model="finalTime">
        <input type="hidden" name="" id="diferencia" v-model="diff">     

        <div style="text-align:center;">            
            <h1 id="time" style="color:#7b0404"><span class="fa fa-hourglass-end"></span></h1>
            <h4>TIENES: {{ tiempoasignado }} Minutos para completar el Reto</h4>
        </div>

    </div>
</template>    
<script>        
    export default {
        data(){
            return {
                finalTime:null,
                startTime:null,
                diff: ''
            }
        },
        mounted() {                    
            this.startTime = moment().format('YYYY-MM-DD HH:mm:ss'); 
            setInterval(() => this.updatefinalTime(), 1 * 1000);    

            var minutes = 60 * this.tiempoasignado;
            var display = document.querySelector('#time');
            startTimer(minutes, display);   
            
            function startTimer (duration, display) {  
                var timer = duration, minutes, seconds;
                setInterval(function() {
                    minutes = parseInt(timer / 60, 10)
                    seconds = parseInt(timer % 60, 10);

                    minutes = minutes < 10 ? "0" + minutes : minutes;
                    seconds = seconds < 10 ? "0" + seconds : seconds;

                    display.textContent = minutes + ":" + seconds;

                    if (--timer < 0) {
                        timer = duration;
                    }

                }, 1000);
            }


        },
        methods: {
           updatefinalTime() {
                this.finalTime = moment().format('YYYY-MM-DD HH:mm:ss');                       
                const a = moment(this.startTime);
                const b = moment(this.finalTime);
                this.diff = b.diff(a, 'minutes');
                
                if (this.diff == this.tiempoasignado) {
                    window.location.href = "http://127.0.0.1:8000/gameover";
                    console.log("GAME OVER");                    
                }                                                         
            },

            
        },
        props: ['tiempoasignado']       
    }

</script>


