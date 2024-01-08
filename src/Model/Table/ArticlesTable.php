<?php 

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class ArticlesTable extends Table{

	public function initialize(array $config): void{
		$this->setTable('articles');

		$this->belongsTo('Categories');
		$this->belongsTo('Rubrics');
		$this->belongsTo('Authors');

		$this->belongsToMany('Tags', [
            'through' => 'ArticlesTags',
        ]);

		$this->addBehavior('Translate', [
			'fields' => [
				'title', 
				'sub_title',
				'short_desc', 
				'img_text',
				'body', 
				'meta_title', 
				'meta_keywords', 
				'meta_description', 
			],
			'allowEmptyTranslations' => false
		]);

		$this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created_at' => 'new',
                    'updated_at' => 'always'
                ]
            ]
        ]);
	}
}


 ?>