<?php
namespace common\lib;

/*
 * 通用树形数据类
 * */
class DataTree
{
    private static $subNodeKey = 'sub';    // 子节点键名

    private $dataId;                // 主键ID
    private $parentId;              // 父ID
    private $data;
    private $isValid = false;
    private $error = '';

    public function __construct($data, $idName = 'id', $pidName = 'pid')
    {
        $this->dataId = $idName;
        $this->parentId = $pidName;
        $this->data = $this->dataInitialize($data);
        if(!$this->data) {
            $this->setError('数据格式非法');
        }
    }

    public function setSubNodeKey($key)
    {
        self::$subNodeKey = $key;
    }

    public static function getSubNodeKey()
    {
        return self::$subNodeKey;
    }

    public function getIdName()
    {
        return $this->dataId;
    }

    public function getParentIdName()
    {
        return $this->parentId;
    }

    public function setError($error)
    {
        $this->error = $error;
    }

    public function isDataValid()
    {
        return $this->isValid;
    }

    // 数据初始化
    private function dataInitialize($data)
    {
        if(!is_array($data)) {
            return false;
        }
        $r = array();
        foreach($data as $v) {
            if(
                !is_array($v) ||
                !isset($v[$this->dataId]) ||
                !isset($v[$this->parentId])
            ) {
                return false;
            }
            $r[$v[$this->dataId]] = $v;
        }
        unset($data);
        $this->isValid = true;
        return $r;
    }

    // 通过节点ID获取当前节点数据
    public function getNodeById($id)
    {
        return (isset($this->data[$id])) ? $this->data[$id] : '';
    }

    // 通过当前节点ID找父级节点数据
    public function getParentNodes($id, $withSelfNode = false)
    {
        $pid = $this->data[$id][$this->parentId];
        $nodes = array();
        // 如果PID为0则该节点即为顶级节点
        if(!$pid) {
            return $withSelfNode ? $this->getNodeById($id) : false;
        }
        while($pid && isset($this->data[$pid])) {
            $nodes[$pid] = $this->data[$pid];
            $pid = $this->data[$pid][$this->parentId];
        }
        ksort($nodes);
        if($withSelfNode) {
            $nodes[$id] = $this->getNodeById($id);
        }
        return $nodes;
    }

    // 通过当前节点ID找顶级节点数据
    public function getTopParentNode($id)
    {
        $nodes = $this->getParentNodes($id);
        if(false !== $nodes) {
            $node = array_shift($nodes);
            return $node;
        }
        return false;
    }

    // 通过当前节点ID找最近父级节点数据
    public function getLatelyParentNode($id)
    {
        // 当前是否是顶级节点
        if(!$this->data[$id][$this->parentId]) {
            return false;
        }
        $id = $this->data[$id][$this->parentId];
        return $this->data[$id];
    }

    // 通过当前节点ID找子级节点数据
    public function getChildNodes($id, $withSelf = false)
    {
        $r = array();
        $origId = $id;
        // 准备一个数组, 不断的入栈/出栈
        $d = array($id);
        while($id = array_shift($d)) {
            foreach($this->data as $k => $v) {
                $pid = $v[$this->parentId];
                if($pid == $id) {
                    $r[$k] = $v;
                    // 压入一个新的ID, 等待下次循环
                    array_push($d, $k);
                }
            }
        }
        if($withSelf) {
            $r[$origId] = $this->getNodeById($origId);
        }
        ksort($r);
        return $r;
    }

    // 生成树形结构数据
    public function makeTree($data = '', $pid = 0, $nest = true)
    {
        $tree = array();
        if(!$data) {
            $data = $this->data;
        }

        if($nest === true) {
            foreach ($data as $item) {
                if(isset($data[$item[$this->parentId]])) {
                    $data[$item[$this->parentId]][self::$subNodeKey][] = &$data[$item[$this->dataId]];
                } else {
                    $tree[] = &$data[$item[$this->dataId]];
                }
            }
        } else {
            foreach($data as $item){
                if(isset($item[$this->parentId]) && $item[$this->parentId] == $pid){
                    $tree[] = $item;
                    $tree = array_merge($tree, $this->makeTree($data, $item[$this->dataId], false));
                }
            }
        }

        return $tree;
    }

}

?>