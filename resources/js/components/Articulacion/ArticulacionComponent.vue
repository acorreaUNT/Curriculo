<template>
     <div class="card">
         <div class="card-header">
             <div class="row">
                 <div class="col-sm-2"></div>
                 <div class="col-sm-8" style="background-color: #F33154; color: white; border-radius: 10px">
                     <h3  align="center"> ARTICULACIÓN DE COMPETENCIAS: {{tipo.nombre}}</h3>
                 </div>
                <div class="col-sm-2"></div>
             </div>
         </div>
     
            <div class="card-body">
               <div class="row">
                   <div class="col-sm-9"></div>
                   <div class="col-sm-3" align="right">
                        <label for="" style="color:white">.</label>
                        <button class="btn btn-primary btn-block" @click="verPlanEstudios()">
                          VER PLAN DE ESTUDIOS
                       </button>
                   </div>
                   <div class="col-sm-12">
                       <label for="">COMPETENCIA: </label>
                       <select class="form-control" required v-model="competencia_id" @change="getCapacidades()">
                           <option value="">--Seleccione--</option>
                           <option :value="item.id" v-for="item in competencias" :key="item.id">
                               {{item.codigo}}|{{item.contenido}}
                           </option>
                       </select>
                   </div>
                   <div class="col-sm-12">
                        <label for="">CAPACIDAD: </label>
                       <select class="form-control" required v-model="capacidad_id" @change="getCursosMapa()">
                           <option value="">--Seleccione--</option>
                           <option :value="item.id" v-for="item in capacidades" :key="item.id">
                               {{item.codigo}}|{{item.contenido}}
                           </option>
                       </select>
                   </div>
                </div> <br>
               <div class="row" v-if="lista">
                   <div class="col-sm-2" v-if="tipo.nombre == 'COMPETENCIAS ESPECÍFICAS'">
                       <label for="">ASIGNATURA: </label>
                       <button class="btn btn-success btn-block"  @click="nuevaAsignatura()">
                          NUEVA
                       </button>
                   </div>
                   <div class="col-sm-2"  v-if="tipo.nombre == 'COMPETENCIAS ESPECÍFICAS'">
                       <label for="" style="color:white">.</label>
                        <button class="btn btn-dark btn-block" @click="AsignaturaExistente()">
                          EXISTENTE
                       </button>
                   </div> 
                   <div class="col-sm-8"></div>
                   
                   <div class="col-sm-12 mt-2">
                    <table class="table table-bordered">
                       <thead>
                           <tr>
                               <td>CICLO</td>
                               <td>NOMBRE DE ASIGNATURA ARTICULADA</td>
                               <td>TIPO</td>
                               <td>HT</td>
                               <td>HP</td>
                               <td>TOTALES</td>
                               <td>CREDITOS</td>
                               <td  v-if="tipo.nombre == 'COMPETENCIAS ESPECÍFICAS'">OPCIONES</td>
                           </tr>
                       </thead>
                       <tbody>
                           <tr v-for="item in cursos_capacidad" :key="item.id">
                               <td>{{item.cursos_plan.ciclo}}</td>
                               <td>{{item.cursos_plan.nombre}}</td>
                               <td>{{item.cursos_plan.tipo}}</td>
                               <td>{{item.cursos_plan.ht}}</td>
                               <td>{{item.cursos_plan.hp}}</td>
                               <td>{{item.cursos_plan.h_semana}}</td>
                               <td>{{item.cursos_plan.creditos}}</td>
                               <td  v-if="tipo.nombre == 'COMPETENCIAS ESPECÍFICAS'">
                                    <button class="btn btn-warning" @click="verEditar(item.cursos_plan.id)"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-danger" @click="eliminarCurso(item.cursos_plan.id, item.cursos_plan.nombre)"><i class="fa fa-trash"></i></button>
                               </td>
                           </tr>
                       </tbody>
                   </table>
                   </div>
                   
               </div>

            </div>
     

                     <!--MODALES-->
             <!--INicio modal asignatura-->
        <div class="modal fade " id="asignatura" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-full modal-dialog-centered " role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: black; ">
                         <h4 class="modal-title" style="color:white;" align="center"><strong>
                             NUEVA ASIGNATURA</strong></h4>
                    </div>
                    <form v-on:submit.prevent="storeAsignatura()">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="">Ciclo:</label>
                                    <select class="form-control" v-model="curso.ciclo" required>
                                        <option value="">--Seleccione--</option>
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                        <option value="III">III</option>
                                        <option value="IV">IV</option>
                                        <option value="V">V</option>
                                        <option value="VI">VI</option>
                                        <option value="VII">VII</option>
                                        <option value="VIII">VIII</option>
                                        <option value="IX">IX</option>
                                        <option value="X">X</option>
                                        <option value="XI" v-if="programa_estudio.num_ciclos == 12 || programa_estudio.num_ciclos == 14 ">XI</option>
                                        <option value="XII" v-if="programa_estudio.num_ciclos == 12 || programa_estudio.num_ciclos == 14">XII</option>
                                        <option value="XIII" v-if="programa_estudio.num_ciclos == 14">XIII</option>
                                        <option value="XIV" v-if="programa_estudio.num_ciclos == 14">XIV</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <label for="">Asignatura: </label>
                                    <input type="text" class="form-control" v-model="curso.nombre_asignatura" required>
                                </div>
                                <div class="col-sm-1">
                                    <label for="">Tipo: </label>
                                    <select required  class="form-control" v-model="curso.tipo" v-if="tipo.id == 1">
                                        <option value="">--Seleccione--</option>
                                        <option value="GENERAL">GENERAL</option>
                                    </select>
                                    <select required  class="form-control" v-model="curso.tipo" v-else>
                                        <option value="ESPECÍFICO">ESPECÍFICO</option>
                                        <option value="ESPECIALIDAD">ESPECIALIDAD</option>
                                                
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <label for="">HT:</label>
                                    <input  type="number" min="0" required @change="sumatoriaFilas()" class="form-control"  v-model="curso.ht">
                                </div>
                                <div class="col-sm-1">
                                    <label for="">HP:</label>
                                    <input  type="number" min="0" required @change="sumatoriaFilas()" step="2" class="form-control"  v-model="curso.hp">
                                </div>
                                <div class="col-sm-1">
                                    <label for="">Total Horas:</label>
                                    <input  type="number" min="0" disabled class="form-control"  v-model="curso.total">
                                </div>
                                <div class="col-sm-1">
                                    <label for="">Créditos:</label>
                                    <input  type="number" min="0" disabled class="form-control"  v-model="curso.creditos">
                                </div>
                                <div class="col-sm-2">
                                    <label for="">Requisitos</label>
                                    <Select2MultipleControl  :options="curso_requisitos" v-model="curso.requisitos" required
                                        :settings="{placeholder: 'NINGUNO'}"
                                        @select="mySelectEvent($event)" />
                                </div>
                                <div class="col-sm-2">
                                    <label for="">Departamentos: </label>
                                     <Select2MultipleControl  :options="departamentos" v-model="curso.departamentos" required
                                        :settings="{placeholder: '--Seleccione--'}"
                                        @select="mySelectEvent($event)" />
                                </div>
                            </div>
                            <div class="row tex-center mt-2">
                                <div class="col-sm-12 text-center">
                                    <input type="radio" value="obligatoria" v-model="curso.estado" required> obligatoria
                                    <input type="radio" value="electivo" v-model="curso.estado"> electivo
                                </div>
                            </div>
                            
                        </div>
                        <div class="modal-footer" style="text-align: center">
                            <button type="submit" class="btn btn-success" >
                                Guardar
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" >
                                Cancelar
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <!--asignatura editar-->
         <div class="modal fade " id="asignatura-editar" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-full modal-dialog-centered " role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: black;">
                         <h4 class="modal-title" style="color:white;" align="center"><strong>
                             EDITAR ASIGNATURA</strong></h4>
                    </div>
                    <form v-on:submit.prevent="updateAsignatura()">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <label for="">Ciclo:</label>
                                    <select class="form-control" v-model="curso_editar.ciclo" required>
                                        <option value="">--Seleccione--</option>
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                        <option value="III">III</option>
                                        <option value="IV">IV</option>
                                        <option value="V">V</option>
                                        <option value="VI">VI</option>
                                        <option value="VII">VII</option>
                                        <option value="VIII">VIII</option>
                                        <option value="IX">IX</option>
                                        <option value="X">X</option>
                                        <option value="XI" v-if="programa_estudio.num_ciclos == 12 || programa_estudio.num_ciclos == 14 ">XI</option>
                                        <option value="XII" v-if="programa_estudio.num_ciclos == 12 || programa_estudio.num_ciclos == 14">XII</option>
                                        <option value="XIII" v-if="programa_estudio.num_ciclos == 14">XIII</option>
                                        <option value="XIV" v-if="programa_estudio.num_ciclos == 14">XIV</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <label for="">Asignatura: </label>
                                    <input type="text" class="form-control" v-model="curso_editar.nombre_asignatura" required>
                                </div>
                                <div class="col-sm-1">
                                    <label for="">Tipo: </label>
                                    <select required  class="form-control" v-model="curso_editar.tipo" v-if="tipo.id == 1">
                                        <option value="">--Seleccione--</option>
                                        <option value="GENERAL">GENERAL</option>
                                    </select>
                                    <select required  class="form-control" v-model="curso_editar.tipo" v-else>
                                        <option value="ESPECÍFICO">ESPECÍFICO</option>
                                        <option value="ESPECIALIDAD">ESPECIALIDAD</option>     
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <label for="">HT:</label>
                                    <input  type="number" min="0" required @change="sumatoriaFilas2()" class="form-control"  v-model="curso_editar.ht">
                                </div>
                                <div class="col-sm-1">
                                    <label for="">HP:</label>
                                    <input  type="number" min="0" required @change="sumatoriaFilas2()" step="2" class="form-control"  v-model="curso_editar.hp">
                                </div>
                                <div class="col-sm-1">
                                    <label for="">Total Horas:</label>
                                    <input  type="number" min="0" disabled class="form-control"  v-model="curso_editar.total">
                                </div>
                                <div class="col-sm-1">
                                    <label for="">Créditos:</label>
                                    <input  type="number" min="0" disabled class="form-control"  v-model="curso_editar.creditos">
                                </div>
                                <div class="col-sm-2">
                                    <label for="">Requisitos</label>
                                    <Select2MultipleControl  :options="curso_requisitos" v-model="curso_editar.requisitos" required
                                        :settings="{placeholder: 'NINGUNO'}"
                                        @select="mySelectEvent($event)" />
                                </div>
                                <div class="col-sm-2">
                                    <label for="">Departamentos: </label>
                                     <Select2MultipleControl  :options="departamentos" v-model="curso_editar.departamentos" required
                                        :settings="{placeholder: '--Seleccione--'}"
                                        @select="mySelectEvent($event)" />
                                </div>
                               
                            </div>
                             <div class="row tex-center mt-2">
                                    <div class="col-sm-12 text-center">
                                        <input type="radio" value="obligatoria" v-model="curso_editar.estado" required> obligatoria
                                        <input type="radio" value="electivo" v-model="curso_editar.estado"> electivo
                                    </div>
                                </div>
                            
                        </div>
                        <div class="modal-footer" style="text-align: center">
                            <button type="submit" class="btn btn-success" >
                                Editar
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" >
                                Cancelar
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <!--fin asignatura-->

        


         <div class="modal fade" id="existente" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog  modal-dialog-centered " role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: black; ">
                         <h4 class="modal-title" style="color:white;" align="center"><strong>
                             ASIGNATURA EXISTENTE</strong></h4>
                    </div>
                    <form v-on:submit.prevent="storeAsignaturaExistente()">
                        <div class="modal-body">
                            <label for="">Nombre de Asignatura: </label>
                            <select v-model="curso_existente_id" class="form-control" required>
                                <option value="">--Seleccione--</option>
                                <option :value="item.id" v-for="item in cursos_existentes" :key="item.id">
                                    {{item.nombre}}
                                </option>
                            </select>
                        </div>
                        <div class="modal-footer" style="text-align: center">
                            <button type="submit" class="btn btn-success" >
                                Guardar
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" >
                                Cancelar
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <div class="modal fade" id="planEstudios" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-full  modal-dialog-centered " role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: black; ">
                         <h4 class="modal-title" style="color:white;" align="center"><strong>
                             VISTA DE PLAN DE ESTUDIOS</strong></h4>
                    </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <button @click="buscarCursosPlan('I')" class="btn btn-primary btn-block">I</button>
                                </div>
                                <div class="col-sm-1">
                                    <button @click="buscarCursosPlan('II')" class="btn btn-primary btn-block">II</button>
                                </div>
                                <div class="col-sm-1">
                                    <button @click="buscarCursosPlan('III')" class="btn btn-primary btn-block">III</button>
                                </div>
                                <div class="col-sm-1">
                                    <button @click="buscarCursosPlan('IV')" class="btn btn-primary btn-block">IV</button>
                                </div>
                                <div class="col-sm-1">
                                    <button @click="buscarCursosPlan('V')" class="btn btn-primary btn-block">V</button>
                                </div>
                                <div class="col-sm-1">
                                    <button @click="buscarCursosPlan('VI')" class="btn btn-primary btn-block">VI</button>
                                </div>
                                <div class="col-sm-1">
                                    <button @click="buscarCursosPlan('VII')" class="btn btn-primary btn-block">VII</button>
                                </div>
                                <div class="col-sm-1">
                                    <button @click="buscarCursosPlan('VIII')" class="btn btn-primary btn-block">VIII</button>
                                </div>
                                <div class="col-sm-1">
                                    <button @click="buscarCursosPlan('IX')" class="btn btn-primary btn-block">IX</button>
                                </div>
                                <div class="col-sm-1">
                                    <button @click="buscarCursosPlan('X')" class="btn btn-primary btn-block">X</button>
                                </div>
                                 <div class="col-sm-1" v-if="programa_estudio.num_ciclos == 12 || programa_estudio.num_ciclos == 14 ">
                                    <button @click="buscarCursosPlan('XI')" class="btn btn-primary btn-block">XI</button>
                                </div>
                                 <div class="col-sm-1" v-if="programa_estudio.num_ciclos == 12 || programa_estudio.num_ciclos == 14 ">
                                    <button @click="buscarCursosPlan('XII')" class="btn btn-primary btn-block">XII</button>
                                </div>
                                 <div class="col-sm-1" v-if="programa_estudio.num_ciclos == 14 ">
                                    <button @click="buscarCursosPlan('XIII')" class="btn btn-primary btn-block">XIII</button>
                                </div>
                                 <div class="col-sm-1" v-if="programa_estudio.num_ciclos == 14 ">
                                    <button @click="buscarCursosPlan('XIV')" class="btn btn-primary btn-block">XIV</button>
                                </div>
                            </div>
                             <br><br>
                             <div class="row" v-if="go">
                                 <div class="col-sm-12">
                                     <table class="table" border="1">
                                          <tr>
                                            <td rowspan="2" class="centrado">CICLO</td>
                                            <td rowspan="2" class="centrado">ASIGNATURA</td>
                                            <td rowspan="2" class="centrado" style="width:9%">TIPO(G,E,S)</td>
                                            <td colspan="3" class="centrado">HORAS SEMANALES</td>
                                            <td rowspan="2" style="width:1%" class="centrado">CRÉDITOS</td>
                                        </tr>
                                        <tr>
                                            <td class="centrado" style="width:5%">Teoría</td>
                                            <td class="centrado" style="width:5%"> Práctica</td>
                                            <td class="centrado" style="width:5%">Total</td>
                                        </tr>
                                        <tbody>
                                            <tr v-for="item in cursoXciclo" :key="item.id" :class="item.tipo">
                                                <td>{{item.ciclo}}</td>
                                                <td>{{item.nombre}}</td>
                                                <td v-if="item.tipo == 'EXTRACURRICULAR'">GENERAL</td>
                                                <td v-else>{{item.tipo}}</td>
                                                <td>{{item.ht}}</td>
                                                <td>{{item.hp}}</td>
                                                <td>{{item.h_semana}}</td>
                                                <td>{{item.creditos}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td>TOTALES</td>
                                                <td>{{total_t}}</td>
                                                <td>{{total_p}}</td>
                                                <td>{{total_total}}</td>
                                                <td>{{total_credito}}</td>
                                            </tr>
                                        </tbody>
                                     </table>
                                 </div>
                             </div>
                
                            
                        </div>
                        <div class="modal-footer" style="text-align: center">
                            <button type="submit" class="btn btn-success" >
                                Guardar
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" >
                                Cancelar
                            </button>
                        </div>
                </div>

            </div>
        </div>
        

          <!--MODALES-->
     </div>
</template>

<script>
    import Select2 from 'v-select2-component';
    import Select2MultipleControl from 'v-select2-multiple-component';
    import swal from 'sweetalert2';
    import 'sweetalert2/dist/sweetalert2.min.css';

    export default {
        props: ['plan_estudio','tipo', 'competencias', 'programa_estudio'],
        components:{
            Select2,
            Select2MultipleControl
        },
        data(){
            return{
                competencia_id: '', 
                capacidad_id: '',
                capacidades: [],
                cursos_capacidad:[],
                lista: false,
                cursos_existentes: [],
                departamentos: [],
                curso_existente_id: '',
                curso_requisitos: [],
                cursoXciclo: [],
                total_t: 0,
                total_p: 0,
                total_total: 0,
                total_credito: 0,
                go: false,
                //NUEVO CURSO
                curso: {
                    nombre_asignatura: '',
                    ciclo: '',
                    tipo: '',
                    ht: '',
                    hp: '',
                    total: '',
                    creditos: '',
                    estado: '',
                    requisitos: [],
                    departamentos: [],
                },

                curso_editar:{
                    id: '',
                    nombre_asignatura: '',
                    ciclo: '',
                    tipo: '',
                    ht: '',
                    hp: '',
                    total: '',
                    creditos: '',
                    estado: '',
                    requisitos: [],
                    departamentos: [],
                }
                
            }
        },
        mounted() {
            this.getDepartamentos();
            this.getObtenerCursosRequisitos();
        },
        methods:{
            getDepartamentos(){
                axios.get(route('departamentos.get')).then( (response) =>{
                        this.departamentos = response.data;
                });
            },
            getObtenerCursosRequisitos(){
                axios.get(route('cursos.requisitos.get', this.plan_estudio)).then( (response) =>{
                    this.curso_requisitos = response.data;
                });
            },
            getCapacidades(){
                axios.get(route('capacidades.get', this.competencia_id)).then( (response) =>{
                        this.capacidades = response.data;
                });
            },
            buscarCursosPlan(ciclo){
                this.total_credito = 0;
                this.total_total  = 0;
                this.total_p = 0;
                this.total_t = 0;

                let contar_electivo_general = 0;

                const post = { ciclo: ciclo, plan_id: this.plan_estudio };
                axios.get(route('cursos.plan.get',post)).then( (response) =>{
                        this.cursoXciclo = response.data;
                        this.go = true;
                         for (let index = 0; index < this.cursoXciclo.length; index++) {
                            if(this.cursoXciclo[index].estado !== 'electivo/general'){
                            this.total_t = this.total_t + this.cursoXciclo[index].ht;
                            this.total_p = this.total_p + this.cursoXciclo[index].hp;
                            this.total_total  = this.total_total+ this.cursoXciclo[index].h_semana;
                            
                                this.total_credito  = this.total_credito+ this.cursoXciclo[index].creditos;
                            }
                             
                        }
                });
            },
            getCursosMapa(){
                if(this.capacidad_id !== ''){
                    this.lista = true;
                    toastr.info("Se cargo lista de asignaturas articuladas a esta capacidad!");
                }else{
                    this.lista = false;
                }
                
                axios.get(route('cursos.mapa.get', this.capacidad_id)).then( (response) =>{
                        this.cursos_capacidad = response.data;
                });
            },
            getCursosExistentes(){
                axios.get(route('cursos.existentes.get', this.plan_estudio.id)).then( (response) =>{
                        this.cursos_existentes = response.data;
                });
            },
            getCursoEditar(id_curso){
                axios.get(route('cursos.editar.get', id_curso)).then( (response) =>{
                        this.curso_editar.id = response.data[0].id;
                        this.curso_editar.ciclo = response.data[0].ciclo;
                        this.curso_editar.nombre_asignatura = response.data[0].nombre;
                        this.curso_editar.tipo = response.data[0].tipo;
                        this.curso_editar.ht = response.data[0].ht;
                        this.curso_editar.hp = response.data[0].hp;
                        this.curso_editar.total = response.data[0].h_semana;
                        this.curso_editar.creditos = response.data[0].creditos;
                        this.curso_editar.estado = response.data[0].estado;

                        for (let index = 0; index < response.data[1].length; index++) {
                            this.curso_editar.departamentos.push(response.data[1][index].id_departamento);
                        }

                        for (let index = 0; index < response.data[2].length; index++) {
                            this.curso_editar.requisitos.push(response.data[2][index].id_requisito);
                        }
                        //this.curso_editar.requisitos: [],
                        //this.curso_editar.departamentos: [],
                });
            },
            sumatoriaFilas(){
                 if(this.curso.hp%2 !== 0){
                    this.curso.hp = 0;
                    toastr.info("Las horas prácticas deben ser número pares!");
                }
                 if( this.curso.tipo !== 'EXTRACURRICULAR'){
                        this.curso.creditos = parseInt(this.curso.ht) + (parseInt(this.curso.hp)/2);
                    }else{
                        this.curso.creditos = 0;
                }
                this.curso.total = parseInt(this.curso.ht) + parseInt(this.curso.hp);
            },
            sumatoriaFilas2(){
                 if(this.curso_editar.hp%2 !== 0){
                    this.curso_editar.hp = 0;
                    toastr.info("Las horas prácticas deben ser número pares!");
                }
                 if( this.curso_editar.tipo !== 'EXTRACURRICULAR'){
                        this.curso_editar.creditos = parseInt(this.curso_editar.ht) + (parseInt(this.curso_editar.hp)/2);
                    }else{
                        this.curso_editar.creditos = 0;
                }
                this.curso_editar.total = parseInt(this.curso_editar.ht) + parseInt(this.curso_editar.hp);
            },
            storeAsignatura(){
                const params = {
                    curso: this.curso,
                    capacidad_id: this.capacidad_id,
                    plan_estudio_id: this.plan_estudio.id,
                };
                if(this.curso.estado == ''){
                     toastr.info("Debe seleccionar si el  curso es obligatorio o electivo!");
                }else{
                 axios.post(route('store.articulacion'), params).then( (response) =>{
                     console.log(response.data);
                     if(response.data == true){
                         toastr.success("Se guardo la articulacion de la asignatura!");
                         $('#asignatura').modal('hide');
                         this.resetForm();
                         this.getCursosMapa();
                         this.getObtenerCursosRequisitos();
                     }else{
                         if(response.data == 2){
                              toastr.error("Supero el limite de creditos o número de asignaturas pertenecientes a un ciclo!");
                            this.resetForm();
                            this.getCursosMapa();
                            this.getObtenerCursosRequisitos();
                         }else{
                              toastr.error("La asignatura ya fue registrado, elija el boton existente!");
                                this.resetForm();
                                this.getCursosMapa();
                                this.getObtenerCursosRequisitos();
                         }
                        
                     }
                    
                }).catch(error => {
                    toastr.error("No se pudo guardar la articulacion de la asignatura!");
                    console.log(error);
                });
                }
            },
            updateAsignatura(){
                 const params = {
                    curso: this.curso_editar,
                    capacidad_id: this.capacidad_id,
                    plan_estudio_id: this.plan_estudio.id,
                };
                 axios.post(route('update.articulacion'), params).then( (response) =>{
                     console.log(response.data);
                     if(response.data == true){
                         toastr.success("Se actualizo la asignatura!");
                         $('#asignatura-editar').modal('hide');
                         this.resetForm2();
                         this.resetForm();
                         this.getCursosMapa();
                         this.getObtenerCursosRequisitos();
                     }else{
                         if(response.data == 2){
                              toastr.error("Supero el limite de creditos o número de asignaturas pertenecientes a un ciclo!");
                            this.resetForm2();
                            this.resetForm();
                            this.getCursosMapa();
                            this.getObtenerCursosRequisitos();
                         }else{
                              toastr.error("La asignatura ya fue registrado, elija el boton existente!");
                                this.resetForm2();
                                this.resetForm();
                                this.getCursosMapa();
                                this.getObtenerCursosRequisitos();
                         }
                        
                     }
                    
                }).catch(error => {
                    toastr.error("No se pudo editar la asignatura!");
                    console.log(error);
                });
            },
            storeAsignaturaExistente(){
                const params = {
                    capacidad_id: this.capacidad_id,
                    curso_existente_id: this.curso_existente_id,
                };
                 axios.post(route('store.articulacion.curso.existente'), params).then( (response) =>{
                     if(response.data){
                         toastr.success("Se guardo la articulacion de la asignatura!");
                         $('#asignatura').modal('hide');
                         this.curso_existente_id = '';
                         this.getCursosMapa();
                     }else{
                         toastr.error("Esta articulacion ya existe, en la capacidad!");
                         this.curso_existente_id = '';
                         this.getCursosMapa();
                     }
                    
                }).catch(error => {
                    toastr.error("No se pudo guardar la articulacion de la asignatura!");
                    console.log(error);
                });
            },
            eliminarCurso(id_curso, nombre_curso){
                swal.fire({
                            title: 'Eliminar asignatura: ' + nombre_curso ,
                            text: "Se eliminara la relación, sumilla, e integración en el mapa curricular, malla curricular y plan de estudios",
                            type: 'info',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Sí, eliminar'
                        }).then((result) => {
                            if (result.value) {
                                axios.get(route('delete.curso', id_curso)).then((response) => {
                                    if(response.data){
                                        toastr.info('Asignatura eliminada');
                                        this.getCursosMapa();
                                    }
                                }).catch(error => {
                                    toastr.error("Ocurrio un error en el servidor!");                                   
                                    console.log(error);
                                });
                            } else{
                                    toastr.warning('No se elimino la asignatura');
                            }
                }) 
            },
            resetForm(){
                this.curso = {
                    nombre_asignatura: '',
                    ciclo: '',
                    tipo: '',
                    ht: '',
                    hp: '',
                    total: '',
                    creditos: '',
                    requisitos: [],
                    departamentos: [],
                }
            },
            resetForm2(){
                this.curso_editar = {
                    id: '',
                    nombre_asignatura: '',
                    ciclo: '',
                    tipo: '',
                    ht: '',
                    hp: '',
                    total: '',
                    creditos: '',
                    requisitos: [],
                    departamentos: [],
                }
            },

            
            nuevaAsignatura(){
                this.getObtenerCursosRequisitos();
                $('#asignatura').modal('show');
            },
            verEditar(id_curso){
                this.resetForm2();
                this.getCursoEditar(id_curso);
                $('#asignatura-editar').modal('show');
            },
            verPlanEstudios(){
                 this.getCursosExistentes();
                $('#planEstudios').modal('show');
            },
            AsignaturaExistente(){
                this.getCursosExistentes();
                $('#existente').modal('show');
            },
            mySelectEvent({id,  text}){
                console.log({id, text})
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

.table td, .table th{
    vertical-align: middle !important;
}
.select2-container .select2-selection--multiple .select2-selection__rendered{
    /*display: block !important;*/
}
.modal-full {
    min-width: 95%;
    margin-left: 80;
}

.modal-full .modal-content {
    min-height: 30vh;
}
 .ESPECÍFICO{
            background-color: #F76725 !important;
        }
        .ESPECIALIDAD{
            background-color: #41BCC3;
        }
        .GENERAL{
            background-color: #5FC341;
        }
        .EXTRACURRICULAR{
            background-color: #5FC341;
        }
</style>