<!-- Modal -->
<div class="modal fade" id="course_edit_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" style="width: 400px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">课程修改</h4>
            </div>
            <div class="modal-body">
                <h4>审核状态</h4>
                <div class="form-group form-inline">
                    <label for="course_flag" class="control-label">标记：<span>&nbsp;&nbsp;</span></label>
                    <select id="course_flag" class="form-control">
                        <option value="0">正常</option>
                        <option value="1">审核中</option>
                        <option value="-1">屏蔽</option>
                    </select>
                </div>
                <h4>分类</h4>
                <div class="form-group form-inline">
                    <label for="upload_subject" class="control-label">科目：<span>&nbsp;&nbsp;</span></label>
                    <select id="upload_subject" name="upload_subject" class="form-control">
                        <option value="语文">语文</option>
                        <option value="数学">数学</option>
                        <option value="英语">英语</option>
                        <option value="物理">物理</option>
                        <option value="生物">生物</option>
                        <option value="化学">化学</option>
                        <option value="政治">政治</option>
                        <option value="历史">历史</option>
                        <option value="地理">地理</option>
                        <option value="心理">心理</option>
                        <option value="信息技术">信息技术</option>
                        <option value="通用技术">通用技术</option>
                        <option value="暂无">暂无</option>
                    </select>
                </div>
                <div>
                    <br/>
                    <h4>标题：</h4>
                    <br/>
                    <input type="text" id="edit_course_title" class="form-control">
                </div>
                <div>
                    <br/>
                    <h4>介绍：</h4>
                    <br/>
                    <textarea rows="8" style="resize: none" id="edit_course_introduction" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" id="course_edit_submit">提交</button>
            </div>
        </div>
    </div>
</div>
