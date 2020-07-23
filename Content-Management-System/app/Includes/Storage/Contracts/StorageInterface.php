<?php

namespace CMS\Includes\Storage\Contracts;
use CMS\Includes\Models\Article;

interface StorageInterface
{
	public function getAll();
	public function get($id);
	public function store(Article $article);
	public function update(Article $article);
	public function delete(int $articleId);
}
