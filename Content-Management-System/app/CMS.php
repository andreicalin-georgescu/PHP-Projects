<?php

/*
 * Wrapper class for the CMS operations
 * Uses Singleton to ensure a single instance
 * of the application at a given time
 */

namespace CMS;

use CMS\Includes\Connection;
use CMS\Includes\Models\Article;
use CMS\Includes\Storage\MySqlDatabaseStorage;
use CMS\Includes\Storage\Contracts\StorageInterface;

require (__DIR__ . '/../vendor/autoload.php');

class CMS
{
	private static $instance = NULL;
	protected $storage;

	private function __construct() {
		$dbConnection = new Connection;
		$this->storage = new MySqlDatabaseStorage($dbConnection->getConnection());
	}

	public static function getInstance() {
		if (self::$instance === NULL) {
			self::$instance = new CMS;
		}

		return self::$instance;
	}

	public function addArticle(Article $article) {
		return $this->storage->store($article);
	}

	public function updateArticle(Article $article) {
		return $this->storage->update($article);
	}

	public function deleteArticle(int $articleId) {
		return $this->storage->delete($articleId);
	}

	public function getArticle($id) {
		return $this->storage->get($id);
	}

	public function getAllArticles() {
		return $this->storage->getAll();
	}
}
