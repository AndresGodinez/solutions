<?php

namespace App\Http\Controllers\Auth;

use App\BitacoraUsuario;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use function app_path;
use function redirect;
use function session_destroy;

use Illuminate\Support\Facades\Auth;
use Session;
use function redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function login(Request $request)
    {

        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {

            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     */
    protected function authenticated(Request $request, $user)
    {
        BitacoraUsuario::create([
            'usuario_id' => $user->id
        ]);

        Session::put('session', true);
        Session::put('soluciones', true); // REPLACE TO session_register("soluciones");
        Session::put('username', $user->username);
        Session::put('nombre', $user->nombre);
        Session::put('mail', $user->mail);
        Session::put('id_region', $user->id_region);
        Session::put('nivel', '');
        Session::put('edocta_acceso', '');
        Session::put('alcopar', '');
        Session::put('alcopar_nivel', '');
        Session::put('pagotalleres', '');
        Session::put('encuestas', '');
        Session::put('reportesac', '');
        Session::put('reportealcopar', '');
        Session::put('pex', '');
        Session::put('pex_nivel', '');
        Session::put('upload_logistica', '');
        Session::put('depto', $user->depto);
        Session::put('zgas', '');
        Session::put('reporte_encuesta', '');
        Session::put('alta_pedido', '');
        Session::put('pedido_nivel', '');
        Session::put('reporte_kpi', '');
        Session::put('pagotaller_nivel', '');
        Session::put('consulta', '');
        Session::put('ciclicos', '');
        Session::put('planta', $user->planta);
        Session::put('surtimiento', '');
        Session::put('cat_ing', '');
        Session::put('po_menu', '');
        Session::put('promesa', '');
        Session::put('recibo', '');
        Session::put('labels', '');
        Session::put('ingreso_mat', '');
        Session::put('ingreso_fact', '');
        Session::put('acp_nivel', '');
        Session::put('acp', '');
        Session::put('kitchen', '');
        Session::put('nivel_kitchen', '');
        Session::put('ingenieria_nivel', '');
        Session::put('ingenieria', '');
        Session::put('linea_prod', '');
        Session::put('kpi_talleres', '');
        Session::put('listado', '');
        Session::put('poliza', '');
        Session::put('poliza_nivel', '');
        Session::put('reporte_mat', '');
        Session::put('activo', $user->activo);
        Session::put('pedido_nuevo', '');
        Session::put('pedido_nivel_nuevo', '');
        Session::put('reincidencia', '');
        Session::put('tp_acceso', '');
        Session::put('status', '');
        Session::put('f_promesa', '');
        Session::put('stock', '');
        Session::put('stock_nivel', '');
        Session::put('stock_basico', '');
        Session::put('admin', $user->admin);
        Session::put('regionName', $user->region->name);
        Session::put('regionCode', $user->region->short_name);
        //Establecer variables de sesion en el SESSION nativo de PHP para compartir con soluciones1
        session_start();
        foreach(session()->all() as $k=>$v)
        {
            $_SESSION[$k] = $v;
        }

        $url = config('pages.globals.url')."main/admin.php";
        return redirect()->away($url);
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        Session::forget('session', true);
        Session::forget('soluciones', true); // REPLACE TO session_register("soluciones");
        Session::forget('username', $user->username);
        Session::forget('nombre', $user->nombre);
        Session::forget('mail', $user->mail);
        Session::forget('region', $user->id_region);
        Session::forget('nivel', '');
        Session::forget('edocta_acceso', '');
        Session::forget('alcopar', '');
        Session::forget('alcopar_nivel', '');
        Session::forget('pagotalleres', '');
        Session::forget('encuestas', '');
        Session::forget('reportesac', '');
        Session::forget('reportealcopar', '');
        Session::forget('pex', '');
        Session::forget('pex_nivel', '');
        Session::forget('upload_logistica', '');
        Session::forget('depto', $user->depto);
        Session::forget('zgas', '');
        Session::forget('reporte_encuesta', '');
        Session::forget('alta_pedido', '');
        Session::forget('pedido_nivel', '');
        Session::forget('reporte_kpi', '');
        Session::forget('pagotaller_nivel', '');
        Session::forget('consulta', '');
        Session::forget('ciclicos', '');
        Session::forget('planta', $user->planta);
        Session::forget('surtimiento', '');
        Session::forget('cat_ing', '');
        Session::forget('po_menu', '');
        Session::forget('promesa', '');
        Session::forget('recibo', '');
        Session::forget('labels', '');
        Session::forget('ingreso_mat', '');
        Session::forget('ingreso_fact', '');
        Session::forget('acp_nivel', '');
        Session::forget('acp', '');
        Session::forget('kitchen', '');
        Session::forget('nivel_kitchen', '');
        Session::forget('ingenieria_nivel', '');
        Session::forget('ingenieria', '');
        Session::forget('linea_prod', '');
        Session::forget('kpi_talleres', '');
        Session::forget('listado', '');
        Session::forget('poliza', '');
        Session::forget('poliza_nivel', '');
        Session::forget('reporte_mat', '');
        Session::forget('activo', $user->activo);
        Session::forget('pedido_nuevo', '');
        Session::forget('pedido_nivel_nuevo', '');
        Session::forget('reincidencia', '');
        Session::forget('tp_acceso', '');
        Session::forget('status', '');
        Session::forget('f_promesa', '');
        Session::forget('stock', '');
        Session::forget('stock_nivel', '');
        Session::forget('stock_basico', '');
        Session::forget('admin', $user->admin);
        Session::forget('regionName','');
        Session::forget('regionCode','');
        if (session()->all()){
//            session_destroy();
        }
        Auth::logout();
        return redirect(env('BASE_PATH').'/');
    }
}
