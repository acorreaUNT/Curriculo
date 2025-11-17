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
                            <td>
                                 
                               <textarea id="fila1_1" rows="2" class="form-control" v-model="cursos[0].asignatura"></textarea>
                            </td>
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
                        <tr id="fila2">
                            <td class="text-center"><b>{{ciclo}}</b></td>
                            <td>
                                
                                <textarea id="fila2_1"  rows="2" class="form-control" v-model="cursos[1].asignatura"></textarea>
                            </td>
                            <td><select id="fila2_2"  class="form-control" @change="asignarColor('fila2', 1)" v-model="cursos[1].tipo">
                                    <option value="">--Seleccione--</option>
                                    <option value="GENERAL">GENERAL</option>
                                    <option value="ESPECÍFICO">ESPECÍFICO</option>
                                    <option value="ESPECIALIDAD">ESPECIALIDAD</option>
                                    <option value="EXTRACURRICULAR">EXTRACURRICULAR</option>
                                </select></td>
                            <td><input id="fila2_3"  type="number" min="0" class="form-control" @change="sumatoriaFilas(1)" v-model="cursos[1].ht"></td>
                            <td><input id="fila2_4"  type="number" min="0" step="2" class="form-control" @change="sumatoriaFilas(1)"  v-model="cursos[1].hp"></td>
                            <td><input id="fila2_5"  type="number" min="0" class="form-control" disabled v-model="cursos[1].total"></td>
                            <td><input id="fila2_6"  type="number" min="0" class="form-control" disabled @change="sumatoriaColumnas()" v-model="cursos[1].creditos"></td>
                            <td>
                                <Select2MultipleControl id="fila2_7"  :disabled="cursos[1].validated == 1" :options="curso_requisitos" v-model="cursos[1].requisitos"
                                        :settings="{placeholder: 'NINGUNO'}"
                                        @select="mySelectEvent($event)" />
                            </td>
                            <td><Select2MultipleControl id="fila2_8"  :disabled="cursos[1].validated == 1" :options="departamentos" v-model="cursos[1].departamentos"
                                        :settings="{placeholder: '--Seleccione--'}"
                                        @select="mySelectEvent($event)" />
                            </td>
                        </tr>
                        <tr id="fila3">
                            <td class="text-center"><b>{{ciclo}}</b></td>
                            <td>
                                
                                <textarea id="fila3_1" rows="2" class="form-control" v-model="cursos[2].asignatura"></textarea>
                                </td>
                            <td><select id="fila3_2"  class="form-control" @change="asignarColor('fila3', 2)" v-model="cursos[2].tipo">
                                    <option value="">--Seleccione--</option>
                                    <option value="GENERAL">GENERAL</option>
                                    <option value="ESPECÍFICO">ESPECÍFICO</option>
                                    <option value="ESPECIALIDAD">ESPECIALIDAD</option>
                                    <option value="EXTRACURRICULAR">EXTRACURRICULAR</option>
                                </select></td>
                            <td><input id="fila3_3"  type="number" min="0" class="form-control" @change="sumatoriaFilas(2)" v-model="cursos[2].ht"></td>
                            <td><input id="fila3_4"  type="number" min="0" step="2" class="form-control" @change="sumatoriaFilas(2)" v-model="cursos[2].hp"></td>
                            <td><input id="fila3_5"  type="number" min="0" class="form-control" disabled v-model="cursos[2].total"></td>
                            <td><input id="fila3_6"  type="number" min="0" class="form-control" disabled @change="sumatoriaColumnas()" v-model="cursos[2].creditos"></td>
                            <td>
                                <Select2MultipleControl id="fila3_7" :disabled="cursos[2].validated == 1" :options="curso_requisitos" v-model="cursos[2].requisitos"
                                        :settings="{placeholder: 'NINGUNO'}"
                                        @select="mySelectEvent($event)" />
                            </td>
                            <td><Select2MultipleControl id="fila3_8" :disabled="cursos[2].validated == 1" :options="departamentos" v-model="cursos[2].departamentos"
                                        :settings="{placeholder: '--Seleccione--'}"
                                        @select="mySelectEvent($event)" />
                            </td>
                        </tr>
                        <tr id="fila4">
                            <td class="text-center"><b>{{ciclo}}</b></td>
                            <td>
                                
                                <textarea id="fila4_1"  rows="2" class="form-control" v-model="cursos[3].asignatura"></textarea>
                                </td>
                            <td><select id="fila4_2"  class="form-control" @change="asignarColor('fila4', 3)" v-model="cursos[3].tipo">
                                    <option value="">--Seleccione--</option>
                                    <option value="GENERAL">GENERAL</option>
                                    <option value="ESPECÍFICO">ESPECÍFICO</option>
                                    <option value="ESPECIALIDAD">ESPECIALIDAD</option>
                                    <option value="EXTRACURRICULAR">EXTRACURRICULAR</option>
                                </select></td>
                            <td><input id="fila4_3"  type="number" min="0" class="form-control" @change="sumatoriaFilas(3)" v-model="cursos[3].ht"></td>
                            <td><input id="fila4_4"  type="number" min="0" step="2" class="form-control" @change="sumatoriaFilas(3)" v-model="cursos[3].hp"></td>
                            <td><input id="fila4_5"  type="number" min="0" class="form-control" disabled v-model="cursos[3].total"></td>
                            <td><input id="fila4_6"  type="number" min="0" class="form-control" disabled @change="sumatoriaColumnas()" v-model="cursos[3].creditos"></td>
                            <td>
                                <Select2MultipleControl id="fila4_7" :disabled="cursos[3].validated == 1" :options="curso_requisitos" v-model="cursos[3].requisitos"
                                        :settings="{placeholder: 'NINGUNO'}"
                                        @select="mySelectEvent($event)" />
                            </td>
                            <td><Select2MultipleControl id="fila4_8"  :disabled="cursos[3].validated == 1" :options="departamentos" v-model="cursos[3].departamentos"
                                        :settings="{placeholder: '--Seleccione--'}"
                                        @select="mySelectEvent($event)" />
                            </td>
                        </tr>
                        <tr id="fila5">
                            <td class="text-center"><b>{{ciclo}}</b></td>
                            <td>
                               
                                <textarea id="fila5_1" rows="2" class="form-control" v-model="cursos[4].asignatura"></textarea>
                            </td>
                            <td><select id="fila5_2"  class="form-control" @change="asignarColor('fila5', 4)" v-model="cursos[4].tipo">
                                    <option value="">--Seleccione--</option>
                                    <option value="GENERAL">GENERAL</option>
                                    <option value="ESPECÍFICO">ESPECÍFICO</option>
                                    <option value="ESPECIALIDAD">ESPECIALIDAD</option>
                                    <option value="EXTRACURRICULAR">EXTRACURRICULAR</option>
                                </select></td>
                            <td><input id="fila5_3" type="number" min="0" class="form-control" @change="sumatoriaFilas(4)" v-model="cursos[4].ht"></td>
                            <td><input id="fila5_4" type="number" min="0" step="2" class="form-control" @change="sumatoriaFilas(4)" v-model="cursos[4].hp"></td>
                            <td><input id="fila5_5" type="number" min="0" class="form-control" disabled v-model="cursos[4].total"></td>
                            <td><input id="fila5_6" type="number" min="0" class="form-control" disabled @change="sumatoriaColumnas()" v-model="cursos[4].creditos"></td>
                            <td>
                                <Select2MultipleControl id="fila5_7" :disabled="cursos[4].validated == 1" :options="curso_requisitos" v-model="cursos[4].requisitos"
                                        :settings="{placeholder: 'NINGUNO'}"
                                        @select="mySelectEvent($event)" />
                            </td>
                            <td><Select2MultipleControl id="fila5_8" :disabled="cursos[4].validated == 1" :options="departamentos" v-model="cursos[4].departamentos"
                                        :settings="{placeholder: '--Seleccione--'}"
                                        @select="mySelectEvent($event)" />
                            </td>
                        </tr>
                        <tr id="fila6">
                            <td class="text-center"><b>{{ciclo}}</b></td>
                            <td>
                                 
                                <textarea id="fila6_1" rows="2" class="form-control" v-model="cursos[5].asignatura"></textarea>
                            </td>
                            <td><select id="fila6_2"  class="form-control" @change="asignarColor('fila6', 5)" v-model="cursos[5].tipo">
                                    <option value="">--Seleccione--</option>
                                    <option value="GENERAL">GENERAL</option>
                                    <option value="ESPECÍFICO">ESPECÍFICO</option>
                                    <option value="ESPECIALIDAD">ESPECIALIDAD</option>
                                    <option value="EXTRACURRICULAR">EXTRACURRICULAR</option>
                                </select></td>
                            <td><input id="fila6_3"  type="number" min="0" class="form-control" @change="sumatoriaFilas(5)" v-model="cursos[5].ht"></td>
                            <td><input id="fila6_4"  type="number" min="0" step="2" class="form-control" @change="sumatoriaFilas(5)" v-model="cursos[5].hp"></td>
                            <td><input id="fila6_5"  type="number" min="0" class="form-control" disabled v-model="cursos[5].total"></td>
                            <td><input id="fila6_6"  type="number" min="0" class="form-control" disabled @change="sumatoriaColumnas()" v-model="cursos[5].creditos"></td>
                            <td>
                                <Select2MultipleControl id="fila6_7"  :disabled="cursos[5].validated == 1" :options="curso_requisitos" v-model="cursos[5].requisitos"
                                        :settings="{placeholder: 'NINGUNO'}"
                                        @select="mySelectEvent($event)" />
                            </td>
                            <td><Select2MultipleControl id="fila6_8" :disabled="cursos[5].validated == 1" :options="departamentos" v-model="cursos[5].departamentos"
                                        :settings="{placeholder: '--Seleccione--'}"
                                        @select="mySelectEvent($event)" />
                            </td>
                        </tr>
                        <tr id="fila7">
                            <td class="text-center"><b>{{ciclo}}</b></td>
                            <td>
                               
                               <textarea id="fila7_1" rows="2" class="form-control" v-model="cursos[6].asignatura"></textarea>
                            </td>
                            <td><select id="fila7_2"  class="form-control" @change="asignarColor('fila7', 6)" v-model="cursos[6].tipo">
                                    <option value="">--Seleccione--</option>
                                    <option value="GENERAL">GENERAL</option>
                                    <option value="ESPECÍFICO">ESPECÍFICO</option>
                                    <option value="ESPECIALIDAD">ESPECIALIDAD</option>
                                    <option value="EXTRACURRICULAR">EXTRACURRICULAR</option>
                                </select></td>
                            <td><input id="fila7_3"  type="number" min="0" class="form-control" @change="sumatoriaFilas(6)" v-model="cursos[6].ht"></td>
                            <td><input id="fila7_4"  type="number" min="0" step="2" class="form-control" @change="sumatoriaFilas(6)" v-model="cursos[6].hp"></td>
                            <td><input id="fila7_5"  type="number" min="0" class="form-control" disabled v-model="cursos[6].total"></td>
                            <td><input id="fila7_6"  type="number" min="0" class="form-control" disabled @change="sumatoriaColumnas()" v-model="cursos[6].creditos"></td>
                            <td>
                                <Select2MultipleControl id="fila7_7"  :disabled="cursos[6].validated == 1" :options="curso_requisitos" v-model="cursos[6].requisitos"
                                        :settings="{placeholder: 'NINGUNO'}"
                                        @select="mySelectEvent($event)" />
                            </td>
                            <td><Select2MultipleControl id="fila7_8" :disabled="cursos[6].validated == 1" :options="departamentos" v-model="cursos[6].departamentos"
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
              
                <div  class="validacion"  align="center">
                    <div class="row" align="center" style="justify-content: center !important">
                    <span class="mt-2"><b>LA SUMA DE CRÉDITOS DEBE ESTAR EN EL RANGO DE 20 A 23</b></span>
                    </div>
                     
                </div>
            </div>
         </form>
     </div>
