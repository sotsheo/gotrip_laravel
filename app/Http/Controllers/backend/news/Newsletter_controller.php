<?php


namespace App\Http\Controllers\backend\news;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Http\Model\news\Newsletter_model;
use App\Http\Model\Websites_model;
use App\Http\Controllers\Admin\Mail;
use App\Http\Model\history\History_model;
class Newsletter_controller extends Controller
{
    function index()
    {

        // Số email chưa biết
        $count = count(Newsletter_model::orderByRaw('id DESC')->where('viewed', 0)->get());
        $data = Newsletter_model::orderByRaw('id DESC')->where('viewed', 0)->get();
        if ($count != 0) {
            foreach ($data as $key) {
                $tem = Newsletter_model::where("id", $key->id)->first();
                $tem->viewed = 1;
                $tem->save();
            }
        }

        $news = Newsletter_model::orderByRaw('id DESC')->paginate(10);
        return view("admin.home.newsletter.index", ['news' => $news, 'count' => $count]);
    }

    function create_newsletter(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = array();
            $news = new Newsletter_model;
            $check = Newsletter_model::actionModel($news, $request);
            if ($check == 'true') {
                return redirect('admin/category_product/');
            }

        }
        return redirect('/');
    }

    function delete($id)
    {
        $news = Newsletter_model::where('id', $id)->first();
        if ($news) {
            if ($news->delete()) {

            }
        }
        return redirect('admin/newsletter');
    }

    static function get()
    {
        $news = Newsletter_model::where('viewed', 0)->get();
        return $news;

    }

}
