<?php

namespace CMS\Includes\Storage;

use PDO;
use CMS\Includes\Models\Article;
use CMS\Includes\Storage\Contracts\StorageInterface;

class MySqlDatabaseStorage implements StorageInterface
{
	protected $db;

	public function __construct(PDO $pdo) {
		$this->db = $pdo;
	}

	public function store(Article $article) {
		$statement = $this->db->prepare("
			INSERT INTO articles (article_title, article_content, article_date)
			VALUES (:article_title, :article_content, :article_date)
		");

		$statement->execute($this->buildCollumns($article));

		return $this->get($this->db->lastInsertId());
	}

	public function update(Article $article) {
		$statement = $this->db->prepare("
			UPDATE articles
			SET
				article_title = :article_title,
				article_content = :article_content,
				article_date = :article_date
			WHERE article_id = :article_id
		");

		$statement->execute($this->buildCollumns($article, [
			'article_id' => $article->getId()
		]));

		return $this->get($article->getId());
	}

	public function delete(int $articleId) {
		$statement = $this->db->prepare("
			DELETE FROM articles
			WHERE article_id = :article_id
		");

		if (!$statement->execute(['article_id' => $articleId])) {
			return false;
		}

		return true;
	}

	public function getAll() {

		$statement = $this->db->prepare("
			SELECT * FROM articles
		");

		$statement->setFetchMode(PDO::FETCH_CLASS, Article::Class);

		$statement->execute();

		return $statement->fetchAll();
	}

	public function get($article_id) {

		$statement = $this->db->prepare("
			SELECT * FROM articles
			WHERE article_id = :article_id
		");

		$statement->setFetchMode(PDO::FETCH_CLASS, Article::Class);

		$statement->execute([
			'article_id' => $article_id
		]);

		return $statement->fetch();
	}

	protected function buildCollumns (Article $article, array $additional=[]) {
		return array_merge([
			'article_title' => $article->getTitle(),
			'article_content' => $article->getContent(),
			'article_date' => $article->getTime(),
		], $additional);
	}
}
