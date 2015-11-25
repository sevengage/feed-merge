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
     * Get list of categories
     */
    public function all() {
        $categoriesDao = new \daos\Categories();
        $categories = $categoriesDao->getAll();
        foreach ($categories as & $category) {
            $category['keywords'] = json_encode($category['keywords']);
        }

        $this->view->jsonSuccess($categories);
    }
    
    /**
     * Get category details
     */
    public function get() {
        $id = \F3::get('PARAMS["id"]');

        $categoriesDao = new \daos\Categories();
        $category = $categoriesDao->get($id);
        $category['keywords'] = json_encode($category['keywords']);

        $this->view->jsonSuccess($category);
    }

    /**
     * Add new category
     */
    public function create() {
        // read data
        parse_str(\F3::get('BODY'), $data);

        if(!isset($data['title']) || empty($data['title']))
            $this->view->jsonError(array('title' => 'no data for title given'));
        if(!isset($data['keywords']) || empty($data['keywords']))
            $this->view->jsonError(array('keywords' => 'no data for keywords given'));

        $categoriesDao = new \daos\Categories();
        $id = $categoriesDao->create($data);

        $return = array(
            'success' => true,
            'id'      => $id
        );

        $this->view->jsonSuccess($return);
    }
    
    /**
     * Update category
     */
    public function update() {
        $id = \F3::get('PARAMS["id"]');

        // read data
        parse_str(\F3::get('BODY'), $data);

        if(!isset($data['title']) || empty($data['title']))
            $this->view->jsonError(array('title' => 'no data for title given'));
        if(!isset($data['keywords']) || empty($data['keywords']))
            $this->view->jsonError(array('keywords' => 'no data for keywords given'));

        $categoriesDao = new \daos\Categories();
        $categoriesDao->update($id, $data);

        $return = array(
            'success' => true,
            'id'      => $id
        );

        $this->view->jsonSuccess($return);
    }

    /**
     * Remove category
     */
    public function remove() {
        $id = \F3::get('PARAMS["id"]');

        $categoriesDao = new \daos\Categories();
        $categoriesDao->delete($id);
    }


    /**
     * returns all tags
     * html
     *
     * @return void
     */
    public function renderCategories($categories) {
        $html = "";
        foreach($categories as $category) {
            $this->view->title = $category['tag'];
            $this->view->keywords = $category['keywords'];
            $this->view->total = $category['total'];
            $html .= $this->view->render('templates/category.phtml');
        }

        return $html;
    }
}
