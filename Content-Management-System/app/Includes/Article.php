<?
namespace CMS\Includes;

use PDO;
use \CMS\Includes\Connection;

class Article
{

	protected $db;

	public function __construct(PDO $pdo) {
		$this->db = $pdo;
	}

	public function fetchAll() {

		$statement = $this->db->prepare("
			SELECT * FROM articles
		");

		$statement->execute();

		return $statement->fetchAll();
	}

	public function fetchData($article_id) {

		$statement = $this->db->prepare("
			SELECT * FROM articles
			WHERE article_id = :article_id
		");

		$statement->execute([
			'article_id' => $article_id
		]);

		return $statement->fetch();
	}
}

?>