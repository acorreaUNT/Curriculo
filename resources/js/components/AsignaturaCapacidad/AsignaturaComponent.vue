<template>
     <div class="card">
         <div class="card-header">
             <h3>CICLO SELECCIONADO:</h3>
             <div class="row">
                 <div class="col-sm-5"></div>
                 <div class="col-sm-2" style="background-color: #F33154; color: white; border-radius: 10px">
                     <h1 style="font-family: initial;" align="center"> {{ciclo}} - CICLO</h1>
                 </div>
                 <div class="col-sm-5"></div>
             </div>
         </div>
         <form v-on:submit.prevent="registrarCursosPlan()">
            <div class="card-body">
                <table class="table" border="1">
                    <thead>
                        <tr>
                            <td rowspan="2" class="centrado">CICLO</td>
                            <td rowspan="2" class="centrado">ASIGNATURA</td>
                            <td rowspan="2" class="centrado" style="width:9%">TIPO(G,Es,S)</td>
                            <td colspan="3" class="centrado">HORAS SEMANALES</td>
                            <td rowspan="2" style="width:1%" class="centrado">CRÉDITOS</td>
                            <td rowspan="2" class="centrado">REQUISITOS</td>
                            <td rowspan="2" style="width:25%" class="centrado">DPTO. QUE ATIENDE</td>
                        </tr>
                        <tr>
                            <td class="centrado" style="width:5%">Teoría</td>
                            <td class="centrado" style="width:5%"> Práctica</td>
                            <td class="centrado" style="width:5%">Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="fila1">
                            <td class="text-center"><b>{{ciclo}}</b></td>
                            <td><textarea id="fila1_1" rows="2" class="form-control" v-model="cursos[0].asignatura"></textarea></td>
                            <td><select id="fila1_2"   class="form-control" @change="asignarColor('fila1', 0)" v-model="cursos[0].tipo">
                                    <option value="">--Seleccione--</option>
                                    <option value="GENERAL">GENERAL</option>
                                    <option value="ESPECÍFICO">ESPECÍFICO</option>
                                    <option value="ESPECIALIDAD">ESPECIALIDAD</option>
                                    <option value="EXTRACURRICULAR">EXTRACURRICULAR</option>
                                </select></td>
                            <td><input id="fila1_3"  type="number" min="0" class="form-control" @change="sumatoriaFilas(0)" v-model="cursos[0].ht"></td>
                            <td><input id="fila1_4"  type="number" min="0" step="2" class="form-control" @change="sumatoriaFilas(0)" v-model="cursos[0].hp"></td>
                            <td><input id="fila1_5" type="number" min="0" class="form-control" disabled v-model="cursos[0].total"></td>
                            <td><input id="fila1_6"  type="number" min="0" class="form-control" disabled @change="sumatoriaColumnas()" v-model="cursos[0].creditos"></td>
                            <td>
                                <Select2MultipleControl id="fila1_7" :disabled="cursos[0].validated == 1" :options="curso_requisitos" v-model="cursos[0].requisitos"
                                        :settings="{placeholder: 'NINGUNO'}"
                                        @select="mySelectEvent($event)" />
                            </td>
                            <td>
                                <Select2MultipleControl id="fila1_8" :disabled="cursos[0].validated == 1" :options="departamentos" v-model="cursos[0].departamentos"
                                        :settings="{placeholder: '--Seleccione--'}"
                                        @select="mySelectEvent($event)" />
                            </td>
                        </tr>
                        
                      
                        <tr class="sumatoria">
                            <td colspan="2"></td>
                            <td>TOTALES</td>
                            <td>{{total_teoria}}</td>
                            <td>{{total_practica}}</td>
                            <td>{{total_final}}</td>
                            <td>{{total_creditos}}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>

                <br>
                <div align="center" v-if="total_creditos != 22" class="validacion">
                <span class="mt-2"><b>PARA GUARDAR LO INGRESADO, LA SUMA DE CRÉDITOS DEBE SER DE 22</b></span>
                </div>
                <div class="row" v-else>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <button class="btn btn-success btn-block" type="submit">GUARDAR</button>
                    </div>
                    <div class="col-sm-4"></div>
                </div>
            </div>
         </form>
     </div>