</template>

<script>
    import Select2 from 'v-select2-component';
    import Select2MultipleControl from 'v-select2-multiple-component';

    export default {
        props: ['ciclo', 'plan_estudio'],
        components:{
            Select2,
            Select2MultipleControl
        },
        data(){
            return{
                curso_requisitos: [],
                departamentos: [], //Departamentos un array 
                cursos_acticulacion: [],
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
                        for (let index = 0; index < response.data.length; index++) {
                                this.cursos[index].asignatura = response.data[index].nombre;
                                this.cursos[index].tipo = response.data[index].tipo;
                                this.cursos[index].ht = response.data[index].ht;
                                this.cursos[index].hp = response.data[index].hp;
                                this.cursos[index].total = response.data[index].h_semana;
                                this.cursos[index].creditos = response.data[index].creditos;
                                this.cursos[index].validated = 1;
                               
                                this.asignarColor('fila'+(index+1), index );
                                this.desabilitar(index);
                                this.getObtenerDepartamentosCursos(response.data[index].id, index);
                                this.sumatoriaColumnas();         
                        }
                });
            },
            getObtenerCursosRequisitos(){
                axios.get(route('cursos.requisitos.get', this.plan_estudio)).then( (response) =>{
                    this.curso_requisitos = response.data;
                    this.cursos_acticulacion = response.data;
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
            desabilitar($posicion){
                document.getElementById('fila'+($posicion+1)+'_1').disabled = true;
                document.getElementById('fila'+($posicion+1)+'_2').disabled = true;
                document.getElementById('fila'+($posicion+1)+'_3').disabled = true;
                document.getElementById('fila'+($posicion+1)+'_4').disabled = true;
                document.getElementById('fila'+($posicion+1)+'_5').disabled = true;
                document.getElementById('fila'+($posicion+1)+'_6').disabled = true;
                document.getElementById('fila'+($posicion+1)+'_7').disabled = true;
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