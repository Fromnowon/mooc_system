<!-- Modal -->
<div class="modal fade" id="reg_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" style="width: 400px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                        <label class="form-label">姓名：</label>
                        <input id="reg_realname" type="text" class="form-control" placeholder="选填">
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
