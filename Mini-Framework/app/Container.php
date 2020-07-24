<?php

namespace App;

use ArrayAccess;

class Container implements ArrayAccess
{
	protected $items = [];
	protected $cache = [];

	/* Adds items to the container
	 * @param {string}		offset		Specifies the key of the array
	 * @param {closure}		value 		The container's stored closure. Can be run when extracted from container
	 */

	public function offsetSet($offset, $value)
	{
		return $this->items[$offset] = $value;
	}

	/* Extracts an item from the container by immediately calling the respective closure
	 * @param {string}		offset		Specifies the key of the array
	 * @return {item}	Returns the called item
	 */

	public function offsetGet($offset)
	{
		if (!$this->has($offset)) {
			return null;
		}

		// Check whether the item has already been called.

		if (isset($this->cache[$offset])) {
			return $this->cache[$offset];
		}

		$item = $this->items[$offset]($this);

		$this->cache[$offset] = $item;

		return $item;
	}

	/* Removes an item from the container
	 * @param {string}		offset		Specifies the key of the array
	 */

	public function offsetUnset($offset)
	{
		if ($this->has($offset)) {
			unset($this->items[$offset]);
		}
	}

	/* Checks whether a key can be found in the container
	 * @param {string}		offset		Specifies the key of the array
	 * @return {bool}	Checks if the given key exists
	 */

	public function offsetExists($offset)
	{
		return isset($this->items[$offset]);
	}

	/* Checks whether a given field can be found in the container
	 * @param {string}		offset		Specifies the key of the array
	 * @return {bool}	Checks if the field exists in the container
	 */

	public function has($offset)
	{
		return $this->offsetExists($offset);
	}

	/* Returns a property given as an input string
	 * @param {string}		property 	The property that is being accessed
	 * @return {array}	Returns the specified property as an array
	 */

	public function __get($property)
	{
		return $this->offsetGet($property);
	}
}