</template>

<script>
    import Select2 from 'v-select2-component';
    import Select2MultipleControl from 'v-select2-multiple-component';

    export default {
        props: ['plan_estudio'],
        components:{
            Select2,
            Select2MultipleControl
        },
        data(){
            return{
                curso_requisitos: [],
                departamentos: [], //Departamentos un array 
                cursos:[
                    {posicion: 0,ciclo: '',asignatura: '',tipo:'',ht: '',hp: '',total: '',creditos: '',requisitos: [],departamentos: [], validated: 0},
                    {posicion: 1,ciclo: '',asignatura: '',tipo:'',ht: '',hp: '',total: '',creditos: '',requisitos: [],departamentos: [], validated: 0},
                    {posicion: 2,ciclo: '',asignatura: '',tipo:'',ht: '',hp: '',total: '',creditos: '',requisitos: [],departamentos: [], validated: 0},
                    {posicion: 3,ciclo: '',asignatura: '',tipo:'',ht: '',hp: '',total: '',creditos: '',requisitos: [],departamentos: [], validated: 0},
                    {posicion: 4,ciclo: '',asignatura: '',tipo:'',ht: '',hp: '',total: '',creditos: '',requisitos: [],departamentos: [], validated: 0},
                    {posicion: 5,ciclo: '',asignatura: '',tipo:'',ht: '',hp: '',total: '',creditos: '',requisitos: [],departamentos: [], validated: 0},
                    {posicion: 6,ciclo: '',asignatura: '',tipo:'',ht: '',hp: '',total: '',creditos: '',requisitos: [],departamentos: [], validated: 0}
                ],
                total_teoria: '',
                total_practica: '',
                total_final: '',
                total_creditos: ''
            }
        },
        mounted() {
            this.getDepartamentos();
            this.getObtenerCursos();
            this.getObtenerCursosRequisitos();
        },
        methods:{
            getDepartamentos(){
                axios.get(route('departamentos.get')).then( (response) =>{
                        this.departamentos = response.data;
                });
            },
            getObtenerCursos(){
                axios.get(route('cursos.plan.get', [this.ciclo, this.plan_estudio.id])).then( (response) =>{
                        let posicion_extra = '';
                        let termino = 'ACTIVIDAD EXTRACURRICULAR';
                        for (let index = 0; index < response.data.length; index++) {
                            if(posicion_extra == ''){
                                this.cursos[index].asignatura = response.data[index].nombre;
                                this.cursos[index].tipo = response.data[index].tipo;
                                this.cursos[index].ht = response.data[index].ht;
                                this.cursos[index].hp = response.data[index].hp;
                                this.cursos[index].total = response.data[index].h_semana;
                                this.cursos[index].creditos = response.data[index].creditos;
                                this.cursos[index].validated = 1;
                                let posicion = this.cursos[index].asignatura.indexOf(termino);
                                if(posicion !== -1){
                                    posicion_extra = index;
                                }else{
                                    posicion_extra = '';
                                }
                                this.asignarColor('fila'+(index+1), index );
                                this.getObtenerDepartamentosCursos(response.data[index].id, index);
                                this.sumatoriaColumnas();  
                            }else{
                                let tamanio_cadena = response.data[index].nombre.length;
                                let cadena = response.data[index].nombre.substr(25,tamanio_cadena);
                                this.cursos[posicion_extra].asignatura = this.cursos[posicion_extra].asignatura + ', ' + cadena;
                                this.getObtenerDepartamentosCursos(response.data[index].id, posicion_extra);
                            }             
                        }
                });
            },
            getObtenerCursosRequisitos(){
                axios.get(route('cursos.requisitos.get', this.plan_estudio)).then( (response) =>{
                    this.curso_requisitos = response.data;
                });
            },
            getObtenerDepartamentosCursos($id_curso, $posicion){
                axios.get(route('departamentos.cursos.get', $id_curso)).then( (response) =>{
                        for (let index = 0; index < response.data.length; index++) {
                             this.cursos[$posicion].departamentos.push(response.data[index].id_departamento);
                        }
                });
            },
            registrarCursosPlan(){
                const params = {
                    plan: this.plan_estudio,
                    ciclo: this.ciclo,
                    cursos: this.cursos
                };
                axios.post(route('store.cursos.plan'), params).then( (response) =>{
                    toastr.success("Se guardo los cursos del ciclo!");
                }).catch(error => {
                    toastr.error("No se pudo guardar los cursos!");
                    console.log(error);
                });
            },
            mySelectEvent({id,  text}){
                console.log({id, text})
            },
            asignarColor($valor, $posicion){
                if(this.cursos[$posicion].tipo == 'GENERAL'){
                    document.getElementById($valor).style.background = '#5FC341';
                }
                if(this.cursos[$posicion].tipo == 'EXTRACURRICULAR'){
                    document.getElementById($valor).style.background = '#5FC341';
                }
                if(this.cursos[$posicion].tipo == 'ESPECÍFICO'){
                    document.getElementById($valor).style.background = '#F76725';
                }
                if(this.cursos[$posicion].tipo == 'ESPECIALIDAD'){
                    document.getElementById($valor).style.background = '#41BCC3';
                }
                if(this.cursos[$posicion].tipo == ''){
                    document.getElementById($valor).style.background = '#FFFFFF';
                }                        
                this.sumatoriaFilas($posicion);
            },
            sumatoriaFilas($posicion){
                if(this.cursos[$posicion].hp%2 !== 0){
                    this.cursos[$posicion].hp = 0;
                    toastr.info("Las horas prácticas deben ser número pares!");
                }
                this.cursos[$posicion].total = parseInt(this.cursos[$posicion].ht) + parseInt(this.cursos[$posicion].hp);
                this.sumatoriaColumnas();
            },
            sumatoriaColumnas(){
                this.total_teoria = 0;
                this.total_practica = 0;
                this.total_final = 0;
                this.total_creditos = 0;
                for (let index = 0; index < this.cursos.length; index++) {
                    if(this.cursos[index].ht == ''){
                        this.cursos[index].ht = 0;
                    }
                    if(this.cursos[index].hp == ''){
                        this.cursos[index].hp = 0;
                    }
                    if(this.cursos[index].total == ''){
                        this.cursos[index].total = 0;
                    }
                    if(this.cursos[index].creditos == ''){
                        this.cursos[index].creditos = 0;
                    }
                    this.total_teoria = this.total_teoria + parseInt(this.cursos[index].ht);
                    this.total_practica = this.total_practica + parseInt(this.cursos[index].hp);
                    this.total_final = this.total_final + parseInt(this.cursos[index].total);
                    if( this.cursos[index].tipo !== 'EXTRACURRICULAR'){
                        this.cursos[index].creditos = parseInt(this.cursos[index].ht) + (parseInt(this.cursos[index].hp)/2);
                    }else{
                        this.cursos[index].creditos = 0;
                    }
                    this.total_creditos = this.total_creditos + parseInt(this.cursos[index].creditos);
                }
            },
        }
    }
</script>

<style>
.centrado{
    text-align: center;
    font-weight: bold;
    vertical-align:middle !important;
}
.select2-container .select2-selection--single{
    height: 40px;
}

.select2-container{
    width: 100% !important;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice{
    background-color: #312080 !important;
    border: 1px solid #312080 !important;
}
thead{
    background-color: darkgrey;
    border: 1px solid black;
}
.sumatoria{
    background-color: darkgrey;
    border: 1px solid black;
    font-weight: bold;
}
.table td, .table th{
    vertical-align: middle !important;
}
.select2-container .select2-selection--multiple .select2-selection__rendered{
    /*display: block !important;*/
}

.validacion{
    border: 2px solid red;
    padding: 10px;
    border-radius: 5px;
    background-color: antiquewhite;
}
</style>