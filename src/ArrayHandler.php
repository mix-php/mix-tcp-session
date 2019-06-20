<?php

namespace Mix\Tcp\Session;

use Mix\Component\AbstractComponent;

/**
 * Class ArrayHandler
 * @package Mix\WebSocket\Session
 * @author liu,jian <coder.keda@gmail.com>
 */
class ArrayHandler extends AbstractComponent implements TcpSessionHandlerInterface
{

    /**
     * WebSocket会话数据
     * @var array
     */
    protected $_session = [];

    /**
     * 获取
     * @param $fd
     * @param $key
     * @return mixed
     */
    public function get($fd, $key = null)
    {
        $session = &$this->_session;
        if (is_null($key)) {
            return $session[$fd] ?? [];
        }
        return $session[$fd][$key] ?? null;
    }

    /**
     * 设置
     * @param $fd
     * @param $key
     * @param $value
     * @return bool
     */
    public function set($fd, $key, $value)
    {
        $session            = &$this->_session;
        $session[$fd][$key] = $value;
        return true;
    }

    /**
     * 删除
     * @param $fd
     * @param $key
     * @return bool
     */
    public function delete($fd, $key)
    {
        $session = &$this->_session;
        unset($session[$fd][$key]);
        return true;
    }

    /**
     * 清除
     * @param $fd
     * @return bool
     */
    public function clear($fd)
    {
        $session = &$this->_session;
        unset($session[$fd]);
        return true;
    }

    /**
     * 判断是否存在
     * @param $fd
     * @param $key
     * @return bool
     */
    public function has($fd, $key)
    {
        $session = &$this->_session;
        return isset($session[$fd][$key]) ? true : false;
    }

}
