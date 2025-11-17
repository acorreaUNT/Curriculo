<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramaEstudios;
use App\Models\PlanEstudio;
use App\Models\CursoDepartamento;
use App\Models\CursosPlanEstudios;
use App\Models\Competencias;
use App\Models\Capacidades;
use App\Models\MapaCurricular;
use App\Models\Sumilla;
use App\Models\Facultad;
use App\User;

class ProgramaEstudiosController extends Controller
{
    public function __construct()
    {
        set_time_limit(8000000);
        $this->middleware('auth');
    }

    public function index(){
        $programas_estudios = ProgramaEstudios::all();
        $facultades = Facultad::all();
        return view('admin.pages.programas_estudios.index')->with(compact('programas_estudios','facultades'));
    }

    public function store(Request $request){
        //Usuario
        $usuario = new User();
        $usuario->name = $request->nombre_programa;
        $usuario->persona = $request->persona;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        $usuario->pass = $request->password;
        $usuario->rol = 'coteccu';
        $usuario->save();

        $usuario2 = new User();
        $usuario2->name = $request->nombre_programa;
        $usuario2->persona = $request->persona2;
        $usuario2->email = $request->email2;
        $usuario2->password = bcrypt($request->password2);
        $usuario2->pass = $request->password2;
        $usuario2->rol = 'supervisor';
        $usuario2->save();

        //Programa de Estudios
        $programa = new ProgramaEstudios();
        $programa->id_user = $usuario->id;
        $programa->id_user2 = $usuario2->id;
        $programa->nombre_programa = $request->nombre_programa;
        $programa->num_ciclos = $request->num_ciclos;
        $programa->id_facultad = $request->id_facultad;
        $programa->porcentaje = 0.00;
        $programa->save();

        //Plan de estudios
        $plan = new PlanEstudio();
        $plan->id_programa_estudios = $programa->id;
        $plan->total_ht = 0;
        $plan->total_hp = 0;
        $plan->total_h = 0;
        $plan->total_creditos = 0;
        $plan->save();
        
        //Cursos Plan de Estudios
        $this->agregarCompetencia($programa->id, $plan->id);
        //$this->agregarCursoGeneral($plan->id);
        return back();
    }

