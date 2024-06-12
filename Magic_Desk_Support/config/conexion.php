<?php
    session_start();
    class Conectar{
        protected $dbh;

        protected function Conexion(){
            try {
                //* Cadena de Conexion Local
                //$conectar = $this->dbh = new PDO("mysql:host=sql3.freesqldatabase.com;dbname=sql3708192;port=3306", "sql3708192", "UdCWhn4Vqm");
                //$conectar = $this->dbh = new PDO("mysql:local=localhost;dbname=id22059849_ilabtdi","id22059849_ilabtdi","iLabTDI.2024");
                //$conectar = $this->dbh = new PDO("mysql:host=localhost;dbname=andercode_helpdesk1","andercode","contraseña");
		       
                $conectar = $this->dbh = new PDO("mysql:local=localhost;dbname=magicdesksupport","root","");
                return $conectar;
			} catch (Exception $e) {
				print "¡Error BD!: " . $e->getMessage() . "<br/>";
				die();
			}
        }

        public function set_names(){
			return $this->dbh->query("SET NAMES 'utf8'");
        }

        /* * Ruta o Link del proyecto */
        public static function ruta(){
            //* Ruta Proyecto Local
			return "https://easy-recently-troll.ngrok-free.app/Magic_Desk_Support/";
		}

    }
?>