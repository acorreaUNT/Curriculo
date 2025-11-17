<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


//PROGRAMAS DE ESTUDIOS
Route::get('/programa-estudios432423423', 'ProgramaEstudiosController@index')->name('programa.estudio');
Route::post('/programa-estudios-store42334', 'ProgramaEstudiosController@store')->name('programa.estudios.store');

//PLAN DE TRABAJO
Route::get('/plan-trabajo', 'PlanTrabajoController@index')->name('plan.trabajo');
Route::post('/plan-trabajo-update', 'PlanTrabajoController@update')->name('plan.trabajo.update');
Route::post('/plan-trabajo-integrante', 'PlanTrabajoController@storeIntegrante')->name('plan.trabajo.store.integrante');
Route::post('/plan-trabajo-integrante-eliminar/{id}', 'PlanTrabajoController@deleteIntegrante')->name('integrante.eliminar');
Route::get('/plan-trabajo-integrante-editar/{id}', 'PlanTrabajoController@editIntegrante')->name('integrante.editar');
Route::post('/plan-trabajo-integrante-update', 'PlanTrabajoController@updateIntegrante')->name('plan.trabajo.integrante.update');
Route::get('/plan-trabajo-reporte', 'PlanTrabajoController@reporte')->name('plan.trabajo.pdf');
Route::post('/plan-trabajo-validacion', 'PlanTrabajoController@validar')->name('plan.trabajo.validar');


//PLAN DE ESTUDIOS
Route::get('/plan-estudios', 'PlanEstudioController@index')->name('plan.estudios');
Route::post('/plan-estudios-store', 'PlanEstudioController@store')->name('plan.estudios.store');
Route::get('/plan-estudios-delete', 'PlanEstudioController@eliminar')->name('plan.estudio.eliminar');
Route::get('/plan-estudios-adicionar', 'PlanEstudioController@adicionar')->name('plan.estudio.adicionar');
Route::get('/plan-estudios-reporte', 'PlanEstudioController@reporte')->name('plan.estudios.pdf');

//CURSOS PLAN DE ESTUDIOS
Route::get('/plan-estudios-cursos/{ciclo}', 'CursosPlanEstudiosController@index')->name('plan.estudios.cursos');
Route::get('/cursos-ciclo-plan/{ciclo}/{plan_id}', 'CursosPlanEstudiosController@getCursosXCiclo')->name('cursos.plan.get');
Route::get('/cursos-ciclo-requisito/{plan}', 'CursosPlanEstudiosController@getCursosRequisitoCiclo')->name('cursos.requisitos.get');
Route::get('/departamentos-cursos-ciclo-plan/{id_curso}', 'CursosPlanEstudiosController@getDepartamentoXCurso')
->name('departamentos.cursos.get');
Route::post('/cursos-ciclo-store', 'CursosPlanEstudiosController@store')->name('store.cursos.plan');

//SUMILLAS
Route::get('/sumillas', 'SumillaController@index')->name('sumillas');
Route::get('/sumillas/{id_curso}', 'SumillaController@edit')->name('sumilla.llenar');
Route::post('/sumillas-update', 'SumillaController@update')->name('sumilla.update');
Route::get('/sumillas-reporte', 'SumillaController@reporte')->name('sumilla.pdf');

//COMPETENCIAS
Route::get('/competencias', 'CompetenciaController@index')->name('competencias');
Route::get('/lista-competencias/{id_tipo}', 'CompetenciaController@listaCompetencias')->name('competencias.llenar');
Route::post('/competencia-store', 'CompetenciaController@store')->name('competencia.store');
Route::post('/competencia-delete/{id_competencia}', 'CompetenciaController@delete')->name('competencia.eliminar');
Route::post('/capacidad-store', 'CompetenciaController@storeCapacidad')->name('capacidad.store');
Route::post('/competencia-update-competencia/{id_competencia}', 'CompetenciaController@updateCompetencia')->name('competencia.update');
Route::post('/capacidad-delete/{id_capacidad}', 'CompetenciaController@deleteCapacidad')->name('capacidad.eliminar');
Route::get('/competencias-reporte', 'CompetenciaController@reporte')->name('competencias.pdf');

//ARTICULACION
Route::get('/articulacion/{id}', 'ArticulacionController@index')->name('articulacion');
Route::get('/cursos-mapa/{id_capacidad}', 'ArticulacionController@getCursosCapacidad')->name('cursos.mapa.get');
Route::post('/registrar-articulacion', 'ArticulacionController@storeArticulacion')->name('store.articulacion');
Route::post('/actualizar-articulacion', 'ArticulacionController@updateArticulacion')->name('update.articulacion');