    public function agregarCompetencia($id_programa_estudios, $id_plan_estudio){
        $competencia = Competencias::create([
            'id_programa_estudios' => $id_programa_estudios,
            'id_tipo_competencia' => 1,
            'codigo' => 'G1',
            'contenido' => 'COMPETENCIA INSTRUMENTAL: Gestiona sus habilidades investigativas utilizando el razonamiento lógico-matemático, la comunicación efectiva, el saber popular y el conocimiento científicotecnológico para comprender racionalmente la realidad y aportar soluciones a los problemas diversos de la región y del país.'
        ]);

        //Capacidades 1ra competencia
        $capacidad = new Capacidades();
        $capacidad->id_competencia = $competencia->id;
        $capacidad->codigo = 'G1.01';
        $capacidad->contenido = 'Aplica el instrumental teórico de la Epistemología, la Lógica y la Matemática para analizar la realidad y desarrollar crítica y creativamente los procesos de la investigación científica y tecnológica, generando alternativas de solución a problemas cotidianos, científicos, tecnológicos y humanos.';
        $capacidad->save();

        //Curso Articulado
        $curso = CursosPlanEstudios::create([
            'id_plan_estudio' => $id_plan_estudio,
            'ciclo' => 'II',
            'codigo_capacitaciones' => $capacidad->codigo,
            'nombre' => 'Lógica y argumentación científica',
            'tipo' => 'GENERAL',
            'naturaleza' => 'Teórico / Práctico',
            'ht' => 3,
            'hp' => 2,
            'h_semana' => 5,
            'total_h' => 64,
            'creditos' => 4,
            'posicion' => '0 -140',
            'color' => '#5FC341' ,
        ]);

        $sumilla = new Sumilla();
        $sumilla->id_curso = $curso->id;
        $sumilla->contenido_sumillas = 'La asignatura de Lógica y argumentación científica es de naturaleza teórica y práctica, de carácter obligatoria; tiene como propósito
        que el estudiante aplique el instrumental teórico de la Lógica formal y dialéctica para desarrollar los procesos de la investigación
        científica y la comprensión adecuada, racional y crítica de la realidad, para lo cual debe desarrollar los siguientes bloques temáticos:
        I. Lógica dialéctica para la investigación (Principios dialécticos, categorías de cognición, procedimientos de cognición: definición,
        división, clasificación, demostración, refutación)
        II. Lógica formal para el discurso científico (Teoría del concepto, del juicio y del raciocinio, falacias), la argumentación científica.
        III. Teoría y práctica de la argumentación científica. Ejercicios.
        Estrategias de enseñanza - aprendizaje básicas: Seminario-Taller, estudio de casos';
        $sumilla->ejes_transversales = 'Investigación formativa, I+D+i (investigación + desarrollo + innovación), identidad,
        interculturalidad e inclusividad.';
        $sumilla->perfil_docente = 'Docente Licenciado en Filosofía o Licenciado en
        Educación con mención en Filosofía adscrito al
        Departamento Académico de Filosofía y Arte.
        Docente Licenciado en Matemáticas adscrito al
        Departamento Académico de Matemáticas. Todos
        con grado de Maestro o Doctor.';
        $sumilla->save();

        $departamento = new CursoDepartamento();
        $departamento->id_curso = $curso->id;
        $departamento->id_departamento = 21;
        $departamento->save();

        $departamento = new CursoDepartamento();
        $departamento->id_curso = $curso->id;
        $departamento->id_departamento = 13;
        $departamento->save();

        $mapa = new MapaCurricular();
        $mapa->id_capacidad = $capacidad->id;
        $mapa->id_curso_plan_estudios = $curso->id;
        $mapa->save();

        //------------------------------------------------------------------------------------------------------------------------

        $capacidad = new Capacidades();
        $capacidad->id_competencia = $competencia->id;
        $capacidad->codigo = 'G1.02';
        $capacidad->contenido = 'Emplea, los fundamentos, técnicas y recursos de la
        comunicación oral y escrita, para analizar,
        comprender y sistematizar información y textos,
        preferentemente académicos, y así poder argumentar
        con sentido crítico y fundamentado los aspectos más
        relevantes de la problemática regional y nacional
        dentro del contexto global, proponiendo y sustentando
        alternativas creativas y viables de solución.';
        $capacidad->save();

        //CURSO 1
        $curso = CursosPlanEstudios::create([
            'id_plan_estudio' => $id_plan_estudio,
            'ciclo' => 'I',
            'codigo_capacitaciones' => $capacidad->codigo,
            'nombre' => 'Comunicación, lectura crítica y producción de textos académicos',
            'tipo' => 'GENERAL',
            'naturaleza' => 'Teórico / Práctico',
            'ht' => 3,
            'hp' => 2,
            'h_semana' => 5,
            'total_h' => 64,
            'creditos' => 4,
            'posicion' => '0 0',
            'color' => '#5FC341' ,
        ]);

        $sumilla = new Sumilla();
        $sumilla->id_curso = $curso->id;
        $sumilla->contenido_sumillas = 'La asignatura de Comunicación, lectura crítica y producción de textos académicos es obligatoria y de naturaleza teóricopráctica; tiene como propósito lograr que el estudiante emplee los fundamentos, técnicas y recursos de la comunicación oral y
        escrita para analizar, comprender y sistematizar información y textos, preferentemente académicos, y así poder argumentar con
        sentido crítico y fundamentado los aspectos más relevantes de la problemática regional y nacional, dentro del contexto global,
        proponiendo y sustentando alternativas creativas y viables de solución. Los contenidos fundamentales a trabajar, según bloques
        temáticos, son:
        I) La comunicación: sus fundamentos, factores, problemas, formas. La comunicación formal.
        II) La lectura crítica: Técnicas y niveles de análisis y comprensión textual académica y político-social.
        III)Redacción de textos académicos: Técnicas y fuentes de información. Corrección idiomática y textuales. Los textos académicos:
        características, formas. La monografía, el ensayo.
        Estrategia de enseñanza– aprendizaje: seminario-taller, estudios de casos, producción textual.';
        $sumilla->ejes_transversales = 'Investigación formativa, Ética y ciudadanía, Identidad, interculturalidad e inclusividad';
        $sumilla->perfil_docente = 'Docente Licenciado en Lengua y Literatura o enComunicación, con grado de Maestro o Doctor, adscrito al Departamento Académico de Lengua y Literatura o al
        Departamento Académico de Comunicación Social. Tiene experiencia en el desarrollo de cursos relacionados con el lenguaje, la comunicación, la lectura y la producción de
        textos académicos, así como en el análisis de textos político-sociales.';
        $sumilla->save();

        $departamento = new CursoDepartamento();
        $departamento->id_curso = $curso->id;
        $departamento->id_departamento = 24;
        $departamento->save();

        $departamento = new CursoDepartamento();
        $departamento->id_curso = $curso->id;
        $departamento->id_departamento = 20;
        $departamento->save();

        $mapa = new MapaCurricular();
        $mapa->id_capacidad = $capacidad->id;
        $mapa->id_curso_plan_estudios = $curso->id;
        $mapa->save();

        //CURSO 02
        $curso2 = CursosPlanEstudios::create([
            'id_plan_estudio' => $id_plan_estudio,
            'ciclo' => 'IV',
            'codigo_capacitaciones' => $capacidad->codigo,
            'nombre' => 'Análisis crítico de la realidad nacional',
            'tipo' => 'GENERAL',
            'naturaleza' => 'Teórico / Práctico',
            'ht' => 3,
            'hp' => 2,
            'h_semana' => 5,
            'total_h' => 64,
            'creditos' => 4,
            'posicion' => '0 -420',
            'color' => '#5FC341' ,
        ]);

        $sumilla = new Sumilla();
        $sumilla->id_curso = $curso2->id;
        $sumilla->contenido_sumillas = 'La asignatura de Análisis crítico de la realidad nacional es obligatoria y de naturaleza teórico-práctica; tiene como propósito que
        el estudiante emplee los fundamentos, técnicas y recursos de la comunicación oral y escrita, para analizar, comprender y
        sistematizar información y textos, preferentemente académicos e ideológico-políticos, y así poder argumentar con sentido crítico y
        fundamentado los aspectos más relevantes de la problemática regional y nacional dentro del contexto global, proponiendo y
        sustentando alternativas creativas y viables de solución. La asignatura se organiza en los siguientes bloques temáticos:
        I. La política: definición, características, sentido e importancia social; el ser humano como un ser político
        II.Problemática política: el problema del Estado Neo liberal, sistema democrático, gobernabilidad desde la clase política
        nacional, la crisis de los partidos políticos como medios para ostentar poder, la política del centralismo; Alternativas de
        solución;
        III.Problemática sociocultural nacional: Corrupción generalizada e institucionalizada, desigualdad y violencia social, crisis de la
        educación, los medios de comunicación y el poder político; la crisis del Estado y de la gobernabilidad en el modelo neoliberal.
        Impacto socioeconómico cultural. Casos.
        Estrategia de enseñanza - aprendizaje básica: seminario taller, panel, foro, plenaria; debate, estudio de casos.';
        $sumilla->ejes_transversales = 'Responsabilidad social universitaria, Investigación formativa, I+D+i (investigación + desarrollo
        + innovación), Sostenibilidad ambiental, Ética y ciudadanía, identidad, Interculturalidad e
        inclusividad, Multidisciplinariedad e interdisciplinariedad.';
        $sumilla->perfil_docente = 'Abogado o Licenciado en Ciencias Políticas y Gobernabilidad adscrito al Departamento de Derecho; Licenciado en Educación con
        mención en Filosofía adscrito al Departamento de Filosofía y Arte, Licenciado en Sociología o Historia adscrito al Departamento Académico de Ciencias Sociales, Licenciado en Educación Secundaria con mención en Historia y Geografía adscrito al Departamento Académico de Historia y Geografía, Economista adscrito al Departamento de Ciencias Económicas; todos con grado de Maestro o Doctor y con experiencia en el desarrollo de cursos relacionados.';
        $sumilla->save();

        $departamento = new CursoDepartamento();
        $departamento->id_curso = $curso2->id;
        $departamento->id_departamento = 16;
        $departamento->save();

        $departamento = new CursoDepartamento();
        $departamento->id_curso = $curso2->id;
        $departamento->id_departamento = 21;
        $departamento->save();

        $departamento = new CursoDepartamento();
        $departamento->id_curso = $curso2->id;
        $departamento->id_departamento = 9;
        $departamento->save();

        $departamento = new CursoDepartamento();
        $departamento->id_curso = $curso2->id;
        $departamento->id_departamento = 15;
        $departamento->save();

        $departamento = new CursoDepartamento();
        $departamento->id_curso = $curso2->id;
        $departamento->id_departamento = 22;
        $departamento->save();

        $mapa = new MapaCurricular();
        $mapa->id_capacidad = $capacidad->id;
        $mapa->id_curso_plan_estudios = $curso2->id;
        $mapa->save();

        //------------------------------------------------------------------------------------------------------------------------

        //=====================================================================================================================================================================================
         //==================================================================================================================================================================================
        //==================================================================================================================================================================================
         //==================================================================================================================================================================================

        $competencia = Competencias::create([
            'id_programa_estudios' => $id_programa_estudios,
            'id_tipo_competencia' => 1,
            'codigo' => 'G2',
            'contenido' => 'COMPETENCIA INTERPERSONAL: Demuestra capacidad crítica e innovadora, habilidades interpersonales, cultura físico-mental y estética, compromiso ético-ciudadano y responsabilidad social para promover el desarrollo sostenible respetando la diversidad cultural a nivel local y global.'
        ]);

        //Capacidades de competencia 2
        $capacidad = new Capacidades();
        $capacidad->id_competencia = $competencia->id;
        $capacidad->codigo = 'G2.01';
        $capacidad->contenido = 'Demuestra control y manejo de su inteligencia
        emocional, actitud crítica, propositiva, asertiva, de
        resiliencia y habilidades sociales, realizando acciones
        éticas de respeto a la vida, a la naturaleza, a la
        comunidad y a la cultura, para la construcción de una
        sociedad inclusiva, justa y democrática';
        $capacidad->save();

        $curso = CursosPlanEstudios::create([
            'id_plan_estudio' => $id_plan_estudio,
            'ciclo' => 'I',
            'codigo_capacitaciones' => $capacidad->codigo,
            'nombre' => 'Desarrollo personal y sociocultural',
            'tipo' => 'GENERAL',
            'naturaleza' => 'Teórico / Práctico',
            'ht' => 3,
            'hp' => 2,
            'h_semana' => 5,
            'total_h' => 64,
            'creditos' => 4,
            'posicion' => '140 0',
            'color' => '#5FC341' ,
        ]);

        $sumilla = new Sumilla();
        $sumilla->id_curso = $curso->id;
        $sumilla->contenido_sumillas = 'La asignatura de Desarrollo personal y sociocultural es obligatoria y de naturaleza teórico- práctica; tiene como propósito que el
        estudiante demuestre conocimiento de sí mismo y sea capaz de manejar su inteligencia emocional, que evidencie desarrollo de s u
        actitud crítica, propositiva, asertiva, de resiliencia; que sea capaz de situarse en su contexto sociohistórico y cultural y muestre
        desarrollo de su conciencia ciudadana fundamentando y realizando acciones de respeto a la vida, a la naturaleza, a la comunidad y
        a la cultura, para la construcción de una sociedad inclusiva, justa y democrática.
        Los contenidos a desarrollarse, según bloques temáticos, son:
        I) El conocimiento de sí mismo (autoimagen, autoconcepto, autoestima, empatía, sentido crítico, manejo de emociones,
        resiliencia) con bases científicas actuales.
        II) Identidad personal, identidad sociocultural; rol social, la convivencia ciudadana
        III) El diseño del proyecto de vida: elementos, sentido, importancia, fundamentación contextualizada y en el contexto
        sociocultural, económico y sanitario de Perú.
        Estrategias de enseñanza–aprendizaje básicas: Resolución de problemas, estudio de casos, técnicas creativas,
        debates.';
        $sumilla->ejes_transversales = 'Responsabilidad social universitaria, investigación formativa, Ética y ciudadanía,
        multidisciplinariedad e interdisciplinariedad.';
        $sumilla->perfil_docente = ' Docente Licenciado en Psicología, o Licenciado en
        Educación Secundaria con la especialidad de Filosofía,
        Psicología y CCSS., Antropólogo, Licenciado en trabajo
        social, con grado de Maestro o Doctor, capacitación en
        didáctica, asertivo, dinámico y empático; docentes
        capacitados inscritos en los Departamentos Académicos de
        Ciencias Psicológicas, Arqueología y Antropología o
        Ciencias Sociales.';
        $sumilla->save();

        $departamento = new CursoDepartamento();
        $departamento->id_curso = $curso->id;
        $departamento->id_departamento = 19;
        $departamento->save();

        $departamento = new CursoDepartamento();
        $departamento->id_curso = $curso->id;
        $departamento->id_departamento = 14;
        $departamento->save();

        $departamento = new CursoDepartamento();
        $departamento->id_curso = $curso->id;
        $departamento->id_departamento = 15;
        $departamento->save();

        $mapa = new MapaCurricular();
        $mapa->id_capacidad = $capacidad->id;
        $mapa->id_curso_plan_estudios = $curso->id;
        $mapa->save();

        //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

        $capacidad = new Capacidades();
        $capacidad->id_competencia = $competencia->id;
        $capacidad->codigo = 'G2.02';
        $capacidad->contenido = 'Practica actividades deportivas, artísticas y recreacionales con disciplina, responsabilidad y respeto para el cuidado y desarrollo integral de su salud física y mental en el contexto socio cultural.';
        $capacidad->save();

        //CURSO 1
        $curso = CursosPlanEstudios::create([
            'id_plan_estudio' => $id_plan_estudio,
            'ciclo' => 'I',
            'codigo_capacitaciones' => $capacidad->codigo,
            'nombre' => 'Taller de fútbol',
            'tipo' => 'GENERAL',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 4,
            'h_semana' => 4,
            'total_h' => 64,
            'creditos' => 2,
            'posicion' => '280 0',
            'color' => '#5FC341' ,
            'estado' => null
        ]);

        $sumilla = new Sumilla();
        $sumilla->id_curso = $curso->id;
        $sumilla->contenido_sumillas = 'La asignatura Taller de fútbol es de naturaleza práctica y de carácter electivo; tiene como propósito que el estudiante practique
        actividades deportivas y recreacionales con disciplina, responsabilidad y respeto para el cuidado y desarrollo integral de su salud física
        y mental en el contexto socio cultural. Los contenidos fundamentales a trabajar, según bloques temáticos, son:
        I) Preparación física y mental para el fútbol
        II) Fundamentación técnica del fútbol
        III) Tácticas y práctica del fútbol
        Estrategias de aprendizaje básicos: Taller, trabajo en equipo';
        $sumilla->ejes_transversales = 'Responsabilidad social universitaria, Investigación formativa, Sostenibilidad ambiental, Ética y ciudadanía,
        Identidad, interculturalidad e inclusividad.';
        $sumilla->perfil_docente = 'Docente Licenciado en Educación física o futbolista
        profesional con grado de Maestro o doctor,
        capacitación en didáctica universitaria en modalidad
        presencial y no presencial, asertivo, dinámico y
        empático, adscrito al Departamento de Ciencias de la
        Educación.';
        $sumilla->save();

        $departamento = new CursoDepartamento();
        $departamento->id_curso = $curso->id;
        $departamento->id_departamento = 18;
        $departamento->save();


        $mapa = new MapaCurricular();
        $mapa->id_capacidad = $capacidad->id;
        $mapa->id_curso_plan_estudios = $curso->id;
        $mapa->save();


        //CURSO 2
        $curso = CursosPlanEstudios::create([
            'id_plan_estudio' => $id_plan_estudio,
            'ciclo' => 'I',
            'codigo_capacitaciones' => $capacidad->codigo,
            'nombre' => 'Taller de vóley',
            'tipo' => 'GENERAL',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 4,
            'h_semana' => 4,
            'total_h' => 64,
            'creditos' => 2,
            'posicion' => '280 0',
            'color' => '#5FC341' ,
            'estado' => 'electivo/general'
        ]);

        $sumilla = new Sumilla();
        $sumilla->id_curso = $curso->id;
        $sumilla->contenido_sumillas = 'La asignatura Taller de vóley es de naturaleza práctica y de carácter electivo, tiene como propósito que el estudiante practique
        actividades deportivas y recreacionales con disciplina, responsabilidad y respeto para el cuidado y desarrollo integral de su salud física
        y mental en el contexto socio cultural.
        Los contenidos fundamentales a trabajar, según bloques temáticos, son:
        I) Fundamentos generales del Voleibol;
        II) Técnicas ofensivas y defensivas en el Voleibol;
        III) Tácticas y práctica del Voleibol.
        Estrategias de aprendizaje básicas: Taller, trabajo en equipo';
        $sumilla->ejes_transversales = 'Responsabilidad social universitaria, Investigación formativa, Sostenibilidad ambiental, Ética y
        ciudadanía, Identidad, interculturalidad e inclusividad.';
        $sumilla->perfil_docente = 'Docente Licenciado en Educación física o
        voleibolista reconocido (a) con grado de Maestro
        o doctor, capacitación en didáctica universitaria
        en modalidad presencial y no presencial, asertivo,
        dinámico y empático, adscrito al Departamento de
        Ciencias de la Educación.';
        $sumilla->save();

        $departamento = new CursoDepartamento();
        $departamento->id_curso = $curso->id;
        $departamento->id_departamento = 18;
        $departamento->save();


        $mapa = new MapaCurricular();
        $mapa->id_capacidad = $capacidad->id;
        $mapa->id_curso_plan_estudios = $curso->id;
        $mapa->save();
        
        // CURSO 3
        $curso = CursosPlanEstudios::create([
            'id_plan_estudio' => $id_plan_estudio,
            'ciclo' => 'I',
            'codigo_capacitaciones' => $capacidad->codigo,
            'nombre' => 'Taller de atletismo',
            'tipo' => 'GENERAL',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 4,
            'h_semana' => 4,
            'total_h' => 64,
            'creditos' => 2,
            'posicion' => '260 -500',
            'color' => '#5FC341' ,
            'estado' => 'electivo/general'
        ]);

        $sumilla = new Sumilla();
        $sumilla->id_curso = $curso->id;
        $sumilla->contenido_sumillas = 'La asignatura Taller de atletismo es de naturaleza práctica y de carácter electivo, tiene como propósito que el estudiante
        practique actividades deportivas y recreacionales con disciplina, responsabilidad y respeto para el cuidado y desarrollo
        integral de su salud física y mental en el contexto socio cultural.
        Se organiza en bloques de contenidos temáticos:
        I) Preparación física y mental para el atletismo;
        II) Fundamentación técnica para el atletismo (carrera, marcha);
        III) Tácticas y práctica de la Carrera y la marcha.
        Estrategias de aprendizaje básicas: Taller, trabajo en equipo';
        $sumilla->ejes_transversales = 'Responsabilidad social universitaria, Investigación formativa, Sostenibilidad ambiental, Ética y
        ciudadanía, Identidad, interculturalidad e inclusividad.';
        $sumilla->perfil_docente = 'Docente Licenciado en Educación física o
        atleta reconocido con grado de Maestro o
        doctor, capacitación en didáctica
        universitaria en modalidad presencial y no
        presencial, asertivo, dinámico y empático,
        adscrito al Departamento de Ciencias de la
        Educación.';
        $sumilla->save();

        $departamento = new CursoDepartamento();
        $departamento->id_curso = $curso->id;
        $departamento->id_departamento = 18;
        $departamento->save();


        $mapa = new MapaCurricular();
        $mapa->id_capacidad = $capacidad->id;
        $mapa->id_curso_plan_estudios = $curso->id;
        $mapa->save();

        //CURSO 4
        $curso = CursosPlanEstudios::create([
            'id_plan_estudio' => $id_plan_estudio,
            'ciclo' => 'I',
            'codigo_capacitaciones' => $capacidad->codigo,
            'nombre' => 'Taller de ajedrez',
            'tipo' => 'GENERAL',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 4,
            'h_semana' => 4,
            'total_h' => 64,
            'creditos' => 2,
            'posicion' => '260 -500',
            'color' => '#5FC341' ,
            'estado' => 'electivo/general'
        ]);

        $sumilla = new Sumilla();
        $sumilla->id_curso = $curso->id;
        $sumilla->contenido_sumillas = 'La asignatura Taller de ajedrez es de naturaleza práctica y de carácter electivo; tiene como propósito que el estudiante practique
        actividades lúdico-deportivas con disciplina, responsabilidad y respeto para el cuidado y desarrollo integral de su salud mental en
        el contexto socio cultural. Se trabajan los siguientes bloques temáticos:
        I) Fundamentos generales del ajedrez;
        II) Técnicas ofensivas y defensivas en el ajedrez;
        III) Tácticas y práctica del ajedrez
        Estrategias de aprendizaje básicas: Taller, trabajo en equipo';
        $sumilla->ejes_transversales = 'Responsabilidad social universitaria, Investigación formativa, Sostenibilidad ambiental, Ética y
        ciudadanía, Identidad, interculturalidad e inclusividad.';
        $sumilla->perfil_docente = 'Docente Licenciado en Educación física o
        ajedrecista reconocido (a) con grado de Maestro
        o doctor, capacitación en didáctica universitaria
        en modalidad presencial y no presencial,
        asertivo, dinámico y empático, adscrito al
        Departamento de Ciencias de la Educación.';
        $sumilla->save();

        $departamento = new CursoDepartamento();
        $departamento->id_curso = $curso->id;
        $departamento->id_departamento = 18;
        $departamento->save();


        $mapa = new MapaCurricular();
        $mapa->id_capacidad = $capacidad->id;
        $mapa->id_curso_plan_estudios = $curso->id;
        $mapa->save();

        //CURSO 5
        $curso = CursosPlanEstudios::create([
            'id_plan_estudio' => $id_plan_estudio,
            'ciclo' => 'II',
            'codigo_capacitaciones' => $capacidad->codigo,
            'nombre' => 'Taller de danzas típicas regionales',
            'tipo' => 'GENERAL',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 4,
            'h_semana' => 4,
            'total_h' => 64,
            'creditos' => 2,
            'posicion' => '280 -140',
            'color' => '#5FC341' ,
            'estado' => null
        ]);

        $sumilla = new Sumilla();
        $sumilla->id_curso = $curso->id;
        $sumilla->contenido_sumillas = 'La asignatura Taller de danzas típicas regionales es de naturaleza práctica y de carácter electivo, tiene como propósito que el
        estudiante practique actividades artísticas y recreacionales con disciplina, responsabilidad y respeto para el cuidado y desarrollo integral de
        su salud física y mental en el contexto socio cultural.
        Se organiza en bloques temáticos:
        I) Aprestamiento e introducción a las danzas típicas regionales,
        II) Práctica rítmico - corporal y coreográfica de las danzas típicas regionales y,
        III) Ejecución y puesta en escena de las danzas típicas regionales. Estrategias de aprendizaje básicas:
        Taller, trabajo en equipo, juego de roles.';
        $sumilla->ejes_transversales = 'Responsabilidad social universitaria, Investigación formativa, Sostenibilidad ambiental, Ética y
        ciudadanía, Identidad, interculturalidad e inclusividad.';
        $sumilla->perfil_docente = 'Docente en educación artística especialidad
        danzas, u otro profesional de carrera afín o
        con experiencia certificada en enseñanza de
        danzas, con grado de Maestro o doctor,
        capacitación en didáctica universitaria en
        modalidad presencial y no presencial,
        asertivo, dinámico y empático, adscrito al
        Departamento de filosofía y Arte';
        $sumilla->save();

        $departamento = new CursoDepartamento();
        $departamento->id_curso = $curso->id;
        $departamento->id_departamento = 21;
        $departamento->save();


        $mapa = new MapaCurricular();
        $mapa->id_capacidad = $capacidad->id;
        $mapa->id_curso_plan_estudios = $curso->id;
        $mapa->save();

        //CURSO 6
        $curso = CursosPlanEstudios::create([
            'id_plan_estudio' => $id_plan_estudio,
            'ciclo' => 'II',
            'codigo_capacitaciones' => $capacidad->codigo,
            'nombre' => 'Taller de danzas típicas peruanas y latinoamericanas',
            'tipo' => 'GENERAL',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 4,
            'h_semana' => 4,
            'total_h' => 64,
            'creditos' => 2,
            'posicion' => '260 -500',
            'color' => '#5FC341' ,
            'estado' => 'electivo/general'
        ]);

        $sumilla = new Sumilla();
        $sumilla->id_curso = $curso->id;
        $sumilla->contenido_sumillas = 'La asignatura Taller de danzas típicas peruanas y latinoamericanas es de naturaleza práctica y de carácter electivo, tiene como
        propósito que el estudiante practique actividades deportivas, artísticas y recreacionales con disciplina, responsabilidad y respeto para el
        cuidado y desarrollo integral de su salud física y mental en el contexto socio cultural.
        Se organiza en los siguientes bloques temáticos:
        I) Clasificación y aprestamiento a las danzas típicas peruanas y Latinoamericanas,
        II) Desarrollo rítmico - corporal y construcción coreográfica de las danzas típicas peruanas y latinoamericanas,
        III) Ejecución y puesta en escena de las danzas típicas peruanas y latinoamericanas.
        Estrategias de aprendizaje básicas: Taller, trabajo en equipo, juego de roles.';
        $sumilla->ejes_transversales = 'Responsabilidad social universitaria, Investigación formativa, Sostenibilidad ambiental, Ética y
        ciudadanía, Identidad, interculturalidad e inclusividad.';
        $sumilla->perfil_docente = 'Docente en educación artística especialidad
        danzas, u otro profesional de carrera afín o con
        experiencia certificada en enseñanza de danzas,
        con grado de Maestro o doctor, capacitación en
        didáctica universitaria en modalidad presencial y no
        presencial, asertivo, dinámico y empático, adscrito
        al Departamento de filosofía y Arte.';
        $sumilla->save();

        $departamento = new CursoDepartamento();
        $departamento->id_curso = $curso->id;
        $departamento->id_departamento = 21;
        $departamento->save();


        $mapa = new MapaCurricular();
        $mapa->id_capacidad = $capacidad->id;
        $mapa->id_curso_plan_estudios = $curso->id;
        $mapa->save();

        //CURSO 7
        $curso = CursosPlanEstudios::create([
            'id_plan_estudio' => $id_plan_estudio,
            'ciclo' => 'II',
            'codigo_capacitaciones' => $capacidad->codigo,
            'nombre' => 'Taller de danzas modernas',
            'tipo' => 'GENERAL',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 4,
            'h_semana' => 4,
            'total_h' => 64,
            'creditos' => 2,
            'posicion' => '260 -500',
            'color' => '#5FC341' ,
            'estado' => 'electivo/general'
        ]);

        $sumilla = new Sumilla();
        $sumilla->id_curso = $curso->id;
        $sumilla->contenido_sumillas = 'La asignatura Taller de danzas modernas es de naturaleza práctica y de carácter electivo, tiene como propósito que el
        estudiante practique actividades artísticas y recreacionales con disciplina, responsabilidad y respeto para el cuidado y
        desarrollo integral de su salud física y mental en el contexto socio cultural.
        Se organiza en los siguientes bloques temáticos:
        I) introducción a los ritmos modernos,
        II) aprestamiento rítmico - corporal y secuenciación coreográfica de las danzas modernas,
        III) construcción y ejecución coreográfica de las danzas modernas.
        Estrategias de aprendizaje básicas: Taller, trabajo en equipo, juego de roles.';
        $sumilla->ejes_transversales = 'Responsabilidad social universitaria, Investigación formativa, Sostenibilidad ambiental, Ética y
        ciudadanía, Identidad, interculturalidad e inclusividad.';
        $sumilla->perfil_docente = 'Docente en educación artística especialidad danzas, u
        otro profesional de carrera afín o con experiencia
        certificada en enseñanza de danzas, con grado de
        Maestro o doctor, capacitación en didáctica
        universitaria en modalidad presencial y no presencial,
        asertivo, dinámico y empático, adscrito al
        Departamento de filosofía y Arte.';
        $sumilla->save();

        $departamento = new CursoDepartamento();
        $departamento->id_curso = $curso->id;
        $departamento->id_departamento = 21;
        $departamento->save();


        $mapa = new MapaCurricular();
        $mapa->id_capacidad = $capacidad->id;
        $mapa->id_curso_plan_estudios = $curso->id;
        $mapa->save();

        //CURSO 8
        $curso = CursosPlanEstudios::create([
            'id_plan_estudio' => $id_plan_estudio,
            'ciclo' => 'II',
            'codigo_capacitaciones' => $capacidad->codigo,
            'nombre' => 'Taller de ejecución instrumental',
            'tipo' => 'GENERAL',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 4,
            'h_semana' => 4,
            'total_h' => 64,
            'creditos' => 2,
            'posicion' => '260 -500',
            'color' => '#5FC341' ,
            'estado' => 'electivo/general'
        ]);

        $sumilla = new Sumilla();
        $sumilla->id_curso = $curso->id;
        $sumilla->contenido_sumillas = 'La asignatura Taller de ejecución instrumental es de naturaleza práctica y de carácter electivo, tiene como propósito que el
        estudiante practique actividades artísticas y recreacionales con disciplina, responsabilidad y respeto para el cuidado y
        desarrollo integral de su salud física y mental en el contexto socio cultural.
        Se organiza en los siguientes bloques temáticos:
        I) El lenguaje musical y su aplicación en instrumento musical asignado,
        II) Ejercicios de técnica para la ejecución instrumental;
        III) La ejecución e interpretación en instrumento musical.
        Estrategias de aprendizaje básicas: Taller, solfeos melódicos guiados, karaokes.';
        $sumilla->ejes_transversales = 'Responsabilidad social universitaria, Investigación formativa, Sostenibilidad ambiental, Ética y
        ciudadanía, Identidad, interculturalidad e inclusividad.';
        $sumilla->perfil_docente = 'Docente Licenciado en educación artística, o
        músico profesional, con grado de Maestro o
        doctor, capacitación en didáctica universitaria en
        modalidad presencial y no presencial, asertivo,
        dinámico y empático, adscrito al Departamento de
        filosofía y Arte.';
        $sumilla->save();

        $departamento = new CursoDepartamento();
        $departamento->id_curso = $curso->id;
        $departamento->id_departamento = 21;
        $departamento->save();


        $mapa = new MapaCurricular();
        $mapa->id_capacidad = $capacidad->id;
        $mapa->id_curso_plan_estudios = $curso->id;
        $mapa->save();

        //CURSO 9
        $curso = CursosPlanEstudios::create([
            'id_plan_estudio' => $id_plan_estudio,
            'ciclo' => 'II',
            'codigo_capacitaciones' => $capacidad->codigo,
            'nombre' => 'Taller de canto',
            'tipo' => 'GENERAL',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 4,
            'h_semana' => 4,
            'total_h' => 64,
            'creditos' => 2,
            'posicion' => '260 -500',
            'color' => '#5FC341' ,
            'estado' => 'electivo/general'
        ]);

        $sumilla = new Sumilla();
        $sumilla->id_curso = $curso->id;
        $sumilla->contenido_sumillas = 'La asignatura Taller de canto es de naturaleza práctica y de carácter electivo, tiene como propósito que el estudiante practique
        actividades artísticas y recreacionales con disciplina, responsabilidad y respeto para el cuidado y desarrollo integral de su salud física
        y mental en el contexto socio cultural.
        Se organiza en los siguientes bloques temáticos:
        I) La respiración, vocalización, y afinación para el canto,
        II) el conocimiento del lenguaje musical para el canto: solfeo melódico y canto con partitura;
        III) La práctica del canto: ejecución e interpretación.
        Estrategias de aprendizaje básicas: Taller, solfeos melódicos guiados, karaokes.';
        $sumilla->ejes_transversales = 'Responsabilidad social universitaria, Investigación formativa, Sostenibilidad ambiental, Ética y
        ciudadanía, Identidad, interculturalidad e inclusividad.';
        $sumilla->perfil_docente = 'Docente Licenciado en educación artística, o
        músico profesional, con grado de Maestro o
        doctor, capacitación en didáctica universitaria en
        modalidad presencial y no presencial, asertivo,
        dinámico y empático, adscrito al Departamento
        de filosofía y Arte.';
        $sumilla->save();

        $departamento = new CursoDepartamento();
        $departamento->id_curso = $curso->id;
        $departamento->id_departamento = 21;
        $departamento->save();


        $mapa = new MapaCurricular();
        $mapa->id_capacidad = $capacidad->id;
        $mapa->id_curso_plan_estudios = $curso->id;
        $mapa->save();

        //CURSO 10
        $curso = CursosPlanEstudios::create([
            'id_plan_estudio' => $id_plan_estudio,
            'ciclo' => 'II',
            'codigo_capacitaciones' => $capacidad->codigo,
            'nombre' => 'Taller de teatro',
            'tipo' => 'GENERAL',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 4,
            'h_semana' => 4,
            'total_h' => 64,
            'creditos' => 2,
            'posicion' => '260 -500',
            'color' => '#5FC341' ,
            'estado' => 'electivo/general'
        ]);

        $sumilla = new Sumilla();
        $sumilla->id_curso = $curso->id;
        $sumilla->contenido_sumillas = 'La asignatura Taller de teatro es de naturaleza práctica y de carácter electivo; tiene como propósito que el estudiante demuestre
        la práctica de actividades artísticas y recreacionales con disciplina, responsabilidad y respeto para el cuidado y desarrollo integral
        de su salud física y mental en el contexto socio cultural. Los contenidos fundamentales a trabajar en bloques temáticos, son:
        I) Fundamentos del arte dramático. La integración grupal con los elementos pre dramáticos para el trabajo
        creativo,
        II) Elementos básicos dramáticos en el proceso creativo y la creación dramática,
        III) Escenificación de una obra teatral.
        Estrategias de aprendizaje básicas: Taller, trabajo en equipo, escenificación, dramatización, juego de roles.';
        $sumilla->ejes_transversales = 'Responsabilidad social universitaria, Investigación formativa, Sostenibilidad ambiental, Ética y
        ciudadanía, Identidad, interculturalidad e inclusividad.';
        $sumilla->perfil_docente = 'Docente Licenciado en Arte teatral,
        Dramaturgo con grado de Maestro o doctor,
        capacitación en didáctica universitaria en
        modalidad presencial y no presencial; profesional
        con experiencia en representaciones dramáticas,
        actor, asertivo, dinámico y empático, adscrito al
        Departamento de Filosofía y Arte.';
        $sumilla->save();

        $departamento = new CursoDepartamento();
        $departamento->id_curso = $curso->id;
        $departamento->id_departamento = 21;
        $departamento->save();


        $mapa = new MapaCurricular();
        $mapa->id_capacidad = $capacidad->id;
        $mapa->id_curso_plan_estudios = $curso->id;
        $mapa->save();

        //CURSO 11
        $curso = CursosPlanEstudios::create([
            'id_plan_estudio' => $id_plan_estudio,
            'ciclo' => 'II',
            'codigo_capacitaciones' => $capacidad->codigo,
            'nombre' => 'Taller de artes plásticas',
            'tipo' => 'GENERAL',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 4,
            'h_semana' => 4,
            'total_h' => 64,
            'creditos' => 2,
            'posicion' => '260 -500',
            'color' => '#5FC341' ,
            'estado' => 'electivo/general'
        ]);

        $sumilla = new Sumilla();
        $sumilla->id_curso = $curso->id;
        $sumilla->contenido_sumillas = 'La asignatura Taller de artes plásticas es de naturaleza práctica y de carácter electivo; tiene como propósito que el
        estudiante demuestre la práctica de actividades artísticas y recreacionales con disciplina, responsabilidad y respeto para el
        cuidado y desarrollo integral de su salud física y mental en el contexto socio cultural.
        Los contenidos fundamentales a trabajar en bloques temáticos, son:
        I) El estudio de la técnica del lápiz carbón y su aplicación en temas de figuras geométricas y bodegones;
        II) la técnica del lápiz de color en temas de personajes animales y temas precolombinos;
        III) la técnica del óleo pastel en temas de paisajes peruanos.
        Estrategias de aprendizaje básicas: Taller, visitas virtuales, exposiciones virtuales a museos.';
        $sumilla->ejes_transversales = 'Responsabilidad social universitaria, Investigación formativa, Sostenibilidad ambiental, Ética y
        ciudadanía, Identidad, interculturalidad e inclusividad.';
        $sumilla->perfil_docente = 'Docente Licenciado en educación artística, o en
        artes plásticas y visuales, o pintor destacado con
        experiencia, con grado de Maestro o doctor,
        capacitación en didáctica universitaria en
        modalidad presencial y no presencial, asertivo,
        dinámico y empático, adscrito al Departamento de
        filosofía y Arte.';
        $sumilla->save();

        $departamento = new CursoDepartamento();
        $departamento->id_curso = $curso->id;
        $departamento->id_departamento = 21;
        $departamento->save();


        $mapa = new MapaCurricular();
        $mapa->id_capacidad = $capacidad->id;
        $mapa->id_curso_plan_estudios = $curso->id;
        $mapa->save();

        //------------------------------------------------------------------------------------------------ //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

        $competencia = Competencias::create([
            'id_programa_estudios' => $id_programa_estudios,
            'id_tipo_competencia' => 1,
            'codigo' => 'G3',
            'contenido' => 'COMPETENCIA SISTÉMICA: Gestiona su aprendizaje de modo integral, autónomo y continuo, adaptándose a situaciones nuevas con creatividad, trabajo en equipo, liderazgo y actitud emprendedora y comprometidos desde una visión filosófica para fomentar convivencia, identidad cultural y desarrollo del país.'
        ]);

        $capacidad = new Capacidades();
        $capacidad->id_competencia = $competencia->id;
        $capacidad->codigo = 'G3.01';
        $capacidad->contenido = 'Demuestra un manejo adecuado de sus aprendizajes al elaborar propuestas emprendedoras, con iniciativa, creatividad, liderazgo y trabajo en equipo, ante
        problemas de su entorno, que contribuyan a fomentar el desarrollo social, cultural y económico, local y regional,';
        $capacidad->save();

        $curso = CursosPlanEstudios::create([
            'id_plan_estudio' => $id_plan_estudio,
            'ciclo' => 'II',
            'codigo_capacitaciones' => $capacidad->codigo,
            'nombre' => 'Liderazgo y emprendimiento',
            'tipo' => 'GENERAL',
            'naturaleza' => 'Teórico / Práctico',
            'ht' => 3,
            'hp' => 2,
            'h_semana' => 5,
            'total_h' => 64,
            'creditos' => 4,
            'posicion' => '140 -140',
            'color' => '#5FC341' ,
        ]);

        $sumilla = new Sumilla();
        $sumilla->id_curso = $curso->id;
        $sumilla->contenido_sumillas = 'La asignatura de Liderazgo y emprendimiento es de naturaleza teórico-práctica y de carácter obligatoria; tiene como propósito
        que el estudiante, ante situaciones problemáticas de la realidad sociocultural y humana, analice y actúe con pensamiento crítico,
        creatividad, trabajo en equipo e iniciativa, proponiendo alternativas que contribuyan a fomentar el desarrollo humano, social,
        cultural y económico, local y regional. Los bloques temáticos son:
        I. Liderazgo y perfil del líder. Branding personal. El rol social del líder. Casos.
        II. El líder y el trabajo en equipo. Estrategias y técnicas del trabajo en equipo. Gestión de conflictos.
        III. La actitud emprendedora, perfil del emprendedor, habilidades y competencias. Introducción al emprendimiento empresarial:
        naturaleza, características, condiciones, formas, casos; el plan del emprendedor.
        Estrategias de enseñanza - aprendizaje básicas: Seminario-Taller, estudio de casos';
        $sumilla->ejes_transversales = 'Investigación formativa, I+D+i (investigación + desarrollo + innovación), identidad, interculturalidad e inclusividad.';
        $sumilla->perfil_docente = 'Docente Licenciado en Administración o en
        Ciencias
        Económicas, adscrito al Departamento
        Académico de Administración, Docente ingeniero
        industrial adscrito al Departamento académico de
        Ingeniería industrial. Con experiencia en el
        desarrollo de cursos relacionados con liderazgo,
        gestión empresarial, emprendimiento, coaching.
        Todos con grado de Maestro o Doctor.
        ';
        $sumilla->save();

        $departamento = new CursoDepartamento();
        $departamento->id_curso = $curso->id;
        $departamento->id_departamento = 7;
        $departamento->save();

        $departamento = new CursoDepartamento();
        $departamento->id_curso = $curso->id;
        $departamento->id_departamento = 9;
        $departamento->save();

        $departamento = new CursoDepartamento();
        $departamento->id_curso = $curso->id;
        $departamento->id_departamento = 32;
        $departamento->save();

        $mapa = new MapaCurricular();
        $mapa->id_capacidad = $capacidad->id;
        $mapa->id_curso_plan_estudios = $curso->id;
        $mapa->save();


         //------------------------------------------------------------------------------------------------------------------------

        $capacidad = new Capacidades();
        $capacidad->id_competencia = $competencia->id;
        $capacidad->codigo = 'G3.02';
        $capacidad->contenido = 'Expresa su identidad cultural valorando el proceso de desarrollo de la cultura peruana y realizando actividades de respeto por la naturaleza como condición básica para el desarrollo sostenible.';
        $capacidad->save();

        $curso = CursosPlanEstudios::create([
            'id_plan_estudio' => $id_plan_estudio,
            'ciclo' => 'III',
            'codigo_capacitaciones' => $capacidad->codigo,
            'nombre' => 'Identidad cultural e inclusividad',
            'tipo' => 'GENERAL',
            'naturaleza' => 'Teórico / Práctico',
            'ht' => 3,
            'hp' => 2,
            'h_semana' => 5,
            'total_h' => 64,
            'creditos' => 4,
            'posicion' => '140 -280',
            'color' => '#5FC341' ,
        ]);

        $sumilla = new Sumilla();
        $sumilla->id_curso = $curso->id;
        $sumilla->contenido_sumillas = 'La asignatura de Identidad cultural e inclusividad es obligatoria y de naturaleza teórico-práctica; tiene como propósito lograr que
        el estudiante fortalezca su identidad cultural y su conciencia inclusiva, valorando el proceso de desarrollo de la cultura peruana y
        realizando actividades de inclusión social como condición básica para el desarrollo del bien común. Para el logro de esta capacidad
        se proponen tres bloques temáticos:
        I. Cultura, identidad y desarrollo nacional: valores culturales regionales y nacionales; importancia de la cultura en el desarrollo del
        país; identidad cultural regional y nacional; problemas de la identidad cultural. Diversidad cultural: Enfoques: Interculturalidad,
        multiculturalidad y pluriculturalidad; cultural global; problemas que genera la cultura global en las culturas locales: análisis de casos
        de grupos étnicos,
        II. Construcción y/o rescate de la identidad cultural. Fundamentos y aportes de la Geografía, cultura y Ecología.
        III. La inclusión como problema y necesidad social, cultural, político y educativo. Enfoques y estrategias de abordaje de la
        inclusividad. Casos.
        Estrategias de enseñanza-aprendizaje básico: Método de Proyectos, Solución de problemas, estudio de casos, trabajo de campo.';
        $sumilla->ejes_transversales = 'Identidad, interculturalidad e inclusividad, Responsabilidad social universitaria,
        Investigación formativa, Sostenibilidad ambiental, Ética y ciudadanía.';
        $sumilla->perfil_docente = 'Docente Licenciado en Ciencias Sociales con
        grado de Maestro o doctor, adscrito al
        Departamento Académico de Ciencias
        Sociales o de Arqueología y Antropología.
        Licenciado en Educación Secundaria, con
        mención en Historia y Geografía, adscrito al
        Departamento de Historia y Geografía, todos
        con experiencia en el desarrollo de cursos
        relacionados con la identidad, diversidad
        cultural, inclusión social.';
        $sumilla->save();

        $departamento = new CursoDepartamento();
        $departamento->id_curso = $curso->id;
        $departamento->id_departamento = 15;
        $departamento->save();

        $departamento = new CursoDepartamento();
        $departamento->id_curso = $curso->id;
        $departamento->id_departamento = 14;
        $departamento->save();

        $departamento = new CursoDepartamento();
        $departamento->id_curso = $curso->id;
        $departamento->id_departamento = 22;
        $departamento->save();

        $departamento = new CursoDepartamento();
        $departamento->id_curso = $curso->id;
        $departamento->id_departamento = 16;
        $departamento->save();

        $mapa = new MapaCurricular();
        $mapa->id_capacidad = $capacidad->id;
        $mapa->id_curso_plan_estudios = $curso->id;
        $mapa->save();


        //------------------------------------------------------------------------------------------------------------------------
  

    }

   

  
}
