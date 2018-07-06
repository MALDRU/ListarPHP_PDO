<?php
class DAL{
    private const MOTORBD = 'mysql';
    private const SERVIDOR = 'localhost';
    private const PUERTO = '3306';
    private const BASEDATOS = 'test';
    private const USUARIO = 'root';
    private const CLAVE = '302061';
    private $conexion = null;

    public function __construct(){
        try {             
            $this->conexion = new PDO(              
              self::MOTORBD.':dbname='.self::BASEDATOS.';host='.self::SERVIDOR.';port='.self::PUERTO,              
              self::USUARIO,              
              self::CLAVE             
            );         
         } catch (PDOException $e) {             
              die ('Conexion Fallida: ' . $e->getMessage());
         } 
    }
    public function __destruct(){
        unset($this->conexion);
    }
    
    
    /**
     * VerificarArray
     *  Verificar contenido de un arreglo
     * @param array &$datos
     * @param bool $multiple
     * @return bool
     */
    private function VerificarArray(&$datos,$multiple = false){
        if($multiple) return count($datos)>0 && is_array($datos[0]);
        return count($datos)>0;
    }

    /*PUBLIC METODOS*/
    /**
     * Select Consulta SQL con retorno de array asociativo
     * @param string $query Consulta SQL
     * @param bool $obtenerTodos=true Por defecto en true, obtiene todos los registros que genere la consulta, en false obtiene el primer registro
     * @param array &$where=null El numero de valores debe corresponder con el numero de ? en el Query
     * @return array
     */
    public function Select($query, $obtenerTodos=true, &$where=null){                
        $consulta = $this->conexion->prepare($query);
        if($where !== null){            
            if(!$this->VerificarArray($where)) die('Parametros incorrectos para este metodo');                                    
            $c=1;
            foreach($where as &$valor){                
                $consulta->bindParam($c, $valor);
                $c++;
            }            
        }        
        $consulta->execute();
        if($obtenerTodos) return $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $consulta->fetch(PDO::FETCH_ASSOC);
    }    
    /**
     * Query Consulta SQL con retorno true/false (modificacion contenido o estructura)
     * @param string $query Consulta SQL
     * @param array &$datos El numero de valores debe corresponder con el numero de ? en el Query
     * @return bool
     */
    Public function Query($query,&$datos){
        $consulta = $this->conexion->prepare($query);
        if($datos !== null){            
            if(!$this->VerificarArray($datos)) die('Parametros incorrectos para este metodo');                                    
            $c=1;
            foreach($datos as &$valor){                
                $consulta->bindParam($c, $valor);
                $c++;
            }            
            return $consulta->execute();            
        }else{
            die('Parametros incorrectos para este metodo');
        }     
    }
}
?>