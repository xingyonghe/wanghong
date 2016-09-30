<?php

namespace App\Http\Controllers\Admin;

use Log;
use Redirect;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AttachmentSaveRequest;
use App\Model\SysSetting;

/**
 * 附件上传规则配置
 *
 * Class AttachmentController
 * @package App\Http\Controllers\Admin
 * @author dch
 */
class AttachmentController extends Controller
{
    /**
     * 编辑配置附件上传规则
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        $attachmentValue = SysSetting::where(['name' => 'attachment_upload'])->first()->toArray()['value'] ?? "";
        $attachmentConfig = json_decode($attachmentValue, true);
        return view('admin.attachment.edit', $attachmentConfig);
    }

    /**
     * 附件上传规则保存
     *
     * @param AttachmentSaveRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(AttachmentSaveRequest $request)
    {
        try {
            $attachmentConfig = $request->only('max_one_size', 'max_total_size', 'max_total_num', 'allow_type');
            (new SysSetting())->set("attachment_upload",$attachmentConfig);
        } catch (\Exception $e) {
            Log::warning($e);
        } catch (\Throwable $e) {
            Log::warning($e);
        } finally {
            return Redirect::to('admin/attachment/edit')->with('message',['type' => 'success', 'content' => '操作成功']);
        }
    }
}
