<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Lấy dữ liệu từ request
        $search = $request->input('data'); // Assumed 'data' is the name of the input field

        // Lấy ID của người dùng đang đăng nhập
        $accId = Auth::guard('account')->user()->id;

        // Thêm bản ghi mới vào bảng 'new_searchs'
        DB::table('new_searchs')->insert([
            'topic_name' => $search,
            'acc_id' => $accId,
        ]);

        // Tìm kiếm theo tên trong bảng 'Person'
        $results = Person::where('name', 'like', "%$search%")->get();

        // Trả về kết quả dưới dạng JSON
        return response()->json($results);
    }

    public function index2(Request $request)
    {
        // Lấy ID của người dùng đang đăng nhập
        $accId = Auth::guard('account')->user()->id;

        // Truy vấn tất cả các topic_name thuộc user đang đăng nhập
        $topicNames = DB::table('new_searchs')->where('acc_id', $accId)->select('id', 'topic_name')->get();

        // Trả về view với danh sách topic_name
        return view('welcome', [
            'topicNames' => $topicNames
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Person $person)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Person $person)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonRequest $request, Person $person)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person)
    {
        //
    }
}
