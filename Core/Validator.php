<?php

namespace Core;

class Validator
{
	public $fields;
	public $errors;
	public $isValid;

	protected $entity;
	protected $rules;
	protected $map;
	protected $trans;

	public function __construct()
	{
		$this->map = include_once 'Configs/ValidationMap.php';
		$this->rules = false;
		$this->isValid = true;
		$this->errors = [];

		$this->trans = new Translator();
	}

	public function loadRules ($entity)
	{
		$this->entity = $entity;
		$this->rules = $this->map[$entity];
		$this->extractFields([]);

		return $this;
	}

	public function run (array $post)
	{
		$this->extractFields($post);

		$rules = $this->rules['rules'];
			// 'not_empty' $rule = ['login', 'password']
		foreach ($rules as $k => $rule) {
			if ($k === 'not_empty') {
	//['login' => 'igor', 'password' => '123'] $name = login $value = 'igor'			
				foreach ($this->fields as $name => $value) {
					if (in_array($name, $rule)) {
						if ($value === '' || $value === null) {
							$this->errors[$name] = $this->trans->getTranslate('field.error_empty', 'en');
						}
					}
				}
			}

			if ($k == 'max_length') {

			}

			//..
		}

		if (!empty($this->errors)) {
			$this->isValid = false;
		}

		return $this;
	}

	// $post['login' => 'igor', 'password' => '123', 'remember' => true]
	private function extractFields(array $post)
	{
		foreach ($this->rules['fields'] as $field) {
				// $post['login']
			if (!isset($post[$field]) || trim($post[$field]) === '') {
				$this->fields[$field] = null;
				continue;
			}

			$this->fields[$field] = htmlspecialchars(trim($post[$field]));
		}
	}
}












