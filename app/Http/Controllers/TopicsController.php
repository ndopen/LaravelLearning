<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Models\Category;
use App\Handlers\ImageUploadHandler;
use Auth;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
	
	/**
	* @description:按照withorder函数输出数据列表,并且按照每页20行的数据输出 
	* @param {topic list} 
	* @return: 
	*/
	public function index(Request $request, Topic $topic)
	{
		$topics = $topic->withOrder($request->order)->paginate(20);
		return view('topics.index', compact('topics'));
	}

	/**
     * @description:帖子显示 
     * @param {type} 
     * @return: 
     */
    public function show(Topic $topic, Request $request)
    {
        if ( ! empty($topic->slug) && $topic->slug != $request->slug) {
            return redirect($topic->link(), 301);
		}
		
        return view('topics.show', compact('topic'));
	}
	
	/**
	* @description: 创建话题控制器
	* @param {type} 
	* @return: 
	*/
	public function create(Topic $topic)
	{
		$categories = Category::all();
		return view('topics.create_and_edit', compact('topic', 'categories'));
	}

	/**
	 * @description:话题存储相关 
	* @param {type} 
	* @return: 
	*/
	public function store(TopicRequest $request, Topic $topic)
	{
        $topic->fill($request->all());
        $topic->user_id = Auth::id();
        $topic->save();

        return redirect()->to($topic->link())->with('success', '帖子创建成功！');
	}

	/**
    * @description:话题编辑 
	* @param {type} 
	* @return: 
	*/
	public function edit(Topic $topic)
	{
		$this->authorize('update', $topic);
		$categories = Category::all();
		return view('topics.create_and_edit', compact('topic', 'categories'));
	}

	/**
  * @description: 话题更新
  * @param {type} 
  * @return: 
  */
	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->update($request->all());

		return redirect()->to($topic->link())->with('success', '话题跟新成功！');
	}
	/**
  * @description:话题删除处理 
  * @param {type} 
  * @return: 
  */
	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topics.index')->with('success', '话题删除成功!');
	}

	/**
     * @description:话题图片上传 
     * @param {type} 
     * @return: 
     */
    public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
        // 初始化返回数据，默认是失败的
        $data = [
            'success'   => false,
            'msg'       => '上传失败!',
            'file_path' => ''
        ];
        // 判断是否有上传文件，并赋值给 $file
        if ($file = $request->upload_file) {
            // 保存图片到本地
            $result = $uploader->save($request->upload_file, 'topics', \Auth::id(), 1024);
            // 图片保存成功的话
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg']       = "上传成功!";
                $data['success']   = true;
            }
        }
        return $data;
    }
}