<?
namespace CMS\Includes\Models;

use PDO;
use Carbon\Carbon;
use \CMS\Includes\Connection;

class Article
{
	protected $article_id;
	protected $article_title;
	protected $article_content;
	protected $article_date;

	public function setTitle($title) {
		$this->article_title = $title;
	}

	public function getTitle() {
		return $this->article_title;
	}

	public function setContent($content) {
		$this->article_content = $content;
	}

	public function getContent() {
		return $this->article_content;
	}

	public function setTime(Carbon $time) {
		$this->article_date = $time;
	}

	public function getTime() {
		if (!$this->article_date instanceof Carbon) {
			return new Carbon($this->article_date);
		}
		return $this->article_date;
	}

	public function getId() {
		return $this->article_id;
	}

	public function setId(int $id) {
		$this->article_id = $id;
	}
}
