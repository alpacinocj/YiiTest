<?php
namespace frontend\controllers;

class SessionController extends BaseController
{
    private $_session;

    const SESSION_TEST_KEY = 'test';

    public function init()
    {
        parent::init();
        $this->_session = $this->getSession();
    }

    // 获取SESSION
    public function getSession()
    {
        return \Yii::$app->session;
    }

    // 检查SESSION是否开启
    public function isOpen()
    {
        return $this->_session->isActive;
    }

    // 开启SESSION
    public function open()
    {
        $this->_session->open();
    }

    // 关闭SESSION
    public function close()
    {
        $this->_session->close();
    }

    // 销毁SESSION
    public function destroy()
    {
        $this->_session->destroy();
    }

    // 设置SESSION
    public function set($key, $value)
    {
        $this->_session->set($key, $value);
    }

    // 是否设置SESSION
    public function has($key)
    {
        return $this->_session->has($key);
    }

    // 获取SESSION
    public function get($key)
    {
        if(!$this->has($key)) {
            return null;
        }
        return $this->_session->get($key);
    }

    // 删除SESSION
    public function remove($key)
    {
        return $this->_session->remove($key);
    }

    public function actionSet()
    {
        $this->set(self::SESSION_TEST_KEY, 'Hello world 121231231');
    }

    public function actionGet()
    {
        return $this->get(self::SESSION_TEST_KEY);
    }

    public function actionRemove()
    {
        $this->remove(self::SESSION_TEST_KEY);
    }

}