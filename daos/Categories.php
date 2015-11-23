<?PHP

namespace daos;

/**
 * Class for accessing persistent saved categories -- mysql
 *
 * @package    daos
 * @author     Vlad
 */
class Categories extends Database {
    /**
     * Instance of backend specific items class
     *
     * @var     object
     */
    private $backend = null;


    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct() {
        $class = 'daos\\' . \F3::get('db_type') . '\\Categories';
        $this->backend = new $class();
        parent::__construct();
    }


    /**
     * pass any method call to the backend.
     *
     * @return methods return value
     * @param string $name name of the function
     * @param array $args arguments
     */
    public function __call($name, $args) {
        if(method_exists($this->backend, $name))
            return call_user_func_array(array($this->backend, $name), $args);
        else
            \F3::get('logger')->log('Unimplemented method for ' . \F3::get('db_type') . ': ' . $name, \ERROR);
    }
}
