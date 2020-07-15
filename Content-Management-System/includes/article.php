<?

class Article {

	public function fetchAll() {
		global $pdo;

		$statement = $pdo->prepare("
			SELECT * FROM articles
		");

		$statement->execute();

		return $statement->fetchAll();
	}

	public function fetchData($article_id) {
		global $pdo;

		$statement = $pdo->prepare("
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