<?php
namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;

class News extends BaseModel
{
    const SCENARIO_TEST = 'test';
    const SCENARIO_DEFAULT = 'default';

    public function init()
    {
        parent::init();
    }

    public static function tableName()
    {
        return '{{%news}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => 'update_time'
            ]
        ];
    }

    /*public function scenarios()
    {
        return [];
    }*/

    public function rules()
    {
        return [
            ['title', 'required', 'on' => 'test'], // test场景下只有标题必须
            [['author', 'title', 'content'], 'required', 'on' => 'default'], // default场景下作者, 标题, 内容三者必须
            ['title', 'unique', 'message' => '标题不能重复'],
        ];
    }

    /*
     * 字段映射(可以保证API接口兼容性, 不因数据库字段变化而受影响)
     * */
    public function fields()
    {
        // 需返回关联数组, 键名为字段名, 键值为属性名
        return [
            'id',               // 如果相同可以省略键名
            'news_author' => 'author',
            'news_title' => 'title',
            'news_content' => 'content',
            'is_original',
            'original_title',
            'original_url',
            'create_time',
            'update_time',
            'create_date' => function() {
                return date('Y-m-d H:i:s', $this->create_time);
            },
            'update_date' => function() {
                return date('Y-m-d H:i:s', $this->update_time);
            },
        ];
    }

    /*
     * 获取列表
     * */
    public static function fetchList($conditions, $start = 0, $limit = 10)
    {
        $query = self::find()->where($conditions);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'page' => $start,
                'pageSize' => $limit
            ]
        ]);

        return $provider;
    }


}