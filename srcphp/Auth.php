<?php
    
    namespace proyecto;
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;
    use Carbon\Carbon;
    use proyecto\Models\Usuarios;


    class Auth
    {
        private $Usuarios;

        public static function generateToken($data, $time = 3600): string
        {
            $t = Carbon::now()->timestamp + $time;
            $key = 'osnola4321';
            $payload = ['exp' => $t, 'data' => $data];
            return JWT::encode($payload, $key, 'HS256');
        }




        /**
         * @return mixed
         */
        public function getUser()
        {
            $session = new Session();
            $this->user= $session->get('user');
            return $this->user;
        }
        /**
         * @param mixed $user
         */
        public function setUser($user): void
        {
            $session = new Session();
            $session->set('user', $user);
            $this->user = $user;
        }
        public function clearUser(): void
        {
            $se=new Session();
            $se->remove("user");
        }
    
        
    
        
    }
