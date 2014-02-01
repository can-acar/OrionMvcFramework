<?php
namespace OrionMvc;
/**
* This is class Router
*
*/
class Router extends AbstractRouter implements IRouter{


    const QUERY_STRING_PARAMS = '(?:^|(?<=\&(?![a-z]+\;)))([^\=]+)=(.*?)(?:$|\&(?![a-z]+\;))';//' & (? = [ ^= ]*&)';
    /**
    * This is variable RouteMeta description
    *
    * @var mixed
    *
    */
    public $RouteMeta;

    /**
    * This is variable RouterCollection description
    *
    * @var mixed
    *
    */
    public static $RouterCollection;



    /**
    * This is method __construct
    *
    * @return mixed This is the return value description
    *
    */
    public function __construct(){
        $this->RouteMeta = new RouteMeta();
        $this->RouteMeta->Router = $this;
        self::$RouterCollection = new RouterCollection();

    }

    /**
    * This is method Match
    *
    * @param mixed $Url
    * @return mixed
    *
    */
    public function Match($Url){
        try{
            $isMatched = false;


            if(self::$RouterCollection->Get()->valid()){

                foreach(self::$RouterCollection->Get() as $route){

                    $this->RouteMeta->Route = $route;
                    $this->RouteMeta->Rule = $route->Rule;
                    $Default = $route->GetDefault();
                    $Regex   = $route->getUrlSchema();
                    
                    $params  = array();

                    try{

                        if( preg_match($Regex,$Url, $matches) == true){
                            $isMatched = true;
                        }
                    }catch(Exception\RouterException $e){
                        throw OrionException::Handler(new Exception\RouterException("unspacted router confiragtion error"));
                        return false;
                    }

                    if($isMatched == true){

                         list($key,$value) = each($matches);
                         
                         if(!is_int($key)&&!is_null($key)&&!is_numeric($key)){
                             if($value != ''){
                                 $params[$key] = $value;
                             }

                         }
                         

                        $merge = array_merge($Default, $params);

                        foreach($merge as $key=>$value){

                            $this->RouteMeta->{ $key } = $value;

                        }

                        return $isMatched;
                    }

                }
            }

            return $isMatched;

        }
        catch( Exception\RouterException $e ){
            throw OrionException::Handler(new Exception\RouterException("unspacted router confiragtion error"));
            return false;
        }

    }
    
    /**
    * This is method Connect
    *
    * @param mixed $Path "{controller}/{action}/{id}"
    * @param mixed $Defualt "["controller"=>"controllerName","action"=>"actionName"]
    * @param mixed $Filter  Filter params "["id"=>"(\d+)"]
    * @return mixed
    *
    */
    public static function Connect($Name, $Path ,array $Defualt ,array $Filter = null){

        $Route = new Route($Path,$Defualt,$Filter);

        self::AddRoute($Route,$Name);

        return $Route;

    }

    /**
    * This is method AddRoute
    *
    * @param Route $Route 
    * @return mixed
    *
    */
    public static function AddRoute(Route $Route,$Name){
        self::$RouterCollection->Add($Name ,$Route);

    }

    /**
     * Summary of IgnoreRoute
     */
    public static function IgnoreRoute(){

    }




}
?>