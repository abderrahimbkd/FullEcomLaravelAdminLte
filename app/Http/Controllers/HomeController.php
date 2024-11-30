<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\ContactUsModel;
use App\Models\PageModel;
use App\Models\ProductModel;
use App\Models\SliderModel;
use Auth;
use Illuminate\Http\Request;
use Mail;

class HomeController extends Controller
{
    public function home()
    {
        $data['meta_title'] = 'E-commerce';
        $data['meta_keywords'] = '';
        $data['meta_description'] = '';
        $data['getSlider'] = SliderModel::getRecordActive();
        $data['getCategory'] = CategoryModel::getRecordActiveHome();
        $data['getProduct'] = ProductModel::getRecentArrival();
        $data['getProductTrendy'] = ProductModel::getProductTrendy();
        return view('home', $data);
    }
    public function contact()
    {
        $data['meta_title'] = 'Contact';
        $data['meta_keywords'] = '';
        $data['meta_description'] = '';

        $data['getPage'] = PageModel::getSlug('contact');
        return view('page.contact', $data);
    }
    public function submit_contact(Request $request)
    {
        $save = new ContactUsModel();
        if (!empty(Auth::check())) {
            $save->user_id = Auth::user()->id;
        }
        $save->name = trim($request->name);
        $save->email = trim($request->email);
        $save->phone = trim($request->phone);
        $save->subject = trim($request->subject);
        $save->message = trim($request->message);
        $save->save();
        return redirect()->back()->with('success', 'Your information successfully send');
    }
    public function about()
    {
        $data['meta_title'] = 'About  ';
        $data['meta_keywords'] = '';
        $data['meta_description'] = '';
        $data['getPage'] = PageModel::getSlug('about');
        return view('page.about', $data);
    }

    public function faq()
    {
        $data['meta_title'] = 'faq  ';
        $data['meta_keywords'] = '';
        $data['meta_description'] = '';
        $data['getPage'] = PageModel::getSlug('faq');
        return view('page.faq', $data);
    }
    public function payment_methods()
    {
        $data['meta_title'] = 'Payment methods';
        $data['meta_keywords'] = '';
        $data['meta_description'] = '';
        $data['getPage'] = PageModel::getSlug('payment-methods');
        return view('page.payment_methods', $data);
    }
    public function money_back_guarantee()
    {
        $data['meta_title'] = 'Money back guarantee';
        $data['meta_keywords'] = '';
        $data['meta_description'] = '';
        $data['getPage'] = PageModel::getSlug('money-back-guarantee');
        return view('page.money_back_guarantee', $data);
    }
    public function returns()
    {
        $data['meta_title'] = 'Returns';
        $data['meta_keywords'] = '';
        $data['meta_description'] = '';
        $data['getPage'] = PageModel::getSlug('returns');
        return view('page.returns', $data);
    }
    public function shipping()
    {
        $data['meta_title'] = 'Shipping';
        $data['meta_keywords'] = '';
        $data['meta_description'] = '';
        $data['getPage'] = PageModel::getSlug('shipping');
        return view('page.shipping', $data);
    }
    public function terms_condition()
    {
        $data['meta_title'] = 'Terms condition';
        $data['meta_keywords'] = '';
        $data['meta_description'] = '';
        $data['getPage'] = PageModel::getSlug('terms-condition');
        return view('page.terms_condition', $data);
    }
    public function privacy_policy()
    {
        $data['meta_title'] = 'Privacy Policy';
        $data['meta_keywords'] = '';
        $data['meta_description'] = '';
        $data['getPage'] = PageModel::getSlug('privacy-policy');
        return view('page.privacy_policy', $data);
    }
    public function recent_arrival_category_product(Request $request)
    {
        $getProduct = ProductModel::getRecentArrival();
        $getCategory = CategoryModel::getSingle($request->category_id);

        return response()->json([
            'status' => true,
            'success' => view('product._list_recent_arrival', ['getProduct' => $getProduct, 'getCategory' => $getCategory,])->render(),
        ], 200);
    }
}
