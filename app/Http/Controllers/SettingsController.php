<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use App\Models\FooterTitle;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SettingsController extends BaseController
{
    public function FooterSettings()
    {
        $footerOne = Footer::where('column','one')->get();
        $footerTwo = Footer::where('column','two')->get();
        $footerThree = Footer::where('column','three')->get();
        $footerFour = Footer::where('column','four')->orderBy('updated_at')->first();
        $footerOneTitle = FooterTitle::where('column','one')->first();
        $footerTwoTitle = FooterTitle::where('column','two')->first();
        $footerThreeTitle = FooterTitle::where('column','three')->first();

        $this->data['footerOne'] = $footerOne;
        $this->data['footerTwo'] = $footerTwo;
        $this->data['footerThree'] = $footerThree;
        $this->data['footerFour'] = $footerFour;
        $this->data['footerOneTitle'] = $footerOneTitle;
        $this->data['footerTwoTitle'] = $footerTwoTitle;
        $this->data['footerThreeTitle'] = $footerThreeTitle;

        $this->data['title'] = 'Footer Settings';
        $this->data['titleDesc'] = 'Footer Settings';
        $this->data['description'] = 'Footer Settings';

        return view('admin.settings.footer',$this->data);
    }
    public function EditFooter(int $id)
    {

        $footer = Footer::find($id);
        $this->data['title'] = 'Footer Settings';
        $this->data['titleDesc'] = 'Footer Settings';
        $this->data['description'] = 'Footer Settings';
        $this->data['footer'] = $footer;

        return view('admin.settings.edit-footer',$this->data);
    }
    public function SaveToFooterTitle(Request $request)
    {
        //dd($request->all());
        $url = null;
        try {
            if ($request->hasFile('image')){
                $request->validate([
                    'image' => ['nullable','max:300','image']
                ]);
                //upload the image
                $url = fire_up_cloudinary_upload($request->file('image'));
            }

            FooterTitle::updateOrCreate([
                'column' => $request['column']
            ], [
                'title' => $request['title_type'] == 'text' ? $request['title'] : $url,
                'title_type' => $request['title_type']
            ]);
            toast('Success','success');
        } catch (\Exception $exception){
            Log::error($exception->getMessage());
            toast('Something went wrong','error');
        }
        return back();
    }
    public function SaveToFooter(Request $request)
    {
        if ($request['column'] == 'four'){
            Footer::updateOrCreate([
                'column' => 'four'
            ], [
                'is_newsletter' => true,
                'newsletter_text' => $request['newsletter_text'],
                'newsletter_placeholder' => $request['newsletter_placeholder']
            ]);
            toast('success','success');
            return back();
        }
        //dd($request->all());
        try {
            $footer = Footer::create([
                'title' => $request['title'],
                'column' => $request['column'],
                'icon' => $request['icon'],
                'link' => $request['link'],
                'custom_link' => $request['custom_link']
            ]);
            toast('Success','success');
        } catch (\Exception $exception){
            Log::error($exception->getMessage());
            toast('An error has occurred','error');
        }
        return back();
    }
    public function DeleteFooter(int $id)
    {
        try {
            $footer = Footer::findOrFail($id);
            $footer->delete();
            toast('success','success');
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            toast('Not found','error');
        }
        return back();
    }
    public function UpdateFooter(Request $request, int $id)
    {
        try {
            $footer = Footer::findOrFail($id);
            $footer->update([
                'title' => $request['title'],
                'column' => $request['column'],
                'icon' => $request['icon'],
                'link' => $request['link'],
            ]);
            toast('success','success');
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            toast('error','error');
        }
        return redirect(route('usr.settings.footer'));
    }
}
