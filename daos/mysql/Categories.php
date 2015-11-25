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

    public function get($id) {
        $result = \F3::get('db')->exec('SELECT * FROM categories WHERE id = ' . (int) $id);

        return $result;
    }

    public function create(array $data)
    {
        return $this->stmt->insert('INSERT INTO '.\F3::get('db_prefix').'categories (title, keywords) VALUES (:title, :keywords)',
            array(
                ':title'  => trim($data['title']),
                ':keywords' => json_encode($data['keywords'])
            ));
    }

    public function update($id, array $data)
    {
        \F3::get('db')->exec('UPDATE '.\F3::get('db_prefix').'categories SET title=:title, keywords=:keywords WHERE id=:id',
            array(
                ':title'  => trim($data['title']),
                ':keywords' => json_encode($data['keywords']),
                ':id'     => $id
            ));
    }

    public function delete($id)
    {
        $result = \F3::get('db')->exec('DELETE FROM categories WHERE id = ' . (int) $id);

        return $result;
    }

}
