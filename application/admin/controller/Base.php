<?php

namespace app\admin\controller;
use think\Controller;

class Base extends Controller
{
    protected function isLogin()
    {
        $session = session('admin');
        if($session && $session === $this->getSession()) { 
            return true;
        }
        return false;
    }

    protected function getSession()
    {
        $config = config('admin.');
        return md5($config['username'].md5($config['password']));
    }

    protected function checkLogin()
    {
        if(!$this->isLogin()){
            exit($this->redirect(url('login'), 302));
        }
    }
}