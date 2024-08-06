const menu = [{
    "name": "首页",
    "icon": "&#xe68e;",
    "url": "index.html",
    "hidden": false,
    "list": []
}, {
    "name": "系统设置",
    "icon": "&#xe620;",
    "url": "",
    "hidden": false,
    "list": [{
        "name": "全局head",
        "url": "/admin/web/index.html"
    }, {
        "name": "友情连接",
        "url": "/admin/web/link.html"
    },{
        "name": "全局顶部",
        "url": "/admin/web/header.html"
    }, {
        "name": "导航管理",
        "url": "/admin/web/nav.html"
    }, {
        "name": "全局底部",
        "url": "/admin/web/footer.html"
    }, {
        "name": "清除缓存",
        "url": "/admin/index/web_cache.html"
    }, {
        "name": "文件管理",
        "url": "/admin/file/index.html"
    }, {
        "name": "修改密码",
        "url": "/admin/index/account.html"
    }]
}, {
    "name": "退出登录",
    "icon": "&#xe65c;",
    "url": "/admin/index/logout.html",
    "list": []
}];

const config = {
    name: "Tool",
    menu: menu,
    version: 'v1.6',
    official:'/'
};

try {
    module.exports.name = "Tool";
    module.exports.menu = menu;
}catch (e){

}
