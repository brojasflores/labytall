<?php

namespace App\Utils;

use Illuminate\Contracts\Auth\User as UserContract;
use Illuminate\Contracts\Auth\UserProvider as UserProviderInterface;
use Illuminate\Contracts\Auth\Authenticatable;
use GuzzleHttp;
use Illuminate\Auth\GenericUser;
use App\Utils\RutUtils;

class SepaUserProvider implements UserProviderInterface
{

    /**
     * El modelo Eloquent
     *
     * @var string
     */
    protected $model;


    /**
     * La uri base del servicio REST
     *
     * @var string
     */
    protected $rest_base_uri;

    /**
     * Las credenciales del servicio REST
     *
     * @var array
     */
    protected $rest_credentials;

    /**
     * Crea el proveedor de usuario
     *
     * @return void
     */
    public function __construct($model)
    {
        $this->model = $model;
        $this->rest_base_uri = env('SEPA_REST_BASE_URI', 'https://sepa.utem.cl/rest/api/v1');
        $this->rest_credentials = array(
            env('SEPA_REST_USERNAME', '1111-1'),
            env('SEPA_REST_PASSWORD', '1111-1')
        );
    }

    /**
     * Trae un usuario por credenciales
     *
     * @param array $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        if (!RutUtils::isRut($credentials['rut'])) {
            return null; // Si el rut es invalido nos negamos a autenticar
        }
        $rut = RutUtils::rut($credentials['rut']);

        return $this->createModel()->firstOrCreate(['rut' => $rut]);
    }

    /**
     * Checkea la validez de las credenciales del usuario
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @param array $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        $client = new GuzzleHttp\Client(['base_uri' => $this->rest_base_uri, 'auth' => $this->rest_credentials]);

        // Obtenemos las credenciales del usuario
        $rut = $credentials['rut']; // TODO: Una mejor forma de obtener los identificadores?
        $password = hash('sha256', strtoupper($credentials['password'])); // TODO: Para esto tambien ...

        try {
            $req = $client->get(sprintf('/sepa/autenticar/%s/%s', $rut, $password)); // Hacemos la peticion al WS
        } catch (GuzzleHttp\Exception\ClientException $e) { // Si los errores son del nivel 400, se lanza esta excepcion
            $msg = 'Error al consultar el servicio: %d(%s)';
            \Log::error(sprintf($msg, $e->getResponse()->getStatusCode(), $e->getResponse()->getReasonPhrase()));
            return false;
        }

        $data = json_decode($req->getBody(), true);
        $loginOk = $data['ok'];
        if ($loginOk) {
            \Log::info(sprintf('Auth: Login exitoso (%s)', $rut));
            if (is_a($user, '\Illuminate\Auth\GenericUser')) {
                // Nos llego un GenericUser, persistamos al usuario en DB
                $user = $this->createModel(); // Nueva instancia del modelo
                $user->rut = RutUtils::rut($rut);
                $user->save();
                \Log::info(sprintf('Auth: Creada instancia de %s (rut: %s)', $this->model, $user->rut));
            }
        }
        else {
            \Log::info(sprintf('Auth: Login fallido (%s)', $rut));
        }

        return (bool) $loginOk;
    }

    /**
     * Trae un usuario por id (rut)
     *
     * @param string $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    public function retrieveById($identifier)
    {
        $rut = $identifier;
        $user = $this->createModel()->newQuery()->find($identifier);
        \Log::debug(sprintf('Auth: Logeando usuario id "%s"', $rut));

        if (!$user) $user = $this->getGenericUser(['id' => $rut]);
        return $user;
    }

    /**
     * Trae a un usuario usando su token de "remember me" e identificador
     *
     * @param string $identifier
     * @param string $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
        //$rut = \UTEM\Utils\Rut::rut($identifier);
        //\Log::info(sprintf('Auth: Intentando login por token (%s: %s)', $rut, $token));
        return null;
    }

    /**
     * Actualiza el token "remember me"
     *
     * @param Authenticatable $user
     * @param string $token
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        //$user->setRememberToken($token);
        //$user->save();
    }

    /**
    * Get the generic user.
    *
    * @param  mixed  $user
    * @return \Illuminate\Auth\GenericUser|null
    */
    protected function getGenericUser($user)
    {
        if ($user !== null)
        {
            return new GenericUser((array) $user);
        }
    }

    /**
     * Crea una nueva instancia del modelo
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function createModel()
    {
        $class = '\\' . ltrim($this->model, '\\');
        return new $class;
    }
}
