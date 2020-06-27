<?php
namespace App\Http\Model\site;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;

class Html_model extends Model
{
    protected $table = 'html';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'values',
        'delete',
        'delete_at'
    ];
    
    public static function validate($request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:5|max:255'

            ],
            [
                'required' => ':attribute Không được để trống'
            ],

            [
                'name' => 'Tiêu đề'

            ]

        );
        if ($validate->fails()) {
            return $validate->messages();
        }
        return false;
    }
}
