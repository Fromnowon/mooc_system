<!-- Modal -->
<div class="modal fade" id="user_edit_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">数据修改</h4>
            </div>
            <div class="modal-body">
                <form class="form-inline">
                    <fieldset>
                        <legend>登录相关</legend>
                        <div class="form-group">
                            <label for="edit_username"><span style="color: red">*</span>账号:<span>&nbsp;&nbsp;</span></label>
                            <input type="text" class="form-control" id="edit_username">
                        </div>
                        <div class="form-group">
                            <label for="edit_password"><span
                                        style="color: red">*</span>密码:<span>&nbsp;&nbsp;</span></label>
                            <input type="password" class="form-control" id="edit_password">
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>权限相关</legend>
                        <div class="form-group">
                            <label for="edit_flag" class="control-label"><span style="color: red">*</span>身份：<span>&nbsp;&nbsp;</span></label>
                            <select id="edit_flag" class="form-control">
                                <option value="0">普通用户</option>
                                <option value="1">管理员</option>
                                <option value="2">网站维护人</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_status" class="control-label"><span style="color: red">*</span>状态：<span>&nbsp;&nbsp;</span></label>
                            <select id="edit_status" class="form-control">
                                <option value="1">正常</option>
                                <option value="2">禁止上传</option>
                                <option value="3">禁止发言</option>
                                <option value="0">禁止登录</option>
                            </select>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>其他信息</legend>
                        <div class="form-group">
                            <label for="edit_realname">真实姓名：<span>&nbsp;&nbsp;</span></label>
                            <input type="text" class="form-control" id="edit_realname">
                        </div>
                        <div class="form-group">
                            <label for="edit_gender" class="control-label">性别：<span>&nbsp;&nbsp;</span></label>
                            <select id="edit_gender" class="form-control">
                                <option value="0">保密</option>
                                <option value="1">男</option>
                                <option value="2">女</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_contact">联系方式：<span>&nbsp;&nbsp;</span></label>
                            <input type="text" class="form-control" id="edit_contact">
                        </div>
                        <div class="form-group">
                            <label for="edit_school">学<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;校：<span>&nbsp;&nbsp;</span></label>
                            <input type="text" class="form-control" id="edit_school">
                        </div>
                        <div class="form-group" style="display: block">
                            <label for="edit_introduction">简介：</label>
                            <p><span>&nbsp;&nbsp;</span></p>
                            <textarea rows="5" class="form-control" style="width: 90%;resize: none"
                                      id="edit_introduction"></textarea>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <span style="color: red;float: left"></span>
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" id="data_edit_btn">保存</button>
            </div>
        </div>
    </div>
</div>