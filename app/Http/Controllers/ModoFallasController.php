<?php

namespace App\Http\Controllers;

use App\Models\LineaProducto;
use App\Models\Menu;
use App\Models\ModoFallas;
use App\Models\PreguntaSolicitud;
use App\Models\SubTipoInformacion;
use App\Models\TipoInformacion;
use Illuminate\Http\Request;
use Session;

class ModoFallasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $questionType = array_merge(['' => 'Seleccione'], PreguntaSolicitud::getPossibleEnumValues('tipo'));
        $information = TipoInformacion::all();
        //$solicitud = SubTipoInformacion::all();
        $mode_fail = ModoFallas::all();
        $line = LineaProducto::all();
        $questions = PreguntaSolicitud::all();
        $user = Session::get('username');
        $items = Menu::getMenu2($user);
        return view("pages.modofalla.index", ['items' => $items, "mode_fail" => $mode_fail, "information" => $information, "line" => $line, "questions" => $questions, 'questionType' => $questionType]);
    }
    public function showForm()
    {
        $information = TipoInformacion::all()->pluck("informacion","id");
        $information->prepend('Seleccione','');
        //$solicitud = SubTipoInformacion::all();

        $mode_fail = ModoFallas::all()->pluck("modo_falla","id_modofalla");
        $mode_fail->prepend('Seleccione','');

        $line = LineaProducto::all()->pluck("linea","id");
        $line->prepend('Seleccione','');

        $questions = PreguntaSolicitud::all();
        $user = Session::get('username');
        $items = Menu::getMenu2($user);
        $tipo = array_merge(['' => 'Seleccione'], PreguntaSolicitud::getPossibleEnumValues('tipo'));

        return view("pages.modofalla.create", ['items' => $items, "mode_fail" => $mode_fail, "information" => $information, "line" => $line, "questions" => $questions, "questionType" => $tipo]);
    }
    public function create(Request $request)
    {
        if (!empty($request->questions && $request->fail && $request->line && $request->information)) {
            try
            {
                foreach ($request->questions as $key => $question) {
                    $questionModel = new PreguntaSolicitud;
                    $questionModel->id_fallo = $request->fail;
                    $questionModel->id_lineaproducto = $request->line;

                    $questionModel->pregunta = $question['question'];
                    $questionModel->tooltip = $question['tooltip'];
                    $questionModel->tipo = $question['filetype'];
                    $questionModel->id_tiposolicitud = $request->information;
                    $questionModel->save();
                }
                return response()->json(['ok' => 'success', 'message' => 'Preguntas creadas correctamente']);
            } catch (\Exception $e) {
                $e->getMessage();
                return response()->json(['ok' => 'error', 'message' => 'Error al guardar en la base de datos']);
            }
        } else {return response()->json(['ok' => 'error', 'message' => 'Ingrese todos los campos.']);}
    }
    public function newMode(Request $request)
    {
        //$this->mode = ModoFallas::where('modo_falla', '=', $request->modo_falla)->first();
        //return response()->json([ 'ok' => 'error', 'message' => $this->mode->modo_falla ]);
        //if( $this->mode->modo_falla == $request->modo_falla ) return response()->json([ 'ok' => 'error', 'message' => $this->mode->modo_falla ]);
        try
        {
            $mode = new ModoFallas;

            $mode->modo_falla = $request->modo_falla;
            $mode->timestamps = false;
            $mode->save();
            return response()->json(['ok' => 'success', 'message' => 'Registro creado correctamente']);
        } catch (\Exception $e) {
            $e->getMessage();
            return response()->json(['ok' => 'error', 'message' => 'Error al guardar en la base de datos']);
        }
    }
    public function questionsExists(Request $request)
    {
        if (!empty($request->id_fallo) && !empty($request->id_lineaproducto) && !empty($request->id_tiposolicitud)) {
            $question = PreguntaSolicitud::where('id_fallo', $request->id_fallo)->where('id_lineaproducto', $request->id_lineaproducto)->where('id_tiposolicitud', $request->id_tiposolicitud)->get();
        } else {
            $question = PreguntaSolicitud::all();
        }
        return response()->json(['html' => view("pages.modofalla.question-set", ['question' => $question])->render()]);
    }
    public function fillSelect(Request $request)
    {
        if (!$request->id && $request->m != 'mode') {
            $html = '<option value="">' . trans('pleaseSelect') . '</option>';
        } else {
            $html = '<option value=""> Seleccione </option>';
            switch ($request->m) {
                case 'mode':
                    $options = (!$request->id) ? ModoFallas::all() : ModoFallas::where('id', $request->id)->get();
                    foreach ($options as $option) {
                        $html .= '<option value="' . $option->id_modofalla . '">' . $option->modo_falla . '</option>';
                    }
                    break;
                case 'type':
                    $options = (!$request->id) ? SubTipoInformacion::all() : SubTipoInformacion::where('id_tipo', $request->id)->get();
                    foreach ($options as $option) {
                        $html .= '<option value="' . $option->id . '">' . $option->sub_tipo . '</option>';
                    }
                    break;
                case 'line':
                    $options = (!$request->id) ? LineaProducto::all() : LineaProducto::where('id', $request->id)->get();
                    foreach ($options as $option) {
                        $html .= '<option value="' . $option->id . '">' . $option->linea . '</option>';
                    }
                    break;
                default:
                    $html = '';
                    break;
            }
        }
        return response()->json(['html' => $html]);
    }
    public function searchOneQuestion(Request $request)
    {
        if (!empty($request->id_question)) {
            $data = PreguntaSolicitud::where('id_pregunta', $request->id_question)->get();
            $array = array();
            if (count($data) > 0) {
                $array['question'] = $data[0]->pregunta;
                $array['tooltip'] = $data[0]->tooltip;
                $array['tipo'] = $data[0]->tipo;
                return response()->json(['ok' => true, 'data_search' => $array]);
            } else {
                return response()->json(['ok' => false, 'data_search' => '']);
            }
        } else {
            return response()->json(['ok' => false, 'data_search' => '']);
        }
    }
    public function UpdateQuestions(Request $request)
    {
        try
        {
            $data = PreguntaSolicitud::where('id_pregunta', $request->id_question)
                ->update(['pregunta' => $request->question,
                          'tooltip' => $request->tooltip,
                          'tipo' => $request->questionType]);

            return response()->json(['ok' => 'success', 'message' => 'Pregunta actualizada correctamente']);
        } catch (\Exception $e) {
            $e->getMessage();
            return response()->json(['ok' => 'error', 'message' => 'Error al guardar en la base de datos']);
        }
    }
}