Route::get('/cursos-articulados-borrar/{id_curso}', 'ArticulacionController@deleteCurso')->name('delete.curso');
Route::get('/cursos-mapa-existentes/{id_plan_estudio}', 'ArticulacionController@getCursosMapaExistentes')->name('cursos.existentes.get');
Route::post('/registrar-articulacion-cursos-existentes', 'ArticulacionController@storeArticulacionCursoExistente')->name('store.articulacion.curso.existente');
Route::get('/cursos-editar/{id_curso}', 'ArticulacionController@getCursoEditar')->name('cursos.editar.get');



//MAPA CURRICULAR
Route::get('/mapa-currilar', 'MapaCurricularController@index')->name('mapa.curricular');
Route::get('/mapa-currilar-llenado/{id_tipo}', 'MapaCurricularController@mapaCurricular')->name('mapa.currilar.llenar');
Route::post('/mapa-curricular-update', 'MapaCurricularController@updateMapa')->name('relacion.mapa.curricular');
Route::get('/mapa-curricular-reporte', 'MapaCurricularController@reporte')->name('mapa.curricular.pdf');

//ASIGNATURAS
Route::get('/asignaturas', 'AsignaturaController@index')->name('asignaturas');

//PRESENTACION
Route::get('/presentacion', 'PresentacionController@index')->name('presentacion');
Route::post('/presentacion-update', 'PresentacionController@update')->name('presentacion.update');
Route::get('/presentacion-reporte', 'PresentacionController@reporte')->name('presentacion.pdf');

//CREDITOS - RESPONSABLES
Route::get('/credito', 'CreditoController@index')->name('credito');
Route::post('/credito-update', 'CreditoController@update')->name('credito.update');
Route::get('/credito-reporte', 'CreditoController@reporte')->name('credito.pdf');

//CONTEXTUALIZACION
Route::get('/contextualizacion', 'ContextualizacionController@index')->name('contextualizacion');
Route::post('/contextualizacion-update', 'ContextualizacionController@update')->name('contextualizacion.update');
Route::get('/contextualizacion-reporte', 'ContextualizacionController@reporte')->name('contextualizacion.pdf');

//GRADUACION Y TITULACION
Route::get('/graduacion', 'GraduacionController@index')->name('graduacion');
Route::post('/graduacion-update', 'GraduacionController@update')->name('graduacion.update');
Route::get('/graduacion-reporte', 'GraduacionController@reporte')->name('graduacion.pdf');

//TABLA DE CONVALIDACIONES
Route::get('/tabla_convalidaciones', 'TablaConvalidacionController@index')->name('tabla_convalidacion');
Route::post('/tabla_convalidacion-store', 'TablaConvalidacionController@store')->name('tabla_convalidacion.store');
Route::post('/tabla_convalidacion-update', 'TablaConvalidacionController@update')->name('tabla_convalidacion.update');
Route::get('/tabla_convalidacion-reporte', 'TablaConvalidacionController@reporte')->name('tabla_convalidacion.pdf');
Route::post('/tabla_convalidacion-delete/{id_tabla}', 'TablaConvalidacionController@deleteDetalle')->name('detalle.eliminar');



//INTRODUCCION
Route::get('/introduccion', 'IntroduccionController@index')->name('introduccion');
Route::post('/introduccion-update', 'IntroduccionController@update')->name('introduccion.update');
Route::get('/introduccion-reporte', 'IntroduccionController@reporte')->name('introduccion.pdf');

//INDICE
Route::get('/indice', 'IndiceController@index')->name('indice');
Route::post('/indice-update', 'IndiceController@update')->name('indice.update');
Route::get('/indice-reporte', 'IndiceController@reporte')->name('indice.pdf');

//PERFILES
Route::get('/perfil', 'PerfilController@index')->name('perfil');
Route::post('/perfil-update', 'PerfilController@update')->name('perfil.update');
Route::get('/perfil-reporte', 'PerfilController@reporte')->name('perfil.pdf');

//ESTUDIO DE LA DEMANDA
Route::get('/estudio_demanda', 'EstudioDemandaController@index')->name('estudio_demanda');
Route::post('/estudio_demanda-update', 'EstudioDemandaController@update')->name('estudio_demanda.update');
Route::get('/estudio_demanda-reporte', 'EstudioDemandaController@reporte')->name('estudio_demanda.pdf');

//OBJETIVOS EDUCACIONALES
Route::get('/objetivos', 'ObjetivosController@index')->name('objetivo');
Route::post('/objetivos-update', 'ObjetivosController@update')->name('objetivo.update');
Route::get('/objetivos-reporte', 'ObjetivosController@reporte')->name('objetivo.pdf');

