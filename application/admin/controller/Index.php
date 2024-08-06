<?php

namespace app\admin\controller;
use think\facade\Request;
use think\facade\Validate;

class Index extends Base
{
    public function index()
    {
        $this->checkLogin();
        return $this->fetch();
    }
    public function main()
    {
        $this->checkLogin();

        $info = [
            'framework_version' => app()::VERSION,
            'php_version' => PHP_VERSION,
            'software' => $_SERVER['SERVER_SOFTWARE'],
            'os' => php_uname(),
            'date' => date("Y-m-d H:i:s"),
        ];

        return $this->fetch('', [
            'info' => $info
        ]);
    }
    public function web_cache()
    {
        $this->checkLogin();
        if(request()->isPost()) {
            deleteDir(app()->getRootPath().'runtime');
            return 'ok';
        }
        return $this->fetch();
    }
    public function logout(){
        session('admin', null);
        return $this->redirect(url('login'), 302);
    }
    public function login()
    {
        $config = config('admin.');
        if($this->isLogin()){
            return $this->redirect(url('index'), 302);
        }

        if(request()->isPost() && request()->isAjax()){
            $username = input('post.username',null,'trim');
            $password = input('post.password',null,'trim');
            $captcha = input('post.captcha',null,'trim');

            if(empty($username) || empty($password)){
                return json(['code'=>-1, 'msg'=>'用户名或密码不能为空']);
            }
            if(!captcha_check($captcha)){
                return json(['code'=>-1, 'msg'=>'验证码错误']);
            }
            if($username == $config['username'] && $password == $config['password']){
                session('admin', $this->getSession());
                return json(['code'=>0]);
            }else{
                return json(['code'=>-1, 'msg'=>'用户名或密码错误']);
            }
        }

        return $this->fetch();
    }
    
    public function account()
    {
        $this->checkLogin();
        $config = config('admin.');

        if(request()->isPost() && request()->isAjax()){
            $params = Request::param();
            if(isset($params['username']))$params['username']=trim($params['username']);
            if(isset($params['oldpwd']))$params['oldpwd']=trim($params['oldpwd']);
            if(isset($params['newpwd']))$params['newpwd']=trim($params['newpwd']);
            if(isset($params['newpwd2']))$params['newpwd2']=trim($params['newpwd2']);

            $validate = Validate::rule([
                'username|用户名' => 'require|chsAlphaNum',
            ]);
            if (!$validate->check($params)) {
                return json(['code'=>-1, 'msg'=>$validate->getError()]);
            }

            $confignew['username'] = $params['username'];
            if(!empty($params['oldpwd']) && !empty($params['newpwd']) && !empty($params['newpwd2'])){
                if($config['password'] != $params['oldpwd']){
                    return json(['code'=>-1, 'msg'=>'旧密码不正确']);
                }
                if($params['newpwd'] != $params['newpwd2']){
                    return json(['code'=>-1, 'msg'=>'两次新密码输入不一致']);
                }
                $confignew['password'] = $params['newpwd'];
            }

            if($config['username'] != $confignew['username'] || isset($confignew['password']) && $config['password'] != $confignew['password']){
                $webconfig = "<?php\n".'return ' . var_export($confignew, true) . ';'."\n";
                file_put_contents('../config/admin.php', $webconfig);
                return json(['code'=>0, 'msg'=>'修改成功，请重新登录。']);
            }

            return json(['code'=>0, 'msg'=>'修改成功']);
        }

        return $this->fetch('', [
            'config' => $config
        ]);
    }

}
