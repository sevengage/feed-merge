<?PHP

namespace daos\mysql;

/**
 * Class for accessing persistent saved items -- mysql
 *
 * @package    daos
 * @author     Vlad
 */
class Categories extends Database {

    public function getAll() {
        $result = \F3::get('db')->exec('SELECT * FROM categories');

        return $result;
    }

}
