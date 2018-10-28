<!-- Modal -->
<div class="modal fade" id="reg_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" style="width: 400px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">注册新用户</h4>
            </div>
            <div class="modal-body">
                <form role="form" style="padding: 10px" id="reg_form">
                    <div class="form-group">
                        <label class="form-label"><span style="color: red">* </span>用户名：</label>
                        <input id="reg_username" type="text" class="form-control" placeholder="必填（长度不少于5）">
                    </div>
                    <div class="form-group">
                        <label class="form-label"><span style="color: red">* </span>密码：</label>
                        <input id="reg_password" type="password" class="form-control" placeholder="必填（长度不少于5）">
                    </div>
                    <div class="form-group">
                        <label class="form-label"><span style="color: red">* </span>姓名（昵称）：</label>
                        <input id="reg_realname" type="text" class="form-control" placeholder="必填">
                    </div>
                    <div class="form-group">
                        <label class="form-label">邮箱：</label>
                        <input id="reg_mail" type="text" class="form-control" placeholder="选填">
                    </div>
                    <div class="form-group">
                        <label class="form-label">所在学校：</label>
                        <input id="reg_school" type="text" class="form-control" placeholder="选填">
                    </div>
                    <div class="form-group">
                        <label class="form-label">联系方式：</label>
                        <input id="reg_contatct" type="text" class="form-control" placeholder="选填">
                    </div>
                    <div style="font-size: 14px;">
                        <input type="checkbox" name="reg_teacher" value="1">
                        <span>我是教师<span style="color: red">（需审核）</span></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <span style="color: red;float: left"></span>
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" id="reg_submit">提交</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ie_error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="top: 20%">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel" style="color: red;font-weight: bold">注意！</h4>
            </div>
            <div class="modal-body">
                <p style="color: blue">检测到您正在使用IE浏览器</p>
                <p>由于<span style="color: red">代码框架</span>限制，本网站只能在<span style="color: red">Chrome内核</span>浏览器中正常运行</p>
                <p>若您正在使用360、搜狗等浏览器，请把浏览模式切换为<span style="font-size: 16px">&nbsp;&nbsp;[极速模式]</span></p>
                <p>或者安装谷歌浏览器（来源：百度软件）：<a
                            href="http://sw.bos.baidu.com/sw-search-sp/software/1e5d43b6599f5/ChromeStandalone_64.0.3282.119_Setup.exe">点击下载</a>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">好的</button>
            </div>
        </div>
    </div>
</div>