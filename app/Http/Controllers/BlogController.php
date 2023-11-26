<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use DataTables;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = Blog::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<div class="d-flex gap-2"><a href="'.url('user/dashboard/blog/edit/'.$row->id).'" class="text-primary"><i class="fa-solid fa-pen"></i></a><a href="'.$row->id.'" class="text-success"><i class="fa-solid fa-eye"></i></a><a href="'.url('blog/delete/'.$row->id).'" class="text-danger"><i class="fa-solid fa-trash"></i></a></div>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('modules.dashboard.blogs.list');
    }

    public function blogData(Request $request) {
        if ($request->ajax()) {
            if(auth()->user()->type != 'admin') {
                $data = Blog::select('*')->where('user_id', auth()->user()->id)->where('status', 'Active');
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                               $btn = '<div class="d-flex gap-2"><a href="'.url('user/dashboard/blog/edit/'.$row->id).'" class="text-primary"><i class="fa-solid fa-pen"></i></a><a href="'.url('blog/'.$row->id).'" class="text-success"><i class="fa-solid fa-eye"></i></a><a href="'.url('blog/delete/'.$row->id).'" class="text-danger"><i class="fa-solid fa-trash"></i></a></div>';
                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            } else {
                $data = Blog::select('*');
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('status', function($row){
                            return $row->status;
                        })
                        ->addColumn('action', function($row){
                               $btn = '<div class="d-flex gap-2"><a href="'.url('admin/dashboard/blog/edit/'.$row->id).'" class="text-primary"><i class="fa-solid fa-pen"></i></a><a href="'.url('blog/'.$row->id).'" class="text-success"><i class="fa-solid fa-eye"></i></a><a href="'.url('blog/delete/'.$row->id).'" class="text-danger"><i class="fa-solid fa-trash"></i></a></div>';
                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }
            
        }
    }

    public function create() {
        return view('modules.dashboard.blogs.create');
    }

    public function createBlog(Request $request) {
        $validate = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'blog_post' => 'required|min:5',
            'featured_img' => 'required|mimes:jpeg,png,jpg,gif|max:10240'
        ]);

        if($validate->fails()) {
            return back()->with(['errors' => $validate->errors()]);
        }

        if($request->featured_img) {
            $imageName = time().'.'.$request->featured_img->extension(); 
            $request->featured_img->move(public_path('user/images/blog'), $imageName);
        }

        Blog::create([
            'title'         => $request->title,
            'user_id'       => auth()->user()->id,
            'status'        => 'Inactive',
            'blog_post'     => $request->blog_post,
            'featured_img'  => $imageName,
        ]);

        return back()->with(['success' => 'Blog created Successfully!']);
    }

    public function edit(Request $request, $id) {
        $data = Blog::where('id', $id)->first();
        return view('modules.dashboard.blogs.edit', compact('data'));
    }

    public function update(Request $request) {
        $validate = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'blog_post' => 'required|min:5',
            'featured_img' => 'mimes:jpeg,png,jpg,gif|max:10240'
        ]);

        if($validate->fails()) {
            return back()->with(['errors' => $validate->errors()]);
        }

        if($request->hasFile('featured_img')) {
            $imageName = time().'.'.$request->featured_img->extension(); 
            $request->featured_img->move(public_path('user/images/blog'), $imageName);
        } else {
            $imageName = $request->old_img;
        }

        Blog::where('id', $request->id)->update([
            'title'         => $request->title,
            'blog_post'     => $request->blog_post,
            'status'        => $request->status,
            'featured_img'  => $imageName,
        ]);

        return back()->with(['success' => 'Blog Updated Successfully!']);
    }

    public function view() {
        return view('modules.dashboard.blogs.view');
    }

    public function delete(Request $request, $id) {
        $destroy = Blog::destroy($id);
        if($destroy) {
            return back()->with(['success' => 'Blog Deleted Successfully!']);
        } else {
            return back()->with(['fail' => 'Failed to Delete!']);
        }
    }
}
