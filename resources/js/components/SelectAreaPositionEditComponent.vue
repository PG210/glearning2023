<template>

<div>
    <select class="form-control" name="areas_id" id="areas_id" v-model="key" @click="mostrarcargos()">
        <option value="" disabled selected>-- Área --</option>
        <option v-for="area in areas" v-bind:key="area.id" :value="area.id" :selected="area.id == areaselec" >{{ area.name }}</option>
    </select> 
 
    <select class="form-control" name="position_id" id="position_id">
        <option value="" disabled selected>-- Cargo --</option>
        <option v-for="position in positions" v-bind:key="position.id" :value="position.id" :selected="position.id == positionselec">{{ position.name }}</option>
    </select>
</div>

</template>

<script>
    export default {
        props: ['areaselected', 'positionselected'],
        data(){
            return{
                areas: [],
                positions: [],           
                key: "",
                areaselec: "",
                positionselec: "",
            }
        },
        created() {
            this.areaselec = this.areaselected;
            this.positionselec = this.positionselected;
        },
        mounted() {
            axios
            .get('http://127.0.0.1:8000/areasregistro')
            .then(response => (this.areas = response.data))

            if (document.getElementById("")) {
                
            }
        },
        methods: { 
            mostrarcargos: function(){
                axios
                .get('http://127.0.0.1:8000/positionsregistro/'+this.key)
                .then(response => (this.positions = response.data))                
            }           
        },

    }
</script>

