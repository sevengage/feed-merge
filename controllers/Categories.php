<?PHP

namespace controllers;

/**
 * Controller for sources handling
 *
 * @package    controllers
 * @author     Vlad
 */
class Categories extends BaseController {
    
    /**
     */
    public function all() {
        $categoriesDao = new \daos\Categories();
        $items = $categoriesDao->getAll();

        $this->view->jsonSuccess($items);
    }
    
    /**
     */
    public function get() {

    }

    /**
     */
    public function create() {

    }
    
    /**
     */
    public function update() {

    }

    /**
     */
    public function remove() {

    }
}
