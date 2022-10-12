<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Traits\UploadAble;
use App\Models\Setting;
use Illuminate\Http\UploadedFile;

class SettingController extends BaseController
{
    use UploadAble;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->setPageTitle('Settings', 'Manage Settings');
        return view('admin.settings.index');
    }

    /**
     * @param Request $request
     */
    public function update(Request $request)
    {
        if ($request->has('site_logo') && ($request->file('site_logo') instanceof UploadedFile)) {
            if (config('settings.site_logo') != null) {
                $this->deleteOne(config('settings.site_logo'));
            }
            $logo = $this->uploadOne($request->file('site_logo'), 'img');
            Setting::set('site_logo', $logo);
        } elseif ($request->has('site_favicon') && ($request->file('site_favicon') instanceof UploadedFile)) {

            if (config('settings.site_favicon') != null) {
                $this->deleteOne(config('settings.site_favicon'));
            }
            $favicon = $this->uploadOne($request->file('site_favicon'), 'img');
            Setting::set('site_favicon', $favicon);
        } else {

            $keys = $request->except('_token');
            foreach ($keys as $key => $value) {
                Setting::set($key, $value);
            }
        }

        if($request->has('footer_copyright_text') || $request->has('seo_meta_title') || $request->has('seo_meta_description')){
            return back()->withInput(['tab'=>'footer-seo'])->with('success','Settings updated successfully');
        }

        if($request->has('social_facebook') || $request->has('social_twitter') || $request->has('social_instagram')){
            return back()->withInput(['tab'=>'social-links'])->with('success','Settings updated successfully');
        }

        if($request->has('google_analytics') || $request->has('facebook_pixels')){
            return back()->withInput(['tab'=>'analytics'])->with('success','Settings updated successfully');
        }

        if($request->has('stripe_payment_method') || $request->has('stripe_key') || $request->has('stripe_secret_key') || $request->has('paypal_payment_method')
        ||$request->has('paypal_client_id') || $request->has('paypal_secret_id')){
            return back()->withInput(['tab'=>'payments'])->with('success','Settings updated successfully');
        }

        if($request->has('site_name') || $request->has('site_title') || $request->has('default_email_address') || $request->has('currency_code') ||
        $request->has('currency_symbol')){
            return $this->responseRedirectBack('Settings updated successfully.', 'success');
        }

        if((config('settings.site_logo') != null) || config('settings.site_favicon') != null){
            return back()->withInput(['tab'=>'site-logo'])->with('success','Settings updated successfully');
        }
    }
}