//ESTRATEGIAS EDUCACIONALES
Route::get('/estrategias', 'EstrategiasController@index')->name('estrategia');
Route::post('/estrategias-update', 'EstrategiasController@update')->name('estrategia.update');
Route::get('/estrategias-reporte', 'EstrategiasController@reporte')->name('estrategia.pdf');

//CARÁTULA
Route::get('/caratula', 'CaratulaController@index')->name('caratula');
Route::post('/caratula-update', 'CaratulaController@update')->name('caratula.update');
Route::get('/caratula-reporte', 'CaratulaController@reporte')->name('caratula.pdf');

//REFERENCIAS BIBLIOGRÁFICAS
Route::get('/referencia', 'ReferenciasController@index')->name('referencia');
Route::post('/referencia-update', 'ReferenciasController@update')->name('referencia.update');
Route::get('/referencia-reporte', 'ReferenciasController@reporte')->name('referencia.pdf');

//ANEXOS
Route::get('/anexo', 'AnexoController@index')->name('anexo');
Route::post('/anexo-update', 'AnexoController@update')->name('anexo.update');
Route::get('/anexo-reporte', 'AnexoController@reporte')->name('anexo.pdf');

//MALLA CURRICULAR
Route::get('/malla', 'MallaCurricularController@index')->name('malla');
Route::post('/malla-update', 'MallaCurricularController@update')->name('malla.update');
Route::get('/malla-reporte', 'MallaCurricularController@reporte')->name('malla.pdf');
//BASES GENERALES
//NORMATIVAS
Route::get('/bases-generales-normativas', 'BaseGeneralController@baseNormativa')->name('base_general');
Route::post('/base-normativa-update', 'BaseGeneralController@baseNormativaUpdate')->name('base_normativa.update');
//INSTITUCIONALES
Route::get('/bases-generales-institucionales', 'BaseGeneralController@baseInstitucional')->name('base_instucional');
Route::post('/base-institucional-update1', 'BaseGeneralController@baseInstitucionalUpdate1')->name('base_institucional.update1');
Route::post('/base-institucional-update2', 'BaseGeneralController@baseInstitucionalUpdate2')->name('base_institucional.update2');
Route::post('/base-institucional-update3', 'BaseGeneralController@baseInstitucionalUpdate3')->name('base_institucional.update3');
//BASES CONCEPTUALES
Route::get('/bases-generales-conceptuales', 'BaseGeneralController@baseConceptuales')->name('base_conceptuales');
Route::post('/base-general-update1', 'BaseGeneralController@baseConceptualUpdate1')->name('base_conceptuales.update1');
Route::post('/base-general-update2', 'BaseGeneralController@baseConceptualUpdate2')->name('base_conceptuales.update2');
Route::post('/base-general-update3', 'BaseGeneralController@baseConceptualUpdate3')->name('base_conceptuales.update3');
Route::get('/base-general-reporte', 'BaseGeneralController@reporte')->name('base_general.pdf');

//EJE CURRICULAR
Route::get('/eje-curricular', 'EjeCurricularesController@index')->name('eje_curricular');
Route::post('/eje-curricular-update', 'EjeCurricularesController@update')->name('eje_curricular.update');
Route::get('/eje-curricular-reporte', 'EjeCurricularesController@reporte')->name('eje_curricular.pdf');

//LISTADOS
Route::get('/listar-departamentos', 'ApiController@getDepartamentos')->name('departamentos.get');
Route::get('/listar-capacidades/{id_competencia}', 'ApiController@getCapacidades')->name('capacidades.get');

//LINEAMIENTOS
Route::get('/lineamientos', 'LineamientoController@index')->name('lineamiento');
Route::post('/lineamientos-update', 'LineamientoController@update')->name('lineamiento.update');
Route::get('/lineamientos-reporte', 'LineamientoController@reporte')->name('lineamiento.pdf');

//SISTEMA DE EVALUACION
Route::get('/sistema-evaluacion', 'SistemaEvaluacionController@index')->name('sistema_evaluacion');
Route::post('/sistema-evaluacion-update', 'SistemaEvaluacionController@update')->name('sistema_evaluacion.update');
Route::get('/sistema-evaluacion-reporte', 'SistemaEvaluacionController@reporte')->name('sistema_evaluacion.pdf');


//DESCARGAR CURRICULO
Route::get('/curriculo-generado3543423', 'ApiController@reporteCurriculo')->name('curriculo.generado');

//EDITAR USUARIO
Route::get('/usuario-editar', 'UserController@edit')->name('editar.usuario');
Route::post('/usuario-update', 'UserController@update')->name('update.usuario');

