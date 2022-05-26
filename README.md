### ThinkPHP6 + MySql +Apache

本项目使用 **[ThinkPHP6](https://www.thinkphp.cn/) + [MySql](https://www.mysql.com/) + [Apache](https://apache.org/)** 实现 [VUE-CHAT](https://github.com/bailuoshu/vue-chat-VUE-) 后端交互功能、采用 [MySql](https://www.mysql.com/) 存储用户数据以及前端信息交互,引入 [WokerMan](https://www.workerman.net/) 插件实现与前端聊天信息及时传输、配合 [MySql](https://www.mysql.com/) 实现离线信息接受以及聊天记录历史存储。<br/>
登录验证使用token令牌验证:前端token数据保存在浏览器本地localStrong,通过http头内 *VCTOKEN* 字段携带token验证信息。<br/>
如需要两账户体验使用请使用两个不同浏览器登录。登录状态记录24小时。
<hr/>

### 功能实现

· 实时信息发送/接受<br/>
· 账号注册/登录/注销<br/>
· 好友添加与管理<br/>
· 离线信息记录<br/>
· 用户信息修改<br/>

<hr/>

### 待完成功能

· *账号信息更改（接口未完善）*<br/>
· *朋友圈功能（未添加）*<br/>
· *文档规范以及 API 接口说明* <br/>
· *图片、表情、文件等传送（数据库未完善）*<br/>

<hr/>

### 配置方式

导入 vue_chat.sql 到数据库,设置数据库用户与tp6文件中 ***.env*** 文件配置.<br/>
根目录下运行 ***composer update***  检查安装插件(主要为 ***WokerMan*** 库),注意PHP版本(php>7.0)以及composer版本更新.<br/>
根目录下运行 ***php think worker:server***  开启开发编译模式实时浏览更改.

<hr/>

### 演示地址

[vue-chat 演示链接 —— PC端打开链接](http://vue-chat.luoshu.ltd/)
 